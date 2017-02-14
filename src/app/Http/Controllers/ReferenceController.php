<?php

namespace App\Http\Controllers;

use App\Entity\Reference\Repository as ReferenceRepository;
use App\Helpers\PowerChecker;
use App\Product;
use App\Reference;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends BaseController
{
    /**
     * @var ReferenceRepository
     */
    protected $reference;

    /**
     * @var PowerChecker
     */
    protected $checker;

    /**
     * ReferenceController constructor.
     * @param ReferenceRepository $referenceRepository
     * @param PowerChecker $checker
     */
    public function __construct(ReferenceRepository $referenceRepository, PowerChecker $checker)
    {
        parent::__construct();
        $this->reference = $referenceRepository;
        $this->checker = $checker;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isNotReady())
            return redirect()->route('dashboard_home')->with('fail', 'Store Not Ready.');

        if ($this->checker->isLimitedUser($user))
            return redirect()->route('dashboard_home')->with('fail', trans('messages.please_upgrade'));

        $store = $this->current_store;
        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $references = Reference::where(['store_id' => $store->id])->orderBy('id', 'desc')->get();
        return view('dashboard.references.list')
            ->with('store', $store)
            ->with('references', $references)
            ->with('numberOfReferences', $numberOfReferences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->isNotReady())
            return redirect()->route('dashboard_home')->with('fail', 'Store Not Ready.');

        if ($this->checker->isLimitedUser($user))
            return redirect()->route('dashboard_home')->with('fail', trans('messages.please_upgrade'));

        $store = $this->current_store;
        $availableProducts = Product::where(['store_id' => $store->id])->get();
        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $numberOfProducts = Product::where(['store_id' => $store->id])->count();
        $manufacturers = $store->manufacturers;

        if ($store->package_name() == 'TopDiTop Store') {
            $allowed_images = 7;
        } else if ($store->package_name() == 'TopStore') {
            $allowed_images = 1;
        } else {
            $allowed_images = 0;
        }

        return view('dashboard.references.single-reference')
            ->with('availableProducts', $availableProducts)
            ->with('numberOfReferences', $numberOfReferences)
            ->with('numberOfProducts', $numberOfProducts)
            ->with('store', $store)
            ->with('manufacturers', $manufacturers)
            ->with('allowed_images', $allowed_images)
            ->with('reference', new Reference());
    }

    public function edit(Reference $reference)
    {
        $user = Auth::user();
        if ($user->isNotReady())
            return redirect()->route('dashboard_home')->with('fail', 'Store Not Ready.');

        if ($this->checker->isLimitedUser($user))
            return redirect()->route('dashboard_home')->with('fail', trans('messages.please_upgrade'));

        $store = $this->current_store;
        if ($reference->store->id != $store->id)
            return redirect()->route('dashboard_home');

        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $numberOfProducts = Product::where(['store_id' => $store->id])->count();
        $manufacturers = $store->manufacturers;
        $selected_images = Reference::find($reference->id)->images()->get();
        $selected_products = Reference::find($reference->id)->products()->get();

        $forbidden = array();
        foreach ($selected_products as $selected_product) {
            $forbidden[] = $selected_product->id;
        }

        /** @var Collection $availableProducts */
        $availableProducts = Product::with('references')->whereNotIn('id', $forbidden)->get();
        $collection = new Collection();

        /** @var Product $availableProduct */
        foreach ($availableProducts as $availableProduct) {
            if ($availableProduct->store->id == $store->id) {
                $collection->add($availableProduct);
            }
        }

        if ($store->package_name() == 'TopDiTop Store') {
            $allowed_images = 7;
        } else if ($store->package_name() == 'TopStore') {
            $allowed_images = 1;
        } else {
            $allowed_images = 0;
        }

        return view('dashboard.references.single-reference')
            ->with('reference', $reference)
            ->with('availableProducts', $collection)
            ->with('numberOfReferences', $numberOfReferences)
            ->with('numberOfProducts', $numberOfProducts)
            ->with('store', $store)
            ->with('manufacturers', $manufacturers)
            ->with('selected_products', $selected_products)
            ->with('allowed_images', $allowed_images)
            ->with('selected_images', $selected_images);
    }

    public function unpublish(Reference $reference)
    {
        $reference->status = 0;
        $reference->save();
        return back();
    }

    public function publish(Reference $reference)
    {
        $reference->status = 1;
        $reference->save();
        return back();
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function delete(Reference $reference)
    {
        $this->reference->delete($reference);
        return back();
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function view(Reference $reference)
    {
        return $this->reference->retrieve($reference);
    }

    public function disconnectProduct(Reference $reference, Product $product, Request $request)
    {
        $reference->products()->detach($product);
        $reference->save();
        return back()->with('success', 'Product deleted from reference.');
    }

    public function viewAll()
    {
        return $this->reference->getAll();
    }

    public function viewImages(Reference $reference)
    {
        return $this->reference->getAllImages($reference);
    }

    public function viewProducts(Reference $reference)
    {
        return $this->reference->getAllProducts($reference);
    }

    public function viewManufacturers(Reference $reference)
    {
        return $this->reference->getAllManufacturers($reference);
    }

    /**
     * @param Request $request
     * @param Reference $reference
     * @return Reference
     */
    public function updateReferenceRest(Request $request, Reference $reference)
    {
        return $this->reference->updateReferenceRest($reference, $request, true);
    }

    public function insertReferenceRest(Request $request)
    {
        return $this->reference->insertReferenceRest($request, false);
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function deleteRest(Reference $reference)
    {
        $this->reference->delete($reference);
    }
}
