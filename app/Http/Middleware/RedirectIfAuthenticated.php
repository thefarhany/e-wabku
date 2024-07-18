<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            $role = $user->subsaker;

            switch ($role) {
                case 'Admin':
                    return redirect('/admin-page');
                case 'Mabekangdam IV/Diponegoro':
                    return redirect('/operator');
                case 'Denharjasa Int IV/Semarang':
                    return redirect('/operator');
                case 'Denjasa Ang IV/B Semarang':
                    return redirect('/operator');
                case 'Denbekang IV/1.B Purwokerto':
                    return redirect('/operator');
                case 'Denbekang IV/2.B Yogyakarta':
                    return redirect('/operator');
                case 'Denbekang IV/3.B Salatiga':
                    return redirect('/operator');
                case 'Denbekang IV/4.B Surakarta':
                    return redirect('/operator');
                case 'Tepbek IV/1.A Semarang':
                    return redirect('/operator');
                case 'Tepbek IV/2.A Slawi':
                    return redirect('/operator');
                case 'Tepbek IV/3.A Magelang':
                    return redirect('/operator');
                case 'Bendahara':
                    return redirect('/bendahara');
                case 'PPK':
                    return redirect('/ppk');
                case 'PPSPM':
                    return redirect('/ppspm');
                case 'Kasidalku':
                    return redirect('/kasidalku');
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }
}
