<?php

namespace App\Entity\Panel;

use App\FieldGroup;
use App\Package;
use App\Panel;
use Illuminate\Http\Request;

class Repository
{
    /**
     * @param Request $request
     * @return Panel
     */
    public function saveNew(Request $request)
    {
        $panel = new Panel($request->all());
        $panel->save();
        return $panel;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Panel::all();
    }

    /**
     * @param Panel $panel
     * @return mixed
     */
    public function get(Panel $panel)
    {
        return Panel::find($panel->id);
    }

    /**
     * @param Request $request
     * @param Panel $panel
     * @return Panel
     */
    public function update(Request $request, Panel $panel)
    {
        $panel->name = $request->name;
        $panel->key = $request->key;
        $panel->save();

        if (isset($request["fieldGroups"])) {

            $panel->fieldGroups()->detach();

            $id_fieldgroup_array = array();
            foreach ($request["fieldGroups"] as $_fieldGroup) {

                $fieldGroup = FieldGroup::where('id', $_fieldGroup)->get()->first();
                if (is_object($fieldGroup)) {
                    $id_fieldgroup_array[] = $fieldGroup->id;
                    $panel->fieldGroups()->attach($fieldGroup);
                }
            }
            $panel->fieldGroups()->sync($id_fieldgroup_array);
        }
        return $panel;
    }

    /**
     * @param Panel $panel
     * @return mixed
     */
    public function getAllFieldGroups(Panel $panel)
    {
        return $panel->fieldGroups;
    }

    /**
     * @param Package $package
     * @return mixed
     */
    public function getPanelsByPackage(Package $package)
    {
        return $package->panels;
    }

    /**
     * @param Panel $package
     */
    public function delete(Panel $panel)
    {
        $panel->delete();
    }
}