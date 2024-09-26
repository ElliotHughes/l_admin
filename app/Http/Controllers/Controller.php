<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Support\Response;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    protected Response $response;

    public function __construct()
    {
        $this->init();
    }

    /**
     * 初始化实例 Response 对象
     */
    final public function init()
    {
        if (config('app.debug')) {
            DB::enableQueryLog();
        }
        $this->response = new Response();
    }

    public function success($arr=[])
    {
        return $this->response->send($arr);
    }

}
