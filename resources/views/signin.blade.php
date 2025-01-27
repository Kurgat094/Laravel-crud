<!-- resources/views/signup.blade.php -->
@extends('base')

@section('title', 'Sign In')

@section('content')
<div class="container mx-auto mt-10">
    
    <form action="{{ route('loginpost') }}" method="post">
        @csrf
        <div class="card">
                <h1 class="text-3xl font-bold text-center mb-6">Login </h1>

                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your email" required>
                
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your password" required>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Login</button >
                <p class="text-center mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a></p>
            </div>
        </div>
        
    </form>
    
</div>
@endsection
