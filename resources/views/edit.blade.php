@extends('base')

@section('content')
<div class="container mx-auto p-4">
    <div class="input">
        <h2 class="text-xl font-bold mb-4">Edit Book Details</h2>

    <form action="{{ route('update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @method('post')

            <label for="bookname" class="block text-gray-700 font-medium mb-2">Book Name</label>
            <input type="text" id="bookname" name="bookname" value="{{ $book->bookname }}" class="w-full border border-gray-300 rounded-lg p-2" required>
       

        
            <label for="author" class="block text-gray-700 font-medium mb-2">Author</label>
            <input type="text" id="author" name="author" value="{{ $book->author }}" class="w-full border border-gray-300 rounded-lg p-2" required>
        

        
            <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
            <input type="number" id="price" name="price" value="{{ $book->price }}" class="w-full border border-gray-300 rounded-lg p-2" required>
        

        
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 rounded-lg p-2" rows="4" required>{{ $book->description }}</textarea>
        

        
            <label for="image" class="block text-gray-700 font-medium mb-2">Book Cover</label>
            <input type="file" id="image" name="image" class="w-full border border-gray-300 rounded-lg p-2">
        

        <button type="submit" class="btn btn-success">Update Book</button>
    </div>
    
    </form>
</div>
@endsection
