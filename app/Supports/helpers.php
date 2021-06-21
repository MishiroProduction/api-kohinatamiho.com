<?php

if (! function_exists('me')) {
    /**
     * Function return current user who logged in
     *
     * @param string $key
     * @return mixed|null
     */
    function me($key = null)
    {
        if (\Auth::guard('api')->check()) {
            return $key ? \Auth::guard('api')->user()->getAttribute($key) : \Auth::guard('api')->user();
        }

        return null;
    }
}

if (! function_exists('apiErrorResponse')) {
    function apiErrorResponse($key)
    {
        $errors = config('api_errors');
        if (!isset($errors[$key])) {
            return [
                'body' => [
                    'status' => false,
                    'message' => 'undefined error @ /config/api_errors.php',
                    'errors' => [
                        'type' => 'unknown_error',
                    ],
                    'data' => null,
                ],
                'response_code' => 400,
            ];
        }
        $ret = [];
        $ret['body'] = [];
        $ret['body']['status'] = $errors[$key]['status'] ?? false;
        $ret['body']['message'] = $errors[$key]['message'] ?? '';
        $ret['body']['errors'] = isset($errors[$key]['type']) ? ['type' => $errors[$key]['type']] : [];
        if (isset($errors[$key]['errors'])) {
            $ret['body']['errors'] = array_merge($ret['body']['errors'], $errors[$key]['errors']);
        }
        $ret['body']['data'] = $errors[$key]['data'] ?? [];
        $ret['response_code'] = $errors[$key]['response_code'] ?? 500;
        return $ret;
    }
}

if (! function_exists('genRandStr')) {
    function genRandStr(
        $length,
        $charSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
    ) {
        $randMax =  strlen($charSet) - 1;
        $retStr = '';
        for ($i = 0; $i < $length; ++$i) {
            $retStr .= $charSet[rand(0, $randMax)];
        }
        return $retStr;
    }
}
