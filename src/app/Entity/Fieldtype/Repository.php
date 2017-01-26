<?php

namespace App\Entity\Fieldtype;

use App\Fieldtype;
use Illuminate\Http\Request;

class Repository
{
    /**
     * @param Request $request
     * @return Fieldtype
     */
    public function saveNew(Request $request)
    {
        $fieldType = new Fieldtype($request->all());
        $fieldType->save();
        return $fieldType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Fieldtype::all();
    }

    /**
     * @param Fieldtype $fieldtype
     * @return mixed
     */
    public function get(Fieldtype $fieldtype)
    {
        return Fieldtype::find($fieldtype->id);
    }

    /**
     * @param Request $request
     * @param Fieldtype $fieldtype
     * @return Fieldtype
     */
    public function update(Request $request, Fieldtype $fieldtype)
    {
        $fieldtype = Fieldtype::find($fieldtype->id);
        $fieldtype->name = $request->name;
        $fieldtype->save();
        return $fieldtype;
    }

}