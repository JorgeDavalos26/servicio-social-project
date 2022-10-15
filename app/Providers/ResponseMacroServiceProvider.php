<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
  public function boot()
  {
    Response::macro('success', function ($data, $status = 200) {
        return Response::json([
            'status'  => $status,
            'data' => $data,
            'error' => null
        ]);
    });

    Response::macro('error', function ($message, $status = 400) {
        return Response::json([
            'status'  => $status,
            'data' => null,
            'error' => $message,
        ], $status);
    });
  }
}