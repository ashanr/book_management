<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reader Dashboard</title>
    <!-- Add Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold tracking-wide hover:text-blue-200 ">Reader</a>
                <div>
                    <div class="space-x-4">
                        <a href="{{ url('/') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Home</a>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('admin.books.index') }}">Books</a>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('reader.borrows') }}">Borrows</a>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('staff.logout') }}">Logout</a>
                    </div>
                </div>
            </div>
    </nav>

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
</body>

</html>
