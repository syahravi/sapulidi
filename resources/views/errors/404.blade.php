@extends('layouts.app')

@section('section')
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="max-w-3xl w-full px-6 text-center flex flex-col items-center space-y-6">
            <img src="{{ asset('assets/images/download.gif') }}" alt="Ilustrasi 404" class="w-80 h-auto" />

            <h1 class="text-7xl font-extrabold text-green-700">404</h1>
            <p class="text-2xl text-gray-700">Oops! Halaman yang kamu cari tidak ditemukan.</p>

            <a href="{{ url('/') }}"
                class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white text-lg px-8 py-3 rounded-full transition duration-300 shadow-lg">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
