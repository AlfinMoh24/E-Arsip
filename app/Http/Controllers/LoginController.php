<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        // return $request->all();
        if (Auth::attempt($credentials)) {
            if (Auth::user()->level === 'admin') {
                $request->session()->regenerate();

                return redirect()->intended('/admin/dashboard');
            } else {
                $request->session()->regenerate();

                return redirect()->intended('/user');
            }
        }

        return back()->with('loginError', 'NIP atau Password salah!')->withInput();
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'password_old' => ['required'],
            'password_new' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:password_new'],
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah password lama sesuai
        if (!Hash::check($request->password_old, $user->password)) {
            throw ValidationException::withMessages([
                'password_old' => 'Password lama tidak sesuai.',
            ]);
        }

        // Update password baru
        User::where('id', $user->id)->update(['password' => Hash::make($request->password_new)]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
