@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Books</h1>

    <!-- Button to go to create book page -->
    <a href="{{ route('admin.books.create') }}"
        class="bg-blue-500 mb-3 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Add New Book
    </a>

    <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Author</th>
                <th class="py-2 px-4 border-b">ISBN</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $book->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->isbn }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->status }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.books.edit', $book->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded inline-block">
                            Edit
                        </a>
                        <a href="{{ route('admin.books.borrow_book', $book->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded inline-block">
                            Borrow
                        </a>
                        <form action="{{ route('admin.books.delete', ['id' => $book->id]) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
