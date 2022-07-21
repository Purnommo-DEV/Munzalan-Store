<?php
namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function halaman_login(){
        return view('Frontend.LoginDanRegister.login');
    }

public function ceklogin(Request $request){
    $request->validate([

        'email' => 'required|email',
        'password' => 'required',
    ]);
    if(Auth::attempt($request->only('email','password'))){
        if (auth()->user()->peran == 'USER') {
            return redirect()->route('HalamanBeranda');
        } 
        elseif (auth()->user()->peran == 'ADMIN') {
            return redirect()->route('AdminDashboard');
        }
    }else{
        toast('Gagal Login, <br> <small>Cek kembali Email dan Password Anda</small>','error');
        return redirect()->route('HalamanLogin')

        ->with('error','Email-Address And Password Are Wrong.');
    }
}

    public function user_logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

}
