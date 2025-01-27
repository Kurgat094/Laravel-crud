@extends('base')

@section('title', 'Home')

@section('content')

<div class="container mx-auto mt-10">
    <form action="{{ route('user.home') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input">
            <h3>Book Details Collection Form</h3>
            <label for=""  class="block text-gray-700 font-medium mb-2">Book</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Book Name" required>

            <label for=""  class="block text-gray-700 font-medium mb-2">Book image</label>
            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" >

            <label for=""  class="block text-gray-700 font-medium mb-2">Author</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2"placeholder="Author Name">

            <label for=""  class="block text-gray-700 font-medium mb-2">Publish Year</label>
            <input type="year" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Publish year">

        </div>
    </form>
</div>
@endsection