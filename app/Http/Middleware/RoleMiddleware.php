<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Ite\IotCore\Context\UserActivityContext;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public $context ;
    public function __construct(UserActivityContext $context)
    {
        $this->context =$context ;
    }

    public function handle(Request $request, Closure $next )
    {
        $user =auth()->user();

        if($user != null && in_array('user',$user->all_roles) && ! $this->context->hasUser($user->id))
            return $next($request);

        abort(403);
    }
}
