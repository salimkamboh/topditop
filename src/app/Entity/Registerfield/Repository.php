<?php

namespace App\Entity\Registerfield;

use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Registerfield;

class Repository
{
    /**
     * @param Request $request
     * @return Registerfield
     */
    public function saveNew(Request $request)
    {
        Log::error($request->all());
        $registerfield = new Registerfield($request->all());
        $registerfield->save();
        return $registerfield;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Registerfield::all();
    }

    public function getAllUsers() {
        return User::with('registerfields')->get();
    }

    /**
     * @param Registerfield $registerfield
     * @return mixed
     */
    public function get(Registerfield $registerfield)
    {
        return Registerfield::find($registerfield->id);
    }

    /**
     * @param Request $request
     * @param Registerfield $registerfield
     * @return Registerfield
     */
    public function update(Request $request, Registerfield $registerfield)
    {
        $registerfield->update($request->all());
        return $registerfield;
    }

}