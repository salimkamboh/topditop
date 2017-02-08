<?php

namespace App\Http\Controllers;

use App\Entity\Field\Repository as FieldRepository;
use App\Field;
use App\FieldGroup;
use App\Fieldtype;
use Illuminate\Http\Request;

class FieldController extends BaseController
{

    /**
     * The field repository instance.
     */
    protected $fields;

    /**
     * FieldController constructor.
     * @param FieldRepository $fields
     */
    public function __construct(FieldRepository $fields)
    {
        parent::__construct();
        $this->fields = $fields;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm()
    {
        $fieldtypes = Fieldtype::all();
        $fields = Field::all();
        return view('fields.add-new', compact('fieldtypes'))->with('fields', $fields);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(Field $field)
    {
        $fieldtypes = Fieldtype::all();
        return view('fields.edit', compact('fieldtypes'))->with('field', $field);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function insert(Request $request)
    {
        if ($this->fields->saveNew($request))
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
        return $this->fields->saveNew($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->fields->getAll();
    }

    /**
     * @return mixed
     */
    public function viewAllFree()
    {
        $fields = Field::where('field_group_id', null)->get();
        return $fields;
    }

    /**
     * @param FieldGroup $fieldGroup
     * @return mixed
     */
    public function viewAllFreeTaken(FieldGroup $fieldGroup)
    {
        $fields = Field::where('field_group_id', null)->orWhere('field_group_id', $fieldGroup->id)->get();
        return $fields;
    }

    /**
     * @param Field $field
     * @return mixed
     */
    public function view(Field $field)
    {
        return $this->fields->get($field);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, Field $field)
    {
        return $this->fields->update($request, $field);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function editSimple(Request $request, Field $field)
    {
        $editedField = $this->fields->update($request, $field);
        $fieldtypes = Fieldtype::all();
        return view('fields.edit', compact('fieldtypes'))->with('field', $editedField);
    }

    /**
     * @param Field $field
     * @return mixed
     */
    public function delete(Field $field)
    {
        return $this->fields->delete($field);
    }
}
