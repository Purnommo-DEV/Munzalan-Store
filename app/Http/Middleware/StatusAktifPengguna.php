<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StatusAktifPengguna
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            $kedaluarsa = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online'. Auth::user()->id, true, $kedaluarsa);
            User::where('id', Auth::user()->id)->update(['terakhir_dilihat' => (new \DateTime())->format("Y-m-d H:i:s")]);
        }
        return $next($request);
    }
}
