<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
  public function boot()
  {
    Response::macro('success', function ($data, $additionalData = null, $status = 200) {
      $res = [
        'status'  => $status,
        'data' => $data,
        'error' => null
      ];
      if (is_array($additionalData)) {
        $res = array_merge($res, ["additional_data" => $additionalData]);
      }
      return Response::json($res);
    });

    Response::macro('error', function ($message, $additionalData = null, $status = 400) {
      return Response::json([
          'status'  => $status,
          'data' => null,
          'error' => $message,
      ], $status);
    });
  }
}