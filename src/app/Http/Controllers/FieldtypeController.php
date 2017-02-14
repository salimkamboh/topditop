<?php

namespace App\Http\Controllers;

use App\Entity\Fieldtype\Repository as FieldtypeRepository;
use App\Fieldtype;
use Illuminate\Http\Request;

class FieldtypeController extends BaseController
{

    /**
     * The fieldtype repository instance.
     */
    protected $fieldtypes;

    /**
     * FieldtypeController constructor.
     * @param FieldtypeRepository $fieldtypes
     */
    public function __construct(FieldtypeRepository $fieldtypes)
    {
        parent::__construct();
        $this->fieldtypes = $fieldtypes;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm()
    {
        $fieldtypes = Fieldtype::all();
        return view('fieldtypes.add-new', compact('fieldtypes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(Fieldtype $fieldtype)
    {
        $fieldtypes = Fieldtype::all();
        return view('fieldtypes.edit', compact('fieldtypes'))->with('fieldtype', $fieldtype);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function insert(Request $request)
    {
        if ($this->fieldtypes->saveNew($request))
            return back();
        else
            throw new \Exception("Something is not right", 400);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function save(Request $request)
    {
        return $this->fieldtypes->saveNew($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->fieldtypes->getAll();
    }

    /**
     * @param Fieldtype $fieldtype
     * @return mixed
     */
    public function view(Fieldtype $fieldtype)
    {
        return $this->fieldtypes->get($fieldtype);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, Fieldtype $fieldtype)
    {
        return $this->fieldtypes->update($request, $fieldtype);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function editSimple(Request $request, Fieldtype $fieldtype)
    {
        $editedFieldtype = $this->fieldtypes->update($request, $fieldtype);
        return view('fieldtypes.edit')->with('fieldtype', $editedFieldtype);
    }

    /**
     * @param Fieldtype $fieldtype
     * @return mixed
     */
    public function delete(Fieldtype $fieldtype)
    {
        $fieldtype->delete();
    }
}
