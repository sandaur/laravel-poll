<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Votation;

class OwnsPoll
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
        $pollid = $request->get('poll_id');
        $poll = Votation::find($pollid);

        if (!Auth::user()->can('manipulate', $poll)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
