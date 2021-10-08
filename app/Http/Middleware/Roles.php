<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Roles extends Middleware
{
    /**
     * @inheritDoc
     */
    public function handle( $request, Closure $next, ...$roles )
    {
        if( !Auth::check() || !Auth::user()->hasAnyRole( $roles ) ){
            $this->unauthenticated( $request, $roles );
        }

        return $next( $request );
    }
}
