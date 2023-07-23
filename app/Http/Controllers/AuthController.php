<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Personal;
use App\Models\Product;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth');
    }

    public function admin()
    {
        return view('authAdmin');
    }

    public function login(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        //add role manual to auth
        $role = $request->type;
        $credentials['role'] = $role;

        if ($role == 0) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                return back()->withErrors([
                    'email' => 'Akun tidak ditemukan'
                ]);
            }
            $check_password = password_verify($credentials['password'], $user->password);
            if (!$check_password) {
                return back()->withErrors([
                    'email' => 'Password salah'
                ]);
            }

            auth()->login($user);
            return redirect()->route('dashboard');
        }

        if ($role == 1) {
            //login with Institute model
            $institute = Institute::where('email', $credentials['email'])->first();
            if (!$institute) {
                return back()->withErrors([
                    'email' => 'Akun tidak ditemukan'
                ]);
            }
            $check_password = password_verify($credentials['password'], $institute->password);
            if (!$check_password) {
                return back()->withErrors([
                    'email' => 'Password salah'
                ]);
            }

            auth()->guard('institute')->login($institute);
            //set guard
            return redirect()->route('dashboard');
        }

        if ($role == 2) {
            //login with Institute model
            $personal = Personal::select('personals.id', 'personals.email', 'personals.password', 'personals.photo', 'teachers.name')
                ->join('teachers', 'teachers.id', '=', 'personals.id_teacher')
                ->join('institutes', 'institutes.id', '=', 'teachers.id_institute')
                ->where('personals.email', $credentials['email'])
                ->select('personals.*', 'teachers.name', 'institutes.name as institute_name', 'institutes.id as institute_id')
                ->first();

            if (!$personal) {
                return back()->withErrors([
                    'email' => 'Akun tidak ditemukan'
                ]);
            }
            $check_password = password_verify($credentials['password'], $personal->password);
            if (!$check_password) {
                return back()->withErrors([
                    'email' => 'Password salah'
                ]);
            }

            auth()->guard('personal')->login($personal);
            return redirect()->route('dashboard');
        }
    }

    public function join(Request $request)
    {
        $productSlug = $request->products;
        $product = Product::where('slug', $productSlug)->first();
        return view('join', compact('product'));
    }


    public function logout()
    {
        //get session guard
        $guard = $this->getGuard();
        auth()->guard($guard)->logout();
        return redirect()->route('auth');
    }
}
