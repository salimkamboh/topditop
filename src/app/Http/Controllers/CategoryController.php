<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity\Category\Repository as CategoryRepository;
use Illuminate\Http\Request;


class CategoryController extends BaseController
{

    /**
     * The fieldGroup repository instance.
     */
    protected $categories;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categories
     */
    public function __construct(CategoryRepository $categories)
    {
        parent::__construct();
        $this->categories = $categories;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->categories->getAll();
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function view(Category $category)
    {
        return $this->categories->get($category);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return Category
     */
    public function edit(Request $request, Category $category)
    {
        return $this->categories->update($request, $category);
    }

    public function save(Request $request)
    {
        return $this->categories->saveNew($request);
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function delete(Category $category)
    {
        return $this->categories->delete($category);
    }

}
