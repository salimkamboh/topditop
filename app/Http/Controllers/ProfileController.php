<?php

namespace App\Http\Controllers;

use App\Checkbox;
use App\Field;
use App\Package;
use App\Profile;
use App\Store;
use App\Image;

use DB;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends BaseController
{

    /**
     * @param Profile $profile
     * @return $this
     */
    public function index(Profile $profile)
    {
        return view('profile.show', compact('profile'));
    }

    /**
     * @param Request $request
     * @param Profile $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(Request $request, Profile $profile)
    {
        return $profile->saveProfile($request);
    }
}
