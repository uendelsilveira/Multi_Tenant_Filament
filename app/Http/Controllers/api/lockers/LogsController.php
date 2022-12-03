<?php

namespace App\Http\Controllers\api\lockers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLog(Request $request)
    {
        /** @var Locker $locker */
        $locker = $request->get("lockerModel");
        return new Response();
    }
}
