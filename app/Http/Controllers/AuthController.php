<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->subsaker) {
                case 'Admin':
                    return redirect()->route('admin');
                case 'Mabekangdam IV/Diponegoro':
                    return redirect()->route('dashboard.operator');
                case 'Denharjasa Int IV/Semarang':
                    return redirect()->route('dashboard.operator');
                case 'Denjasa Ang IV/B Semarang':
                    return redirect()->route('dashboard.operator');
                case 'Denbekang IV/1.B Purwokerto':
                    return redirect()->route('dashboard.operator');
                case 'Denbekang IV/2.B Yogyakarta':
                    return redirect()->route('dashboard.operator');
                case 'Denbekang IV/3.B Salatiga':
                    return redirect()->route('dashboard.operator');
                case 'Denbekang IV/4.B Surakarta':
                    return redirect()->route('dashboard.operator');
                case 'Tepbek IV/1.A Semarang':
                    return redirect()->route('dashboard.operator');
                case 'Tepbek IV/2.A Slawi':
                    return redirect()->route('dashboard.operator');
                case 'Tepbek IV/3.A Magelang':
                    return redirect()->route('dashboard.operator');
                case 'Bendahara':
                    return redirect()->route('dashboard.bendahara');
                case 'PPK':
                    return redirect()->route('dashboard.ppk');
                case 'PPSPM':
                    return redirect()->route('dashboard.ppspm');
                case 'Kasidalku':
                    return redirect()->route('dashboard.kasidalku');
                default:
                    return redirect('/home');
            }
        }

        return redirect()->route('login')->withErrors(['email' => 'Email or password is incorrect']);
    }
}
