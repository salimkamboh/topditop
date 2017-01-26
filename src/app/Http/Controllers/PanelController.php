<?php

namespace App\Http\Controllers;

use App\FieldGroup;
use App\Package;
use Illuminate\Http\Request;

use App\Panel;
use App\Entity\Panel\Repository as PanelRepository;
use Illuminate\Support\Facades\App;


class PanelController extends BaseController
{

    /**
     * The fieldGroup repository instance.
     */
    protected $panels;

    /**
     * PanelController constructor.
     * @param PanelRepository $panels
     */
    public function __construct(PanelRepository $panels)
    {
        parent::__construct();
        $this->panels = $panels;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->panels->getAll();
    }

    /**
     * @param Panel $panel
     * @return mixed
     */
    public function view(Panel $panel)
    {
        return $this->panels->get($panel);
    }

    /**
     * @param Request $request
     * @param Panel $panel
     * @return Panel
     */
    public function edit(Request $request, Panel $panel)
    {
        return $this->panels->update($request, $panel);
    }

    public function save(Request $request)
    {
        $locale = App::getLocale();

        $panel = new Panel();
        $panel->key = $request->key;
        $panel->translateOrNew($locale)->name = $request->name;
        $panel->save();

        if (isset($request["fieldGroups"])) {
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
    }

    /**
     * @param Panel $panel
     * @return mixed
     */
    public function viewFieldGroups(Panel $panel)
    {
        return $this->panels->getAllFieldGroups($panel);
    }

    /**
     * @param Package $package
     * @return mixed
     */
    public function viewPanelsByPackage(Package $package)
    {
        return $this->panels->getPanelsByPackage($package);
    }

    /**
     * @param Panel $panel
     */
    public function delete(Panel $panel)
    {
        return $this->panels->delete($panel);
    }
}
