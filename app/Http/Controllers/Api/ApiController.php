<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    /**
     * Api response data
     *
     * @param $success
     * @param $message
     * @param null $data
     * @param int $code
     * @return array
     */
    protected function apiResponse($success, $message, $data = null, $code = 200) {
        return ['from' => url('/'), 'success' => $success, 'message' => $message, 'code' => $code, 'data' => $data];
    }
}
