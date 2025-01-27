<?php


// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function register(){
        return view('signup');
    }
    
    public function registerPost(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Store user in the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Redirect with success message
        return redirect('/login')->with('success', 'Account created successfully!');
    }
    

    public function login(){
        return view('signin');
    }

    public function loginPost(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $emailExist = User::where('email',$email)->first();
        if($emailExist){
            if(Hash::check($request->password,$emailExist->password)){
                Auth::login($emailExist);
                return redirect(route('user.home'));
            }
            else{
                return back();
            }
        }
        // Attempt to authenticate the user
        // if (auth()->attempt($request->only('email', 'password'))) {
        //     // Redirect with success message
        //     return redirect('/')->with('success', 'Logged in successfully!');
        // }

        // Redirect with error message
        return back()->with('error', 'Invalid login details');
    }

    public function home(){
        return view('home');
    }
}
