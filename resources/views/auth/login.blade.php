@extends('layouts.app')

@section('section')
    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Left Content: Motivational Quote -->
        <div class="bg-green-700 flex flex-col justify-center text-white">
            <div class="mx-auto text-center p-10">
                <h1 class="text-3xl font-bold mb-4">Sampah Bukan Akhir</h1>
                <p class="text-lg font-light">
                    Di tangan yang tepat, sampah bisa menjadi berkah. Mari bersama menciptakan lingkungan bersih
                    dan bernilai melalui daur ulang dan kepedulian.
                </p>
                <img src="{{ asset('assets/images/login.svg') }}"
                     alt="Ilustrasi Daur Ulang" class="w-full h-auto mx-auto mt-6" />
            </div>
        </div>

        <!-- Right Content: Login Form -->
        <div class="p-10">
            <h2 class="text-3xl font-bold text-green-700 mb-2">Masuk Akun Anda</h2>
            <p class="text-sm text-gray-500 mb-6">Gunakan email dan password Anda untuk masuk.</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="text-green-600 rounded">
                        <span class="text-gray-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-green-600 hover:underline">Lupa password?</a>
                </div>

                <button type="submit"
                    class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                    Masuk
                </button>
            </form>
        </div>
    </div>
@endsection
