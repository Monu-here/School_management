<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MyEmail;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                switch ($user->role_name) {

                    case 'SuperAdmin':
                        return redirect()->route('admin.index')->with('message', 'Successfully logged in to Super Admin Dashboard');
                    case 'Admin':
                        return redirect()->route('admin.index')->with('message', 'Successfully logged in to Admin Dashboard');
                    case 'Teacher':
                        return redirect()->route('admin.index')->with('message', 'Successfully logged in to Teacher Dashboard');
                    // case 'HR':
                    //     return redirect()->route('admin.index')->with('message', 'Successfully logged in to HR Dashboard');
                    case 'Student':
                        return redirect()->route('admin.index')->with('message', 'Successfully logged in to Student Dashboard');
                    default:
                        Auth::logout();
                        return redirect()->route('adminLogin.login')->with('message', 'Wrong Email & Password');
                }
            } else {
                return redirect()->back()->with('error', 'Wrong email or password. Please try again.');
            }
        }

        return view('Admin.Login.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('adminLogin.login')->with('message', 'Logout Sucessfully');
    }
    public function index(Request $request)

    {
        $name = $request->input('name');
        $users = User::where('name', 'like', "%$name%")->get();

        return view('Admin.UserAcc.index', compact('users'));
    }
    public function add(Request $request)
    {
        if (!auth()->user()->role_name == 'Admin') {
            return redirect()->back()->with('error', 'You do not have permission to create users');
        }
        if ($request->getMethod() == 'POST') {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'number' => 'required',
                'image' => 'sometimes|files|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_name = $request->role_name;
            $user->number = $request->number;
            $user->image = $request->image->store('uploads/user');
            $user->password = Hash::make($request->password);

            $user->save();
            return redirect()->back()->with('message', 'User Add Successfully');
        } else {
            $roles =  DB::table('roles')->get();
            return view('Admin.UserAcc.add', compact('roles'));
        }
    }
    public function show($userId)
    {
        $user = DB::table('users')->find($userId);
        if (!$user) {
            abort(404, 'User not found');
        }
        return view('Admin.UserAcc.show', compact('user'));
    }
    public function edit(Request $request, User $user)
    {

        if ($request->getMethod() == 'POST') {
            // dd(($request->hasFile('image')));
            // dd($request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
                'number' => 'required',
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $user->name = $request->name;
            $user->number = $request->number;
            if ($request->filled('password')) {

                $user->password = bcrypt($request->password);
            }
            if ($request->hasFile('image')) {
                $user->image = $request->image->store('uploads/user');
            }
            if ($request->filled('image')) {
                $user->password = $request->password;
            }

 
            $user->save();
            return redirect()->back()->with('message', 'User Add Successfully');
        } else {
            return view('Admin.UserAcc.edit', compact('user'));
        }
    }
    public function del($user)
    {
        DB::table('users')->where('id', $user)->delete();
        return redirect()->back()->with('message', 'Data Delete Successfully');
    }
    public function roleTeacher()
    {
        $user = DB::table('users')->get();
        return view('Admin.UserAcc.userList', compact('user'));
    }
}
