<?php

namespace App\Http\Controllers;

use App\Entity\Slide\Repository as SlideRepository;
use App\Slide;
use Illuminate\Http\Request;


class SlideController extends BaseController
{

    /**
     * The fieldGroup repository instance.
     */
    protected $slides;

    /**
     * SlideController constructor.
     * @param SlideRepository $slides
     */
    public function __construct(SlideRepository $slides)
    {
        parent::__construct();
        $this->slides = $slides;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->slides->getAll();
    }

    /**
     * @param Slide $slide
     * @return mixed
     */
    public function view(Slide $slide)
    {
        return $this->slides->get($slide);
    }

    /**
     * @param Request $request
     * @param Slide $slide
     * @return Slide
     */
    public function edit(Request $request, Slide $slide)
    {
        return $this->slides->update($request, $slide);
    }

    /**
     * @param Request $request
     * @return Slide
     */
    public function save(Request $request)
    {
        return $this->slides->saveNew($request);
    }

    /**
     * @param Slide $slide
     * @return bool|null
     */
    public function delete(Slide $slide)
    {
        return $this->slides->delete($slide);
    }
}
