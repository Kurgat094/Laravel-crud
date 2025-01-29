@extends('base')

@section('title','Otp verificstion')

@section('content')


<div class="container mx-auto mt-10">
    
    <form action="{{ route('verify') }}" method="post">
        @csrf
        <div class="card">
            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                        <h1 class="text-3xl font-bold text-center mb-6">Otp verification</h1>

                <label for="Otp" class="block text-gray-700 font-medium mb-2">Otp</label>
                <input type="text" name="otp" id="otp" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Enter the One Time Password" required>
                
            <div class="text-center">
                <button type="submit" class="btn btn-success">Verify</button >
            </div>
        </div>
        
    </form>
    
</div>


@endsection
