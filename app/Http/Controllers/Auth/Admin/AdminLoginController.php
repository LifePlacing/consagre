<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
    	$this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
      return view('admin.auth.login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

        return redirect()->intended(route('admin.dashboard'));

      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->route('login')->withInput($request->only('email'))->with('warning', 'Você não tem permissão');

   }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }    

    protected function guard()
    {
        return Auth::guard('admin');
    }


/*fim da função aqui */


}
