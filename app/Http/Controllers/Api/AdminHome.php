<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminHome extends Controller
{
    public function index()
    {
        $result = DB::table('users')->select()->get()->toArray();
        return response()->json($result);
    }
}
