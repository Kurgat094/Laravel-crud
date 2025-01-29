<?php


// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Mail\Otpmail;
use App\Models\bookdetailcollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Mail\WelcomeMail;
use Carbon\Carbon;

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
        // otp variable
        $otp=random_int(000000,999999);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1), 
        ]);
        $user = $request->name;
        //send the welcome email
        Mail::to($request->email)->send(new Otpmail($otp));

        // Redirect with success message
        return redirect('/otp')->with('success', 'Account created successfully!');
    }
    public function otp(){
        return view('otp');
    }


public function verify_otp(Request $request)
{
    // Validate the input
    $request->validate([
        'otp' => 'required|integer',
    ]);

    // Find the user with the given OTP
    $user = User::where('otp', $request->otp)->first();

    if (!$user) {
        return back()->with('error', 'Incorrect OTP');
    }

    // Check if OTP is expired
    if ($user->otp_expires_at && Carbon::now()->greaterThan($user->otp_expires_at)) {
        return back()->with('error', 'OTP has expired. Please request a new one.');
    }

    // Verify the OTP
    $user->otp = null; // Clear OTP after verification
    $user->otp_expires_at = null;
    $user->is_verified = 1; // Mark user as verified
    $user->save();

    return redirect()->route('login')->with('success', 'Account has been verified successfully!');
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

    public function logout(){
        Auth::logout();
        return redirect(route('login'))->with('success', 'Logged out successfully!');
    }

    public function home(){
        // Rendering books from the database
        $books = bookdetailcollection::all();
        return view('home' , compact('books'));
    }

    public function homePost(Request $request){
        request()->validate([
            'bookname' => 'required',
            'author' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        // Store user in the database
        bookdetailcollection::create([
            'bookname' => $request->bookname,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->file('image')->store('images','public'),
        ]);
        return  back()->with('success', 'Book added successfully!');
        
    }

    public function delete($id){
        bookdetailcollection::destroy($id);
        return back()->with('success', 'Book deleted successfully!');
    }

    public function edit($id){
        $book = bookdetailcollection::find($id);
        return view('edit',compact('book'));
    }

    public function update(Request $request, $id)
        {
    $request->validate([
        'bookname' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);

    $book = bookdetailcollection::findOrFail($id);
    $book->update($request->all());

    return redirect()->route('user.home', $id)->with('success', 'Book updated successfully!');
}

   
}
