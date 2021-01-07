<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

class apiProtecteRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {        
        try{
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e){
            return response()->json(['error' => 'invalid-token']);
        } catch (TokenExpiredException $e){
            return response()->json(['error' => 'token-expired']);
        } catch (JWTException $e){
            return response()->json(['error' => 'token-not-found']);
        }
        return $next($request);
    }
}
