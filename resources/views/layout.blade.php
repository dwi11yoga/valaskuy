<!DOCTYPE html>
<html lang="en" id="html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    @vite(['resources/js/app.js'])
    {{-- feathericon --}}
    <script src="https://unpkg.com/feather-icons"></script>

    {{-- Google Font: Jaldi --}}
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet"> --}}

    {{-- Google font: Google sans code --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    {{-- Google font: Noto serif --}}
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"> --}}

    {{-- CSS --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    {{-- JS --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- darkmode --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            darkmodeCheck();
        })
    </script>


    <title>{{ $title }} | Valaskuy!</title>
</head>

<body class="flex flex-col min-h-screen dark:bg-amber-800">
    {{-- navbar --}}
    <nav class="bg-white shadow-sm px-10 md:py-6 py-3 sticky top-0 z-50 dark:bg-amber-600">
        <div class="flex items-center justify-between">
            <div class="font-bold text-lg dark:text-yellow-950">ValasKuy!</div>
            <div class="">
                {{-- menu desktop --}}
                <ul class="md:flex hidden space-x-8 items-center">
                    <li>
                        <a href="/"
                            class="hover:font-semibold hover:opacity-100 {{ $title == 'Konverter Mata Uang Online' ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            {{-- Hitung Valas --}}
                            Konverter
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-kurs"
                            class="hover:font-semibold hover:opacity-100 {{ $title == 'Kurs' ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            {{-- Daftar Kurs --}}
                            Kurs
                        </a>
                    </li>
                    <li>
                        <a href="/tentang"
                            class="hover:font-semibold hover:opacity-100 {{ $title == 'Tentang' ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            Tentang
                        </a>
                    </li>
                    {{-- tombol darkmode --}}
                    <li>
                        <button class="group" onclick="darkmodeToggle(document.getElementById('html'))">
                            <span title="Aktifkan mode gelap" id="darkmodeOn" class="inline"><i
                                    data-feather='moon'class="group-hover:fill-black group-hover:cursor-pointer"></i></span>
                            <span title="Aktifkan mode terang" id="darkmodeOff" class="hidden"><i data-feather='sun'
                                    class="group-hover:fill-amber-500 group-hover:cursor-pointer"></i></span>
                        </button>
                    </li>
                </ul>

                {{-- tombol menu mobile --}}
                <button id="mobileMenuButton" class="md:hidden rounded-full p-3 hover:bg-gray-100 cursor-pointer">
                    <i data-feather='menu'></i>
                </button>

            </div>
        </div>

        {{-- menu mobile --}}
        <ul id="mobileMenu" class="mt-3 space-y-1 border-t-2 border-gray-300 hidden">
            <li class="">
                <a href="/"
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == 'Konverter Mata Uang Online' ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    {{-- Hitung Valas --}}
                    Konverter
                </a>
            </li>
            <li class="">
                <a href="/daftar-kurs"
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == 'Kurs' ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    {{-- Daftar Kurs --}}
                    Kurs
                </a>
            </li>
            <li class="">
                <a href="/tentang"
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == 'Tentang' ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    Tentang
                </a>
            </li>

            {{-- tombol darkmode --}}
            <li class="mt-5">
                <button class="group hover:cursor-pointer" onclick="darkmodeToggle(document.getElementById('html'))">
                    <div id="darkmodeMobileOn" class="flex items-center space-x-2">
                        <i data-feather='moon' class="inline group-hover:fill-black"></i>
                        <span class="group-hover:text-black opacity-60 group-hover:opacity-100">Mode gelap</span>
                    </div>
                    <div id="darkmodeMobileOff" class="flex hidden items-center space-x-2">
                        <i data-feather='sun' class="inline group-hover:fill-amber-500"></i>
                        <span class="group-hover:text-amber-500 opacity-60 group-hover:opacity-100">Mode terang</span>
                    </div>
                </button>
            </li>
        </ul>
    </nav>

    {{-- konten --}}
    <main class="container mx-auto p-10 grow space-y-5">
        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="block md:flex md:justify-between items-center px-10 py-4 sticky top-0 z-50">
        <div class="">Copyright &copy; 2023 ValasKuy!</div>
        <div class="">Made with <span class="text-red-500">&hearts;</span> by <a
                href="https://github.com/dwi11yoga" target="_blank" class="hover:font-bold">dwi11yoga</a></div>
    </footer>

    {{-- feathericon --}}
    <script>
        feather.replace();
    </script>

    {{-- js --}}
    <script>
        // untuk menampilkan/menyembunyikan menu mobile
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        })
    </script>
</body>

</html>
