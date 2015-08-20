<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 19.08.2015
 * Time: 19:33
 */

namespace App\Http\Middleware;
use \Response;
use \Closure;


class OwnAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
       $token = $request->header("X-Authorization");

        if (!$this->validateToken($token)){
            return Response::make("Unauthorized", 401);
        }

        return $next($request);
    }

    /**
     * This is a basic validation with just one JWT
     * It can be implemented with Oauth 2.0 depends on specifications
     * @param $token
     * @return bool
     */
    protected function validateToken($token)
    {
        return $token == 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9. eyJpc3MiOiJ0b3B0YWwuY29tIiwiZXhwIjoxNDI2NDIwODAwLCJodHRwOi8vdG9wdGFsLmNvbS9qd3RfY2xhaW1zL2lzX2FkbWluIjp0cnVlLCJjb21wYW55IjoiVG9wdGFsIiwiYXdlc29tZSI6dHJ1ZX0. yRQYnWzskCZUxPwaQupWkiUzKELZ49eM7oWxAQK_ZXw';
    }
}