<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Shopping App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Shopping Admin</h2>

        @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="admin@example.com">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="********">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Login
            </button>
        </form>
    </div>

</body>

</html>