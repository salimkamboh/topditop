<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Package;
use App\Profile;
use App\Registerfield;
use App\Store;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    private $confirmation_code;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware($this->guestMiddleware(), ['except' => [
            'logout',
            'apiAdminLogin',
            'apiAdminCheck'
        ]]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $allowed = [
            'name' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'confirm_field' => 'required',
        ];

        $messages = [
            'confirm_field' => 'The :confirm_field must be selected.'
        ];

        $registerFields = Registerfield::where('fieldlocation', 'Firma')->get();
        foreach ($registerFields as $registerField) {
            $allowed[$registerField->key] = 'max:255';
        }

        $registerFields = Registerfield::where('fieldlocation', 'Ansprechpartner')->get();
        foreach ($registerFields as $registerField) {
            $allowed[$registerField->key] = 'max:255';
        }

        return Validator::make($data, $allowed, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $this->confirmation_code = str_random(30);
        $password = Hash::make('topditop');

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
            'confirmation_code' => $this->confirmation_code
        ]);
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($request->confirm_field != 'on')
            return back()->with('fail', trans('messages.register_accept'));

        if ($validator->fails()) {
            return back()->with('fail', trans('messages.register_fill_all'));
        }

        try {
            $user = $this->create($request->all());
        } catch (QueryException $e) {
            $user = null;
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('fail', trans('messages.register_email_taken'));
            }
        }

        if ($user instanceof User) {

            $_registerFields = $request->all();
            $_registerFieldIds = array();

            foreach ($_registerFields as $key => $value) {
                $registerFieldObject = Registerfield::where('key', $key)->first();
                if (is_object($registerFieldObject)) {
                    $user->registerfields()->attach($registerFieldObject, ['valueEntered' => $value]);
                    $_registerFieldIds[] = $registerFieldObject->id;
                }
            }
            $user->registerfields()->sync($_registerFieldIds);
        }

        try {
            $emailData = array(
                "confirmation_code" => $this->confirmation_code
            );

            Mail::send('emails.mailtest', $emailData, function ($message) use ($request) {
                $message->to($request->email, $request->name)
                    ->subject('Verify your email address');
            });
        } catch (\Swift_TransportException $e) {
            $response = $e->getMessage();
            return back()->with('fail', $response);
        }

        return back()->with('success', trans('messages.register_notification'));
    }

    /**
     * @param $confirmation_code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function verify($confirmation_code)
    {
        $user = User::where(['confirmation_code' => $confirmation_code])->get()->first();

        if ($user->confirmed)
            return redirect(App::getLocale() . $this->redirectTo);

        if (is_object($user)) {
            return view('front.pages.services', compact('user'));
        } else {
            return redirect(App::getLocale() . $this->redirectTo);
        }
    }

    /**
     */
    public function confirm(Request $request, User $user)
    {

        if ($request->term_acceptance_1 != '1') {
            return back()->with('fail', 'Please accept the terms of use.');
        }

        if ($request->confirm_field_service != 'on') {
            return back()->with('fail', 'Please accept the payment conditions.');
        }

        if ($request->bondtype == '') {
            return back()->with('fail', 'Please choose the service type.');
        }

        $user->bond_type = $request->bondtype;
        $user->term_acceptance_1 = $request->term_acceptance_1;
        $user->term_acceptance_2 = $request->confirm_field_service;
        $user->save();

        $_registerFields = $request->all();
        $_registerFieldIds = array();

        foreach ($user->registerfields as $registerfield) {
            $_registerFieldIds[] = $registerfield->id;
        }

        foreach ($_registerFields as $key => $value) {
            $registerFieldObject = Registerfield::where('key', $key)->get()->first();
            if (is_object($registerFieldObject)) {
                $user->registerfields()->attach($registerFieldObject, ['valueEntered' => $value]);
                $_registerFieldIds[] = $registerFieldObject->id;
            }
        }
        $user->registerfields()->sync($_registerFieldIds);

        $store = new Store();
        $store->store_name = "Empty Store " . uniqid();
        $store->save();

        /** @var User $user */
        $user->confirmed = 1;
        $user->store()->associate($store);
        $user->update();

        $package = Package::find($request->package_id);

        $profile = new Profile();
        $profile->store()->associate($store);
        $profile->package()->associate($package);
        $profile->save();

        return redirect($this->redirectTo)->with('success', 'You have created your store.');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
                'failed_login' => true,
            ]);
    }
}
