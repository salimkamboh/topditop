<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity\Product\Repository as ProductsRepository;
use App\Helpers\PowerChecker;
use App\Manufacturer;
use App\Product;
use App\Reference;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends BaseController
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var PowerChecker
     */
    protected $checker;

    /**
     * ProductsController constructor.
     * @param ProductsRepository $products
     * @param PowerChecker $checker
     */
    public function __construct(ProductsRepository $products, PowerChecker $checker)
    {
        parent::__construct();
        $this->products = $products;
        $this->checker = $checker;
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
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();();
        $availableReferences = Reference::all();
        $categories = Category::all();
        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $numberOfProducts = Product::where(['store_id' => $store->id])->count();
        return view('dashboard.products.single-product')
            ->with('store', $store)
            ->with('manufacturers', $manufacturers)
            ->with('availableReferences', $availableReferences)
            ->with('product', new Product())
            ->with('numberOfReferences', $numberOfReferences)
            ->with('numberOfProducts', $numberOfProducts)
            ->with('categories', $categories);
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->isNotReady())
            return redirect()->route('dashboard_home')->with('fail', 'Store Not Ready.');

        if ($this->checker->isLimitedUser($user))
            return redirect()->route('dashboard_home')->with('fail', trans('messages.please_upgrade'));

        $store = $this->current_store;
        $products = Product::where(['store_id' => $store->id])->orderBy('id', 'desc')->get();
        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $numberOfProducts = Product::where(['store_id' => $store->id])->count();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();();
        return view('dashboard.products.list')
            ->with('products', $products)
            ->with('store', $store)
            ->with('manufacturers', $manufacturers)
            ->with('numberOfReferences', $numberOfReferences)
            ->with('numberOfProducts', $numberOfProducts);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $user = Auth::user();
        if ($user->isNotReady())
            return redirect()->route('dashboard_home')->with('fail', 'Store Not Ready.');

        if ($this->checker->isLimitedUser($user))
            return redirect()->route('dashboard_home')->with('fail', trans('messages.please_upgrade'));


        $store = $this->current_store;
        if ($product->store->id != $store->id)
            return redirect()->route('dashboard_home');

        $references = $product->references;
        $store = $this->current_store;
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();();
        $manufacturerObject = $product->manufacturer;
        $selected_images = $product->images;
        $selected_categories = $product->categories;
        $selected_references = $product->references;
        $categories = Category::all();
        $numberOfReferences = Reference::where(['store_id' => $store->id])->count();
        $numberOfProducts = Product::where(['store_id' => $store->id])->count();


        $selectedReferencesIds = $selected_references->getQueueableIds();

        $availableReferences = Reference::active()->where('store_id', $store->id)
                                ->with('products')->get()
                                ->except($selectedReferencesIds);

        return view('dashboard.products.single-product')
            ->with('product', $product)
            ->with('store', $store)
            ->with('manufacturers', $manufacturers)
            ->with('categories', $categories)
            ->with('manufacturer', $manufacturerObject)
            ->with('references', $references)
            ->with('availableReferences', $availableReferences)
            ->with('numberOfReferences', $numberOfReferences)
            ->with('numberOfProducts', $numberOfProducts)
            ->with('selected_references', $selected_references)
            ->with('selected_images', $selected_images)
            ->with('selected_categories', $selected_categories);

    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * @param Store $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync(Store $store)
    {
        $productsMagento = $this->magentoActionsContract->getProducts($store);

        foreach ($productsMagento as $_product) {
            if ($this->products->isNew($_product, $store))
                $this->products->insert($_product, $store, $this->magentoActionsContract);
        }
        return back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function filter(Request $request)
    {
        $manufacturer_ids = $request->manufacturer_ids;
        $products = Product::whereIn('manufacturer_id', $manufacturer_ids)->get();
        return json_encode($products);
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function viewRest(Product $product)
    {
        return $this->products->retrieveRest($product);
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function view(Product $product)
    {
        return $this->products->retrieve($product);
    }

    /**
     * @return mixed
     */
    public function viewAll()
    {
        return $this->products->viewAll();
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Product $product)
    {
        $this->products->delete($product);
        return back();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function viewReferences(Product $product)
    {
        return $this->products->getAllReferences($product);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function viewCategories(Product $product)
    {
        return $this->products->getAllCategories($product);
    }

    public function viewImages(Product $product)
    {
        return $this->products->getAllImages($product);
    }


    public function insertProductRest(Request $request)
    {
        return $this->products->insertProductRest($request, false);
    }

    public function updateProductRest(Request $request, Product $product)
    {
        return $this->products->updateProductRest($product, $request, true);
    }


    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRest(Product $product)
    {
        $this->products->delete($product);
    }

}
