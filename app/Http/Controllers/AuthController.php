<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView(Request $request)
    {
        try {

            return view('auth.login');
        } catch (\Exception  $e) {
            return $e->getMessage();
            //throw $th;
        }
    }

    public function authenticate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect('login')
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                return redirect(route('shorten-urls.create'));
            }

            return redirect('login')->withErrors(['loginError' => 'Invalid credentials'])->withInput();
        } catch (\Exception  $e) {
            return $e->getMessage();
            //throw $th;
        }
    }

    public function dashboard(Request $request)
    {
        try {

            return view('auth.login');
        } catch (\Exception  $e) {
            return $e->getMessage();
            //throw $th;
        }
    }

    public function register(Request $request)
    {
        try {

            return view('auth.register');
        } catch (\Exception  $e) {
            return $e->getMessage();
            //throw $th;
        }
    }

    public function registerUser(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect('register')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            return redirect(route('login'));
        } catch (\Exception  $e) {
            return $e->getMessage();
            //throw $th;
        }
    }


    public function logout()
    {
        try {
            Auth::logout();
            return redirect(route('login'));
        } catch (\Exception $e) {
            $e->getMessage();
            //throw $th;
        }
    }
}
