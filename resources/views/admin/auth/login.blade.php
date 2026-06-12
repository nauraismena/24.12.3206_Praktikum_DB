<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 text-gray-900">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-md border border-gray-200">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Admin Login</h1>
            <p class="text-gray-500 text-sm mt-1">AmikomEventHub</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl text-sm mb-5">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="admin@amikom.ac.id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    Ingat Saya
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <button
                type="submit"
                class="w-full py-2.5 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow transition duration-200 text-sm">
                Login Dashboard
            </button>
        </form>

        <div class="text-center mt-6 border-t border-gray-100 pt-4">
            <p class="text-gray-400 text-xs">© 2026 AmikomEventHub</p>
        </div>

    </div>

</body>
</html>