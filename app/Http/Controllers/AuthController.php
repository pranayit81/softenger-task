<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\sendForgetPasswordLink;

class AuthController extends Controller
{

    public function login()
    {
        return view('authentication.login');
    }


    public function register()
    {
        return view('authentication.register');
    }

    public function postLogin(Request $request)
    {

        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);


        if ($user = User::where('email', $request->email)->first()) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended(url('/all-products'));
            } else {
                return back()->with('error', 'Invalid Login.');
            }
        } else {
            return redirect()->back()->with('error', 'Sorry, there is no record of an account associated with this email. Please retry.')->withInput($request->only('email', 'remember'));
        }
    }

    public function postRegister(Request $request)
    {
        $formData = request()->except(['_token']);

        // Validate the form data
        $this->validate($request, [
            'name'   => 'required',
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        //Create the user
        User::create($formData);
        return redirect()->route('login')->withSuccess('User created successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgetPassword()
    {
        return view('authentication.forget-password');
    }

    public function sentForgetPasswordLink(Request $request)
    {

        $request->validate(['email' => ['required', 'email']]);
        if ($user = User::where('email', $request->email)->first()) {

            $token = Str::random(60);

            $password_reset_user = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();

            if ($password_reset_user) {
                $token_saved = DB::table('password_resets')
                    ->where('email', $password_reset_user->email)
                    ->update([
                        'token' => $token
                    ]);
            } else {

                $token_saved = DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token, 'created_at' => date('Y-m-d H:i:s')
                ]);
            }


            if ($token_saved) {
                $user->notify(new sendForgetPasswordLink($user, $token));
                return back()->with('success', 'Reset link is sent susscessfully, please check your mail.!');
            } else {
                return back()->with('error', 'This email does not exist.!');
            }
        } else {
            return back()->with('error', 'Sorry.!! this email id does not exist in our records.!');
        }
    }

    public function updateAdminForgotPassword(Request $request)
    {
        $this->validate($request, ['password' => 'required|confirmed|min:8', 'password_confirmation' => 'required']);

        $email = DB::table('password_resets')
            ->select('email')
            ->where('token', $request->token)
            ->first();

        $user = DB::table('users')
            ->select('*')
            ->where('email', $email->email)
            ->first();

        if ($request->password == $request->password_confirmation) {
            if ($user) {
                $password_updated = DB::table('users')
                    ->where('email', $user->email)
                    ->update(['password' => Hash::make($request->password)]);

                if ($password_updated) {
                    return redirect('/login')->with(['password_updated' => 'Password is changed successfully.!']);
                } else {
                    return redirect('/login')->with(['password_failure' => 'There is an error while changing the password please try again later.!']);
                }
            }
        } else {
            return redirect('/login')->with('error', 'Password do not matched with confirm password.!');
        }
    }
}
