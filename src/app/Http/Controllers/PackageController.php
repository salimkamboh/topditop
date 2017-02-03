<?php

namespace App\Http\Controllers;

use App\FieldGroup;
use App\Package;
use App\Panel;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class PackageController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm()
    {
        $fieldGroups = FieldGroup::all();
        return view('packages.add-new')->with('fieldGroups', $fieldGroups);
    }

    /**
     * @param Package $package
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Package $package)
    {
        $panels = $package->panels;
        $panel_array_ids = array();
        $forbidden_gieldgroup_array_ids = array();
        foreach ($panels as $panel) {
            $panel_array_ids[] = $panel->id;
            $fieldGroups = $panel->fieldGroups;
            foreach ($fieldGroups as $fieldGroup) {
                $forbidden_gieldgroup_array_ids[] = $fieldGroup->id;
            }
        }

        $fieldGroups = FieldGroup::select()->whereNotIn('id', $forbidden_gieldgroup_array_ids)->get();
        return view('packages.edit')->with('package', $package)->with('fieldGroups', $fieldGroups);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $package = new Package();
        $package->name = $request->name;
        $package->save();

        $selectedFieldgroups = $request->selected_fieldgroups;

        $selectedArray = array();
        if (!empty($selectedFieldgroups)) {
            foreach ($selectedFieldgroups as $fieldgroup_id) {
                $selectedArray[] = $fieldgroup_id;
                $fieldGroup = FieldGroup::find($fieldgroup_id);
                $package->fieldGroups()->attach($fieldGroup);
            }
        }
        $package->fieldGroups()->sync($selectedArray);
        return back();
    }

    public function showAll()
    {
        $packages = Package::all();
        return view('packages.list')->with('packages', $packages);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        $packages = Package::all();
        return $packages;
    }

    /**
     * @param Package $package
     * @return Package
     */
    public function view(Package $package)
    {

        $response = [];
        try {
            $statusCode = 200;
            $package = Package::find($package->id);
            $response[] = $package;

        } catch (Exception $e) {
            $statusCode = 404;
        } finally {
            return response()->json($package); // Status code here
        }
    }

    /**
     * @param Package $package
     * @return Package
     */
    public function edit(Package $package, Request $request)
    {
        $response = [];
        try {
            $statusCode = 200;

            $package = Package::find($package->id);
            $package->name = $request->name;
            $package->save();

            $response[] = $package;

        } catch (Exception $e) {
            $statusCode = 404;
        } finally {
            return response()->json($package); // Status code here
        }
    }

    /**
     * @param Package $package
     * @return Package
     */
    public function editPackage(Package $package, Request $request)
    {
        $package->name = $request->name;

        $oldSelectedFields = $package->panels;

        foreach ($oldSelectedFields as $oldSelectedField) {
            $panel = Panel::find($oldSelectedField->id);
            $panel->package()->dissociate($package);
            $panel->save();
        }

        $selectedFields = $request->panels;

        if (!empty($selectedFields)) {
            foreach ($selectedFields as $panel_id) {
                $panel = Panel::find($panel_id);
                $panel->package()->associate($package);
                $panel->save();
            }
        }

        $package->save();
    }

    /**
     * @param Request $request
     * @return Package
     */
    public function insert(Request $request)
    {
        $package = new Package();
        $package->name = $request->name;
        $package->save();
        return $package;
    }

    /**
     * @param Request $request
     * @return Package
     */
    public function save(Request $request)
    {
        $package = new Package();
        $package->name = $request->name;

        $package->save();

        $selectedFields = $request->panels;

        if (!empty($selectedFields)) {
            foreach ($selectedFields as $panel_id) {
                $panel = Panel::find($panel_id);
                $panel->package()->associate($package);
                $panel->save();
            }
        }
        return $package;
    }

    /**
     * @param Package $package
     * @return mixed
     */
    public function delete(Package $package)
    {
        $package->delete();
    }
}