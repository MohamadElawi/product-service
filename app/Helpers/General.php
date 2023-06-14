<?php

if (!function_exists('success')) {
    function success($message): \Illuminate\Http\Response
    {
        return response([
            'success' => true,
            'message' => $message,
        ], 200);
    }
}

if (!function_exists('failure')) {
    function failure($message, $status): \Illuminate\Http\Response
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
if (!function_exists('returnData')) {
    function returnData($key, $value, $pagination = null, $message = ""): \Illuminate\Http\Response
    {
        $response = [
            'success' => true,
            'message' => $message,
            $key => $value
        ];

        if ($pagination != null)
            $response['pagination'] = $pagination;

        return response($response, 200);
    }
}
