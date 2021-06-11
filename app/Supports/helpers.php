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

