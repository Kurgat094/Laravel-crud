@extends('base')

@section('title', 'Home')

@section('content')

<div class="container mx-auto mt-10">
    <form action="{{ route('bookdetail') }}" method="post" enctype="multipart/form-data">
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
        <div class="input">
          
            <h3> Book Details Collection Form</h3>
            <label for=""  class="block text-gray-700 font-medium mb-2">Book</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Book Name" name="bookname">


            <label for=""  class="block text-gray-700 font-medium mb-2">Author</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2"placeholder="Author Name" name="author">

            <label for=""  class="block text-gray-700 font-medium mb-2">Price</label>
            <input type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Price" name="price">


            <label for=""  class="block text-gray-700 font-medium mb-2">Description</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Description" name="description">


            <label for=""  class="block text-gray-700 font-medium mb-2">Book image</label>
            <input type="file" class="w-full border border-gray-300 rounded-lg p-2"  name="image">
            <div class="text-center">
                <button type="submit" class="btn btn-success">Upload</button >
            </div>
        </div>
        <div class="upload">
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th colspan="2">Updates</th>
                </tr>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->bookname }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->description }}</td>
                    <td><img src="{{ asset('storage/' . $book->image) }}" alt="" style="width: 100px"></td>
                    <td>
                        <a href="{{ route('edit',['id' => $book-> id]) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('delete', ['id' => $book->id]) }}" class="btn btn-warning">Delete</a>
                    </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </form>
</div>
@endsection