<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- JS --}}
    <script src="{{ asset('js/script.js') }}"></script>


    <title>{{ $title }} | Valaskuy!</title>
</head>

<body class="flex flex-col min-h-screen">
    {{-- navbar --}}
    <nav class="bg-white shadow-sm flex items-center justify-between px-10 py-6 sticky top-0 z-50">
        <div class="font-bold text-lg">ValasKuy!</div>
        <div class="">
            <ul class="flex space-x-8">
                <li>
                    <a href="/"
                        class="text-gray-700 hover:text-blue-500 {{ $title == 'Konverter Mata Uang Online' ? 'font-bold navbar-selected px-2 rounded-sm' : '' }}">
                        {{-- Hitung Valas --}}
                        Konverter
                    </a>
                </li>
                <li>
                    <a href="/daftar-kurs"
                        class="text-gray-700 hover:text-blue-500 {{ $title == 'Kurs' ? 'font-bold navbar-selected px-2 rounded-sm' : '' }}">
                        {{-- Daftar Kurs --}}
                        Kurs
                    </a>
                </li>
                <li>
                    <a href="/tentang"
                        class="text-gray-700 hover:text-blue-500 {{ $title == 'Tentang' ? 'font-bold navbar-selected px-2 rounded-sm' : '' }}">
                        Tentang
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- konten --}}
    <main class="container mx-auto p-10 grow space-y-5">
        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="bg-white flex justify-between items-center px-10 py-4 sticky top-0 z-50"
        style="background-color: var(--primary-color)">
        <div class="">Copyright &copy; 2023 ValasKuy!</div>
        <div class="">Made with <span class="text-red-500">&hearts;</span> by dwi11yoga</div>
    </footer>

    {{-- feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
