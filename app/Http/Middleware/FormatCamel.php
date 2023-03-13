<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use stdClass;


class FormatCamel {
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = $next($request);

        return $response->setData($this->format($response->getData()));
    }

    public function format(stdClass|array $target):array {

        $tmp = [];
        foreach ($target as $key => $value) {
            $tmp[Str::camel($key)] =
                (is_array($value) || is_object($value)) ? $this->format($value) : $value
            ;
        }
        return $tmp;
    }
}