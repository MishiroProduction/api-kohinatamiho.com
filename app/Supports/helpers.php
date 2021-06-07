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
        if (\Auth::guard('web')->check()) {
            return $key ? \Auth::guard('web')->user()->getAttribute($key) : \Auth::guard('web')->user();
        }

        return null;
    }
}

