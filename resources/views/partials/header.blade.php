<div x-data="{ open: false }" class="w-full text-grey-600-700 bg-green-300">
    <div class="flex flex-col max-w-screen-xl px-8 mx-auto md:items-center md:justify-between md:flex-row">

        <div class="flex flex-row items-center justify-between">
            <a href="#" class="focus:outline-none focus:shadow-outline py-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-16 w-auto">
            </a>

            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <!-- Menu Desktop -->
        <nav class="hidden md:flex flex-row items-center space-x-4">
            <a href="#home" class="px-4 py-2 text-sm bg-transparent rounded-lg text-grey-600 hover:text-gray-800 transition duration-300 ease-in-out transform hover:scale-105">
                Home
            </a>
            <a href="#tentang" class="px-4 py-2 text-sm bg-transparent rounded-lg text-grey-600 hover:text-gray-800 transition duration-300 ease-in-out transform hover:scale-105">
                Tentang
            </a>
            <a href="#edukasi" class="px-4 py-2 text-sm bg-transparent rounded-lg text-grey-600 hover:text-gray-800 transition duration-300 ease-in-out transform hover:scale-105">
                Edukasi
            </a>
            <a href="#kegiatan" class="px-4 py-2 text-sm bg-transparent rounded-lg text-grey-600 hover:text-gray-800 transition duration-300 ease-in-out transform hover:scale-105">
                Kegiatan
            </a>

            @guest
                <a href="{{ route('login') }}" class="px-10 py-3 text-sm text-center bg-green-500 text-white rounded-full ml-4 transition duration-300 ease-in-out hover:bg-green-600 hover:shadow-lg">
                    Login
                </a>
            @else
                <a href="{{ url('/admin') }}" class="px-10 py-3 text-sm text-center bg-white text-green-700 font-semibold rounded-full ml-4 transition duration-300 ease-in-out hover:bg-gray-100 hover:shadow-lg">
                    Dashboard
                </a>
            @endguest
        </nav>

        <!-- Menu Mobile -->
        <nav x-show="open"
            x-transition:enter="transition ease-out duration-300 transform origin-top"
            x-transition:enter-start="opacity-0 scale-y-0"
            x-transition:enter-end="opacity-100 scale-y-100"
            x-transition:leave="transition ease-in duration-200 transform origin-top"
            x-transition:leave-start="opacity-100 scale-y-100"
            x-transition:leave-end="opacity-0 scale-y-0"
            class="md:hidden flex flex-col flex-grow pb-4 bg-white">

            <a href="#home" class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg text-gray-700 hover:text-gray-900 transition duration-300 ease-in-out">Home</a>
            <a href="#tentang" class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg text-gray-700 hover:text-gray-900 transition duration-300 ease-in-out">Tentang</a>
            <a href="#edukasi" class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg text-gray-700 hover:text-gray-900 transition duration-300 ease-in-out">Edukasi</a>
            <a href="#kegiatan" class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg text-gray-700 hover:text-gray-900 transition duration-300 ease-in-out">Kegiatan</a>

            @guest
                <a href="{{ route('login') }}" class="px-10 py-3 mt-2 text-sm text-center bg-white text-gray-800 rounded-full transition duration-300 ease-in-out hover:bg-gray-100 hover:shadow-md">
                    Login
                </a>
            @else
                <a href="{{ url('/admin') }}" class="px-10 py-3 mt-2 text-sm text-center bg-green-500 text-white rounded-full transition duration-300 ease-in-out hover:bg-green-600 hover:shadow-md">
                    Dashboard
                </a>
            @endguest
        </nav>
    </div>
</div>
