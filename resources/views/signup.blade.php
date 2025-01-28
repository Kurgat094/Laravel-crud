<!-- resources/views/signup.blade.php -->
@extends('base')

@section('title', 'Sign Up')

@section('content')
<div class="container mx-auto mt-10">
    
    <form action="{{ route('registerpost') }}" method="post">
        @csrf
        <div class="card">
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="text-3xl font-bold text-center mb-6">Sign Up</h1>

                <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your full name" required>
            
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your email" required>
                
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your password" required>

                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Confirm your password" required>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Sign Up</button >
                <p class="text-center mt-4">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a></p>
            </div>
        </div>
        
    </form>
    
</div>
@endsection
