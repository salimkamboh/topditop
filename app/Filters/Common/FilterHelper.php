<?php

namespace App\Filters\Common;

use App\Store;
use Illuminate\Http\Request;

interface FilterHelper {

    public function identifyCase(Request $request);

    public function applyFilter(Request $request);

    public function buildReturnObject($entity);
}