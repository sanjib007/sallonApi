<?php
/**
 * Created by PhpStorm.
 * User: tapos
 * Date: 8/9/2018
 * Time: 11:47 PM
 */

namespace App\Http\Middleware;

use Closure;

class JsonMiddleware
{
    public function handle($request, Closure $next)
    {

        $request->headers->set('Accept','application/json');
        return $next($request);
    }
}