<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseHandler
{
    public function errorProcessor($validator): array
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $errors[] = ['error_code' => $index, 'message' => $error[0]];
        }
        return $errors;
    }
    public function sendResponse(object|array|null $result , string|null $message ):JsonResponse
    {
        $response = [
            'success'  => true,
            'data'     => $result,
            'message'  => $message,
        ];
        return response()->json($response,200);
    }


    public function sendError(string|null$error  ,$code = 404):JsonResponse
    {

        $response = [
            'success'       => false,
            'message'       => $error,
        ];
        return response()->json($response,$code);
    }


}
