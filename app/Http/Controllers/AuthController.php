<?php


// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\bookdetailcollection;
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

    // public function editpost($id){
    //     request()->validate([
    //         'bookname' => 'required',
    //         'author' => 'required',
    //         'price' => 'required',
    //         'description' => 'required',
    //         'image' => 'required',
    //     ]);
    //     $book = bookdetailcollection::find($id);
    //     $book->bookname = request('bookname');
    //     $book->author = request('author');
    //     $book->price = request('price');
    //     $book->description = request('description');
    //     $book->image = request()->file('image')->store('images','public');
    //     $book->save();
    //     return redirect(route('user.home'))->with('success', 'Book updated successfully!');
    // }
}
