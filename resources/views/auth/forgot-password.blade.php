@extends('layouts.app')

@section('section')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-green-700 mb-2">Lupa Password</h2>
        <p class="text-sm text-gray-600 mb-6">
            Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password Anda.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
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

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition duration-200">
                Kirim Tautan Reset
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">Kembali ke halaman login</a>
        </p>
    </div>
@endsection
