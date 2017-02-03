<?php

namespace App\Entity\Field;

use App\Field;
use App\Fieldtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Repository
{
    /**
     * @param Request $request
     * @return Field
     */
    public function saveNew(Request $request)
    {
        $locale = App::getLocale();
        $fieldType = Fieldtype::find($request->fieldtype_id);
        $field = new Field();
        $field->key = $request->key;
        $field->cssclass = $request->cssclass;
        $field->fieldtype()->associate($fieldType);
        $field->translateOrNew($locale)->name = $request->name;
        $field->translateOrNew($locale)->values = $request->values;
        $field->save();
        return $field;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Field::all();
    }

    /**
     * @param Field $field
     * @return mixed
     */
    public function get(Field $field)
    {
        return Field::find($field->id);
    }

    /**
     * @param Request $request
     * @param Field $field
     * @return Field
     */
    public function update(Request $request, Field $field)
    {
        $field = Field::find($field->id);
        $field->key = $request->key;
        $field->name = $request->name;
        $field->values = $request->values;
        $field->cssclass = $request->cssclass;
        $fieldType = Fieldtype::find($request->fieldtype_id);
        $field->fieldtype()->dissociate();
        $field->fieldtype()->associate($fieldType);
        $field->save();
        return $field;
    }

    public function delete(Field $field)
    {
        $field->delete();
    }

}