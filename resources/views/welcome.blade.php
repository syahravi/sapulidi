@extends('layouts.user-app')

@section('title', 'Skilline Landing Page')

@section('content')
    <div class="bg-green-300" id="home">
        <div class="max-w-screen-xl px-8 mx-auto flex flex-col lg:flex-row items-start">
            <div
                class="flex flex-col w-full lg:w-6/12 justify-center lg:pt-24 items-start text-center lg:text-left mb-5 md:mb-0">
                <h1 data-aos="fade-right" data-aos-once="true" class="my-4 text-5xl font-bold leading-tight text-darken">
                    <span class="text-yellow-500">Ubah Sampah</span> Jadi Rupiah, Demi Bumi Lebih Bersih
                </h1>
                <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="leading-normal text-lg mb-8">
                    Platform kami menghubungkan Anda dengan pembeli sampah daur ulang,
                    mempermudah proses penjualan, dan mendukung lingkungan yang lestari.
                </p>
                <div data-aos="fade-up" data-aos-once="true" data-aos-delay="700"
                    class="w-full md:flex items-center justify-center lg:justify-start md:space-x-5">
                    <button
                        class="lg:mx-0  bg-green-600 text-white text-base font-bold rounded-full py-3 px-6 focus:outline-none transform transition hover:scale-110 duration-300 ease-in-out">
                        Jual barang Sekarang
                    </button>
                </div>
            </div>
            <div class="w-full lg:w-6/12 lg:-mt-10 relative" id="girl">
                <img data-aos="fade-up" data-aos-once="true" class="w-10/12 mx-auto 2xl:-mb-20"
                    src="{{ asset('assets/img/man.png') }} " />
            </div>
        </div>
        <div class="text-white -mt-14 sm:-mt-24 lg:-mt-36 z-40 relative">
            <svg class="xl:h-40 xl:w-full" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z"
                    fill="currentColor"></path>
            </svg>
            <div class="bg-white w-full h-20 -mt-px"></div>
        </div>
    </div>

    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-hidden">
        <div data-aos="flip-down" class="text-center max-w-screen-md mx-auto mt-14" id="tentang">
            <h1 class="text-3xl font-bold mb-4">
                Apa Itu<span class="text-yellow-500"> Sapulidi?</span>
            </h1>
        </div>
        <div class="sm:flex items-center sm:space-x-8 mt-10">
            <div data-aos="fade-right" class="sm:w-1/2 relative">
                <div class="bg-green-500 rounded-full absolute w-12 h-12 z-0 -left-4 -top-3 animate-pulse"></div>
                <h1 class="font-semibold text-2xl relative z-50 text-darken lg:pr-10">
                    Kelola Sampah Anda dengan Mudah,
                    <span class="text-green-500">Mulai dari Ponsel Anda!</span>
                </h1>
                <p class="py-5 lg:pr-32">
                    Sapulidi hadir sebagai platform inovatif yang memudahkan Anda untuk
                    menjual dan membeli berbagai jenis sampah daur ulang. Kami
                    menghubungkan individu, pengepul, dan industri untuk menciptakan
                    ekonomi sirkular yang lebih baik.
                </p>
            </div>
            <div data-aos="fade-left" class="sm:w-1/2 relative mt-10 sm:mt-0">
                <div style="background: #23bdee" class="floating w-24 h-24 absolute rounded-lg z-0 -top-3 -left-3">
                </div>
                <img class="rounded-xl z-40 relative h-96 w-auto" src="{{ asset('assets/images/tentang.png') }}"
                    alt="Waste Management Platform" />
                <div class="bg-green-500 w-40 h-40 floating absolute rounded-lg z-10 -bottom-3 -right-3"></div>
            </div>
        </div>
        <div data-aos="flip-up" class="max-w-xl mx-auto text-center mt-24" id="edukasi">
            <h1 class="font-bold text-darken my-3 text-2xl">
                Edukasi <span class="text-yellow-500">Pengelolaan Sampah</span>
            </h1>
            <p class="leading-relaxed text-gray-500">
                Kami memberikan edukasi kepada masyarakat mengenai pentingnya pengelolaan sampah yang tepat,
                mulai dari mengenali jenis-jenis sampah yang dapat didaur ulang hingga tata cara pembuangan yang benar.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-14 md:gap-5 mt-20">
            <!-- Jenis Sampah -->
            <div data-aos="fade-up" class="bg-white shadow-xl p-6 text-center rounded-xl">
                <div style="background: #5b72ee"
                    class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.17 8.62A9 9 0 1111 3v2a7 7 0 106.17 3.62l1.49.86zM13 12V7l5 3-5 2z" />
                    </svg>
                </div>
                <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">
                    Jenis Sampah yang Bisa Diolah
                </h1>
                <p class="px-4 text-gray-500">
                    Pelajari jenis-jenis sampah seperti plastik, kertas, dan organik yang masih bisa dimanfaatkan
                    atau dijual kembali sebagai bentuk kontribusi terhadap ekonomi sirkular.
                </p>
            </div>

            <!-- Tata Cara Pembuangan -->
            <div data-aos="fade-up" data-aos-delay="150" class="bg-white shadow-xl p-6 text-center rounded-xl">
                <div style="background: #f48c06"
                    class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M9 3v1H4v2h1v13a2 2 0 002 2h10a2 2 0 002-2V6h1V4h-5V3H9zm2 5h2v10h-2V8zm4 0h2v10h-2V8zM7 8h2v10H7V8z" />
                    </svg>
                </div>
                <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">
                    Tata Cara Pembuangan Sampah
                </h1>
                <p class="px-4 text-gray-500">
                    Edukasi tentang cara memilah sampah dari rumah dan membuangnya di tempat yang tepat
                    untuk mencegah pencemaran lingkungan dan meningkatkan efektivitas daur ulang.
                </p>
            </div>

            <!-- Edukasi Berkelanjutan -->
            <div data-aos="fade-up" data-aos-delay="300" class="bg-white shadow-xl p-6 text-center rounded-xl">
                <div style="background: #29b9e7"
                    class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2a10 10 0 00-3.92 19.22c.62.11.85-.27.85-.6v-2.15c-3.47.75-4.2-1.47-4.2-1.47a3.3 3.3 0 00-1.39-1.83c-1.13-.78.08-.77.08-.77a2.6 2.6 0 011.88 1.27 2.65 2.65 0 003.62 1 2.67 2.67 0 01.79-1.66c-2.77-.32-5.68-1.38-5.68-6.16a4.85 4.85 0 011.29-3.37 4.5 4.5 0 01.12-3.32s1.05-.34 3.45 1.3a11.94 11.94 0 016.3 0C17.78 4.12 18.83 4.46 18.83 4.46a4.5 4.5 0 01.12 3.32 4.85 4.85 0 011.29 3.37c0 4.79-2.91 5.84-5.69 6.15a3 3 0 01.85 2.33v3.45c0 .33.23.72.86.6A10 10 0 0012 2z" />
                    </svg>
                </div>
                <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken lg:h-14 pt-3">
                    Edukasi Berkelanjutan
                </h1>
                <p class="px-4 text-gray-500">
                    Kami rutin mengadakan seminar, workshop, dan sosialisasi untuk menumbuhkan kesadaran
                    serta meningkatkan partisipasi aktif masyarakat dalam menjaga kebersihan lingkungan.
                </p>
            </div>
        </div>
        <div class="mt-20">
            <div data-aos="flip-down" class="text-center max-w-screen-md mx-auto">
                <h1 class="text-3xl font-bold mb-4">
                    Kegiatan <span class="text-yellow-500" id="kegiatan">Sapulidi?</span>
                </h1>
                <p class="text-gray-500">
                    Sapulidi aktif mengadakan berbagai kegiatan sosial dan edukatif yang
                    berfokus pada pelestarian lingkungan. Mulai dari aksi bersih-bersih,
                    kampanye daur ulang, pelatihan pengolahan sampah organik dan anorganik,
                    hingga kolaborasi bersama masyarakat untuk menciptakan lingkungan yang
                    bersih dan sehat.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-5">
                <div data-aos="fade-up">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan1.png') }}" />
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan2.png') }}" />
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan3.png') }}" />
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan4.png') }}" />
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan5.png') }}" />
                </div>
                <div data-aos="fade-up" data-aos-delay="500">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('assets/images/kegiatan6.png') }}" />
                </div>
            </div>
        </div>

    </div>
@endsection
