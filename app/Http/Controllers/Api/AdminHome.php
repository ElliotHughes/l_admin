<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminHome extends Controller
{
    public function index()
    {
        $result = Db::table('users')->select()->get();

        return $this->success($result);
    }
}
