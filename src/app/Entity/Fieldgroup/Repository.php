<?php

namespace App\Entity\FieldGroup;

use App\Field;
use App\FieldGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Repository
{
    /**
     * @param Request $request
     * @return FieldGroup
     */
    public function saveNew(Request $request)
    {
        $locale = App::getLocale();
        $fieldGroup = new FieldGroup();
        $fieldGroup->translateOrNew($locale)->name = $request->name;
        $fieldGroup->cssclass = $request->cssclass;

        $fieldGroup->save();

        $selectedFields = $request->fields;

        if (!empty($selectedFields)) {
            foreach ($selectedFields as $field_id) {
                $field = Field::find($field_id);
                $field->fieldGroup()->associate($fieldGroup);
                $field->save();
            }
        }

        return $fieldGroup;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return FieldGroup::all();
    }

    /**
     * @param FieldGroup $fieldGroup
     * @return mixed
     */
    public function get(FieldGroup $fieldGroup)
    {
        return FieldGroup::with('Fields')->where('id', $fieldGroup->id)->get()->first();
    }

    /**
     * @param Request $request
     * @param FieldGroup $fieldGroup
     * @return FieldGroup
     */
    public function update(Request $request, FieldGroup $fieldGroup)
    {
        $fieldGroup->name = $request->name;
        $fieldGroup->cssclass = $request->cssclass;

        $newSelectedFields = $request->fields;
        $selectedFields = $fieldGroup->fields;

        if (!empty($selectedFields->toArray())) {
            foreach ($selectedFields->toArray() as $field_id) {
                $field = Field::find($field_id["id"]);
                $field->fieldGroup()->dissociate();
                $field->save();
            }
        }

        if (!empty($newSelectedFields)) {
            foreach ($newSelectedFields as $field_id) {
                $field = Field::find($field_id);
                $field->fieldGroup()->associate($fieldGroup);
                $field->save();
            }
        }

        $fieldGroup->save();
        return $fieldGroup;
    }

    public function delete(FieldGroup $fieldGroup)
    {
        $fieldGroup->delete();
    }
}