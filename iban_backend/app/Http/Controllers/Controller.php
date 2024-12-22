<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ise(\Throwable $th) {
        Log::error($th);
        return response()->json([
            'success' => false,
            'message' => trans('message.something_went_wrong'),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
