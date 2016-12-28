<?php

namespace App\Http\Controllers;

use App\FieldGroup;
use App\Image;
use App\Package;
use App\Panel;
use App\Product;
use App\Reference;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Entity\Image\ImageRepository;
use App\Entity\Reference\Repository as ReferenceRepository;
use App\Entity\Product\Repository as ProductRepository;
use App\Entity\Store\Repository as StoreRepository;
use Illuminate\Support\Facades\Mail;

class AjaxController extends BaseController
{

    protected $image;
    protected $reference;
    protected $product;
    protected $stores;

    public function __construct(ImageRepository $imageRepository, ReferenceRepository $referenceRepository, ProductRepository $productRepository, StoreRepository $storeRepository)
    {
        parent::__construct();
        $this->image = $imageRepository;
        $this->reference = $referenceRepository;
        $this->product = $productRepository;
        $this->stores = $storeRepository;
    }

    public function savePackage(Request $request)
    {
        $package = new Package();
        $package->name = $request->package_name;
        $package->save();

        foreach ($request->panels as $_panel) {
            $panel = new Panel();
            $panel->name = $_panel["panel_name"];
            $panel->package()->associate($package);
            $panel->save();

            $id_fieldgroup_array = array();
            foreach ($_panel["fieldGroups"] as $_fieldGroup) {

                $fieldGroup = FieldGroup::where('id', $_fieldGroup)->get()->first();
                if (is_object($fieldGroup)) {
                    $id_fieldgroup_array[] = $fieldGroup->id;
                    $panel->fieldGroups()->attach($fieldGroup);
                }
            }
            $panel->fieldGroups()->sync($id_fieldgroup_array);
        }

        redirect()->route('show_package', [$package]);
    }

    public function editPackage(Request $request, Package $package)
    {
        $package->name = $request->package_name;

        foreach ($request->panels as $_panel) {

            if (empty($_panel["panel_db_id"])) {
                $panel = new Panel();
            } else {
                $panel = Panel::find($_panel["panel_db_id"]);
            }

            $panel->name = $_panel["panel_name"];
            $panel->package()->associate($package);

            if (empty($_panel["panel_db_id"]))
                $panel->save();

            $id_fieldgroup_array_new = array();
            $panel->fieldGroups()->detach();
            foreach ($_panel["fieldGroups"] as $_fieldGroup) {

                $fieldGroup = FieldGroup::find($_fieldGroup);

                if (is_object($fieldGroup)) {
                    $id_fieldgroup_array_new[] = $fieldGroup->id;
                    $panel->fieldGroups()->attach($fieldGroup);
                }
            }
            $panel->fieldGroups()->sync($id_fieldgroup_array_new);
        }

        redirect()->route('show_package', [$package]);
    }

    public function uploadImages(Request $request)
    {
        return $this->image->upload($request->all());
    }

    public function insertReference(Request $request)
    {
        return $this->reference->insert($request, $this->current_store);
    }

    public function updateReference(Reference $reference, Request $request)
    {
        $request->session()->flash('success', trans('messages.reference_updated'));
        return $this->reference->update($request, $reference);
    }

    public function deleteImage(Request $request, Image $image)
    {
        return $this->image->delete($image, $request);
    }

    public function deleteProductImage(Request $request, Image $image)
    {
        return $this->image->deleteProductImage($image, $request);
    }

    public function insertProduct(Request $request)
    {
        return $this->product->insert($request, $this->current_store);
    }

    public function updateProduct(Product $product, Request $request)
    {
        $request->session()->flash('success', trans('product_updated'));
        return $this->product->update($request, $product);
    }

    public function contactPageSend(Request $request) {

        try {
            $emailData = array(
                "customer_name" => $request->customer_name,
                "customer_email" => $request->customer_email,
                "customer_message" => $request->customer_message,
                "customer_phone" => $request->customer_phone
            );

            Mail::send('emails.contact_email', $emailData, function ($message) use ($request) {
                $message->to($request->customer_email, "Top Di Top Contact")
                    ->subject('Contact form submission');
            });

            return back()->with('success', 'Thank you.');
        } catch (\Swift_TransportException $e) {
            $response = $e->getMessage();
            return back()->with('fail', $response);
        }
    }
}