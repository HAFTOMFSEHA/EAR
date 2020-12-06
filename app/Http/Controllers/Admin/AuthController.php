<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AuthController extends Controller
{
    //
    public function showLoginForm() {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:5'
        ]);



        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.dashboard');

        }
        else {
            Flash::error("Email and password are invalid!");
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        return redirect()->route('admin.login');
    }
}
