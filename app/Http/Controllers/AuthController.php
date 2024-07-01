<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Ilutminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required|string|min:3',
                'last_name' => 'required|string|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password',
            ]);


            DB::beginTransaction();
            try {

                $user = User::create($request->all());

                DB::commit();

                $token = encrypt($user->email);


                //Comment this code block if you don't want send email verifications.
                SendEmailJob::dispatch($user->email, 'Verificar email', [
                    'name' => $user->full_name,
                    'url' =>  env("APP_FRONTEND") . '/login',
                    'token' => $token
                ], 'user_email_verify');
                return redirect()->route('login')->with('success', 'User registered successfully! Please verify your email to login.');


                //Uncomment this code block if you don't want send email verifications.
                //Auth::login($user);
                //return redirect()->route('profile');
            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('register')->withErrors(['error' => 'Failed to register user. Please try again.']);
            }
        }

        return view('auth.register');
    }


    public function verifyEmail($token)
    {

        try {
            $decrypt = decrypt($token);

            $user = User::whereEmail($decrypt)->first();

            if (intval($user->is_active) === User::VERIFIED) {
                return redirect()->route('login')->with('success', 'Email already verified. Please login.');
            }

            if (!$user) {
                return redirect()->route('login')->withErrors(['verify_email_err' => 'Invalid token. Please try again.']);
            }

            $user->email_verified_at = now();
            $user->is_active = 1;
            $user->save();

            Auth::login($user);
            return redirect()->route('profile')->with('success', 'Email verified successfully!');
        } catch (Exception $ex) {
            return redirect()->route('login')->withErrors(['verify_email_err' => 'An error occurred. Please try again.']);
        }
    }


    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {

            $request->validate([
                'email'    => 'required|string|email',
                'password' => 'required|min:8',
            ]);

            $user = User::whereEmail($request->email)->first();

            if (intval($user->is_active) !== User::VERIFIED) {
                return redirect()->route('login')->withErrors(['verify_email_err' => 'Please verify your email to login.']);
            }

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {

                return to_route('profile')->with('success', 'Logged in successfully!');
            } else {

                return to_route('login')->withErrors(['error' => 'Invalid login details. Please try again.']);
            }
        }

        return view('auth.login');
    }


    public function dashboard()
    {
        return view('dashboard');
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string'
            ]);

            $id = auth()->user()->id;

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'last_name' => $request->last_name
            ]);
            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        }

        return view('profile');
    }


    public function logout()
    {
        FacadesSession::flush();

        Auth::logout();

        return to_route('login')->with('success', 'Logged out successfully!');
    }
}
