<?php

namespace App\Http\Controllers;

use App\Entity\Registerfield\Repository as RegisterfieldRepository;
use App\Registerfield;
use Illuminate\Http\Request;


class RegisterfieldController extends BaseController
{

    /**
     * The fieldGroup repository instance.
     */
    protected $registerfields;

    /**
     * RegisterfieldController constructor.
     * @param RegisterfieldRepository $registerfields
     */
    public function __construct(RegisterfieldRepository $registerfields)
    {
        parent::__construct();
        $this->registerfields = $registerfields;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->registerfields->getAll();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAllUsers()
    {
        return $this->registerfields->getAllUsers();
    }

    /**
     * @param Registerfield $registerfield
     * @return mixed
     */
    public function view(Registerfield $registerfield)
    {
        return $this->registerfields->get($registerfield);
    }

    /**
     * @param Request $request
     * @param Registerfield $registerfield
     * @return Registerfield
     */
    public function edit(Request $request, Registerfield $registerfield)
    {
        return $this->registerfields->update($request, $registerfield);
    }

    public function save(Request $request)
    {
        return $this->registerfields->saveNew($request);
    }

    public function delete($id)
    {
        if ($this->registerfields->delete($id)) {
            return response()->json([], 204);
        }

        return response()->json([
            'error' => 'Unable to delete register field'
        ], 409);
    }
}
