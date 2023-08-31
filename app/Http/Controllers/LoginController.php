<?php
 
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(Auth::id()==1){
                return redirect()->intended('/dashboard');
            }
            return view('login.index', [
                "title" => "login"
            ]);
        } else {
            return view('login.index', [
                "title" => "login"
            ]);
        }
    }

      public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            if(Auth::id()==1){
                    
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
            }

            //menghapus session
            $request->session()->invalidate();

            $request->session()->regenerateToken();


           return redirect('/login')->with([
                'failed' => 'Login Failed'
            ]);
        }

        return back()->with([
            'failed' => 'Login Failed'
        ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
