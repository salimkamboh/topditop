<?php

namespace App\Entity\Category;

use App\Category;
use Illuminate\Http\Request;

class Repository
{
    /**
     * @param Request $request
     * @return Category
     */
    public function saveNew(Request $request)
    {
        $category = new Category($request->all());
        $category->save();
        return $category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function get(Category $category)
    {
        return Category::find($category->id);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return Category
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return $category;
    }


    /**
     * @param Category $category
     */
    public function delete(Category $category)
    {
        $category->delete();
    }
}