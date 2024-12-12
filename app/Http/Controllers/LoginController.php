<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function authenticate(Request $request)
    {

        $request->validate([
            'username' => ['required',],
            'password' => ['required'],


        ], [
            'username.required' => 'Username cannot be blank.',
            'password.required' => 'Password cannot be blank.',

        ]);




        $credentials = $request->only('username', 'password');
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {

            return redirect()->route('home.index')
                ->withSuccess('Signed in');
        } else {
            return back()->with('incorect', 'Incorrect username or password.
            ');
        }
    }

    public function signout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function profile()
    {
        $data = User::find(Auth::user()->id);
        return view('login.profile', compact('data'));
    }
    public function changepassword()
    {
        return view('login.changepassword');
    }
    public function updateprofile(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'name' => 'required',

        ]);




        $data = User::find(Auth::user()->id);

        $data->username = $request->input('username');
        $data->email = $request->input('email');
        $data->name = $request->input('name');


        $data->save();

        return redirect()->route('profile.profile')
            ->with('success', 'Account updated successfully');
    }

    public function updatechangepassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|confirmed', // 'confirmed' memastikan ada input `new_password_confirmation`
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 3 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah password saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Perbarui password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('profile.profile')->with('success', 'Password has been changed successfully.');
    }
}
