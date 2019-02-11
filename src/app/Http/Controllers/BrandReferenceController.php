<?php

namespace App\Http\Controllers;

use App\BrandReference;
use App\Category;
use App\Http\Requests\BrandReferenceStoreRequest;
use App\Manufacturer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class BrandReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        return response()->json($manufacturer->brandReferences);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param BrandReferenceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, BrandReferenceStoreRequest $request)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $categoryId = $request->get('category_id');
        $category = Category::find($categoryId);

        $reference = new BrandReference();
        $reference->title = $request->get('title');
        $reference->description = $request->get('description');
        $reference->manufacturer_id = $manufacturer->id;
        if ($category instanceof Category) {
            $reference->category_id = $category->id;
        } else {
            $reference->category_id = null;
        }
        $reference->save();

        $image = $request->file('image');

        $name = 'brandreference_' . $reference->id . '_' . str_random(6);
        $largeName = $name . '.' . $image->getClientOriginalExtension();
        $thumbnailName = $name . '.300xAUTO.' . $image->getClientOriginalExtension();

        $largeImageRelativePath = 'full_size/' . $largeName;
        $thumbnailImageRelativePath = 'full_size/' . $thumbnailName;
        $binary = file_get_contents($image->getRealPath());
        Storage::disk('images')->put($largeImageRelativePath, $binary);

        $manager = new ImageManager();
        $manager->make($binary)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(base_path('images/') . $thumbnailImageRelativePath);

        $reference->image_url = $largeImageRelativePath;
        $reference->save();

        // TODO: handle image upload

        return response()->json($reference, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $referenceId
     * @return \Illuminate\Http\Response
     */
    public function show($id, $referenceId)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer instanceof  Manufacturer) {
            throw new ModelNotFoundException();
        }

        $reference = $manufacturer->brandReferences->find($referenceId);

        if (!$reference instanceof BrandReference) {
            throw new ModelNotFoundException();
        }

        return response()->json($reference);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $referenceId
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, $referenceId)
    {
        // TODO: handle replacing old image
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $referenceId
     * @param  \Illuminate\Http\Request  $request
     * @throws
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $referenceId, Request $request)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer instanceof Manufacturer) {
            throw new ModelNotFoundException();
        }

        $reference = $manufacturer->brandReferences->find($referenceId);

        if (!$reference instanceof BrandReference) {
            throw new ModelNotFoundException();
        }

        // TODO: handle query param to delete image from disk

        $relativeImagePath = $reference->image_url;

        if ($reference->delete()) {
            Storage::disk('images')->delete($relativeImagePath);
            return response()->json([], 204);
        } else {
            return response()->json([
                'error' => 'failed to delete BrandReference'
            ]);
        }
    }
}
