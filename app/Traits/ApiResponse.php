<?php

namespace App\Traits;

trait ApiResponse
{

    public function jsonResponse($message = "", $data = null, $code = 200, $error = null)
    {

        $data = array(
            'data' => $data,
            'message' => $message,
            'code' => $code,
            'status' => $code == 500 ? 'error' : 'success',
            'success' => $code == 500 ? false : true,
            'error' => !empty($error) ? $error->getMessage() : null,
            'line' => !empty($error) ? $error->getLine() : null
          );
      
          return response()->json($data, $code);
    }
}
