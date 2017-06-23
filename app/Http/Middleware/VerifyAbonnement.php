<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Groupe;
use Carbon\Carbon;

class VerifyAbonnement
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
        $user = Auth::user();
        $groupe = Groupe::findOrFail($user->groupe);

        if ($groupe->id === 1)
            return $next($request);

        elseif ($groupe->abonnement->end_date < Carbon::now()->toDateString())
            return redirect('/home/expired');
        return $next($request);
    }
}
