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

        </style
        /*

</head>

<body>

    <nav class="bg-blue-500 p-4">
        <div class="flex items-center justify-between">
            <a href="#" class="text-white text-lg font-semibold">Book Management System</a>
            <div>

                @if (Auth::user() && Auth::user()->isAdmin())
<a href="{{ url('admin/dashboard') }}" class="text-white mx-2"> Dashboard</a>
@else
<a href="{{ url('/') }}" class="text-white mx-2">Home</a>
                    <a href="{{ url('staff/register') }}" class="text-white mx-2">Staff Register</a>
                    <a href="{{ url('reader/register') }}" class="text-white mx-2">Reader Register</a>
                    <a href="{{ url('/login') }}" class="text-white mx-2">Login</a>


                    <a class="text-gray-600 hover:text-gray-900" href="{{ route('staff.logout') }}">Logout</a>
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
