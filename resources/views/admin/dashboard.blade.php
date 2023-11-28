@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-bold mb-4">Staff Dashboard</h1>
    <!-- dashboard content here -->

    <!-- Session messages here -->
    @if (session('error'))
        <div class="alert alert-danger bg-red-500 text-white p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success bg-green-500 text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="square-container max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Book List</div>
                <a href="{{ route('admin.books.index') }}"
                    class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Go to Book List</a>
            </div>
        </div>
    </div>
@endsection
