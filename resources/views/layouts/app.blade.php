<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Book Management')</title>
    <!-- Add Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .square-container {
            width: 300px;
            /* Set the width */
            height: 300px;
            /* Set the height to the same value as the width */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            .square-container {
                width: 100%;
                height: auto;
                aspect-ratio: 1 / 1;
                /* Maintain square aspect ratio */
            }
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>


</head>

<body>

    <nav class="bg-blue-500 p-4">
        <div class="flex items-center justify-between">
            <a href="#"
                class="text-white text-2xl font-bold tracking-wide hover:text-blue-200 transition duration-300 ease-in-out">Book
                Management System</a>
            <div>
                @if (Auth::user() && Auth::user()->isAdmin())
                    <a href="{{ url('staff/dashboard') }}" class="text-white mx-2"> Dashboard</a>
                @else
                    <a href="{{ url('/') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Home</a>
                    <a href="{{ url('staff/register') }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Staff
                        Register</a>
                    <a href="{{ url('reader/register') }}"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Reader
                        Register</a>
                    <a href="{{ url('/login') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Staff
                        Login</a>
                    <a href="{{ url('/reader/login') }}"
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mx-2">Reader
                        Login</a>


                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out"
                        href="{{ route('staff.logout') }}">
                        Logout
                    </a>
                @endif
            </div>
        </div>
    </nav>
    <!-- End of navigation bar -->

    <div class="container mx-auto px-4 pt-16">

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success flash-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger flash-message">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
