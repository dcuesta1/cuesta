<?php

namespace Api\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class LowercaseStrings extends TransformsRequest
{
    /**
     * The attributes that should not be lowercase.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation'
    ];

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true)) {
            return $value;
        }

        return is_string($value) ? strtolower($value) : $value;
    }
}
