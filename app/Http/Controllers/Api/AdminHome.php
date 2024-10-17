<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use App\Jobs\users;
use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHome extends Controller
{
    public function index(Request $request)
    {
        /**
         * @var Podcast $result
         */
        $result = Podcast::where('id', '1')->first();
        $res = [
            'id' => $result->id,
            'name' => $result->name,
            'created_at2' => $result->created_at->toDateTimeString(),
            'updated_at' => $result->updated_at->toDateTimeString(),
        ];
        ProcessPodcast::dispatch($res);
        return $this->success($res);
    }
}
