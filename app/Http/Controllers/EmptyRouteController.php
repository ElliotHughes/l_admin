<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmptyRouteController extends Controller
{
    public function handle(Request $request)
    {
        return $this->success();
    }
}
