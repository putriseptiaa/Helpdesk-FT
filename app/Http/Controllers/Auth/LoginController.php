<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
 
class LoginController extends Controller
{
 
    use AuthenticatesUsers;
 
    protected $redirectTo = RouteServiceProvider::HOME;
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    public function login(Request $request)
    {   
        Session::flash('email', $request->email);
        $input = $request->all();
       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
       
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.beranda');
            }else if (auth()->user()->type == 'administrator') {
                return redirect()->route('administrator.beranda');
            }else{
                return redirect()->route('mahasiswa.beranda');
            }
        }else{
            return redirect()->route('login')
                ->withToastError('Email atau password yang Anda masukkan salah!');
        }
        return redirect()->route('login')
        ->withToastSuccess('Anda berhasil login');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->withToastSuccess('Anda sudah logout!');
    }
}