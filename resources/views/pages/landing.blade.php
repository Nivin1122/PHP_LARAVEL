<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 text-center">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Login To Visit Home Page</h3>

        @if (Route::has('login'))
            <nav class="flex flex-col space-y-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="block w-full py-2 px-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block w-full py-2 px-4 text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block w-full py-2 px-4 text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</body>
</html>
