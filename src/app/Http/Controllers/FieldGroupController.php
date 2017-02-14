<?php

namespace App\Http\Controllers;

use App\Entity\Fieldgroup\Repository as FieldGroupRepository;
use App\Field;
use App\FieldGroup;
use Illuminate\Http\Request;


class FieldGroupController extends BaseController
{

    /**
     * The fieldGroup repository instance.
     */
    protected $fieldGroups;

    /**
     * FieldGroupController constructor.
     * @param FieldGroupRepository $fieldGroups
     */
    public function __construct(FieldGroupRepository $fieldGroups)
    {
        parent::__construct();
        $this->fieldGroups = $fieldGroups;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm()
    {
        $fieldGroups = FieldGroup::all();
        $fields = Field::where('field_group_id', null)->get();
        return view('fieldgroups.add-new')->with('fieldGroups', $fieldGroups)->with('fields', $fields);
    }

    /**
     * @param FieldGroup $fieldGroup
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(FieldGroup $fieldGroup)
    {
        $free_fields = Field::where('field_group_id', null)->get();
        $fields = $fieldGroup->fields;
        $fields = $free_fields->merge($fields);
        $selectedFields = array();
        foreach ($fieldGroup->fields as $field) {
            $selectedFields[] = $field->id;
        }
        return view('fieldgroups.edit', compact('fields'))->with('fieldGroup', $fieldGroup)->with('selectedFields', $selectedFields);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function insert(Request $request)
    {
        if ($this->fieldGroups->saveNew($request))
            return back();
        else
            throw new \Exception("Something is not right", 400);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function save(Request $request)
    {
        return $this->fieldGroups->saveNew($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->fieldGroups->getAll();
    }

    /**
     * @param FieldGroup $fieldGroup
     * @return mixed
     */
    public function view(FieldGroup $fieldGroup)
    {
        return $this->fieldGroups->get($fieldGroup);
    }

    /**
     * @param Request $request
     * @param FieldGroup $fieldGroup
     * @return FieldGroup
     */
    public function edit(Request $request, FieldGroup $fieldGroup)
    {
        return $this->fieldGroups->update($request, $fieldGroup);
    }

    /**
     * @param FieldGroup $fieldGroup
     * @return mixed
     */
    public function delete(FieldGroup $fieldGroup)
    {
        return $this->fieldGroups->delete($fieldGroup);
    }

    /**
     * @param Request $request
     * @param FieldGroup $fieldGroup
     * @return mixed
     */
    public function editSimple(Request $request, FieldGroup $fieldGroup)
    {
        $editedFieldGroup = $this->fieldGroups->update($request, $fieldGroup);
        $free_fields = Field::where('field_group_id', null)->get();
        $fields = $editedFieldGroup->fields;
        $fields = $free_fields->merge($fields);
        $selectedFields = array();
        foreach ($fieldGroup->fields as $field) {
            $selectedFields[] = $field->id;
        }

        return redirect()->action('FieldGroupController@showEditForm', $editedFieldGroup)->with('fields', $fields)->with('selectedFields', $selectedFields);
    }
}
