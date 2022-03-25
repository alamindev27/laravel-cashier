<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->subscription('default')->canceled()) {
            // This user is not a paying customer...
            return $next($request);
        }
        return redirect('billing');


        // if ($request->user()->subscribedToProduct('plan_LNfrB7NwYzWBvU', 'default')) {
        // }
        // else
        // {
        //     return redirect('billing');
        // }

    }
}
