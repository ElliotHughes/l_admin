<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Cookie;

class User extends Controller
{
    public function index(Request $request)
    {
        $userName = $request->post('username');
        $password = $request->post('password');
        $res = UserModel::factory()
            ->newModel()
            ->newQuery()
            ->where('name', $userName)
            ->where('password', $password)
            ->first();

        $domain = $request->getHost(); // 获取当前请求的域名

        // 创建一个 Cookie 实例
        $cookie = Cookie::make('name', 'value', 10, '/', $domain);
        $this->response->getOrginResponse()->withCookie($cookie);
        return $this->success($res);
    }
}
