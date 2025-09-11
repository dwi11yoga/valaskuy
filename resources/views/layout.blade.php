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

    {{-- Google font: Google sans code --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

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
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">

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
                            class="hover:font-semibold hover:opacity-100 {{ $title == __('index.title') ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            {{-- Hitung Valas --}}
                            {{ __('layout.converter') }}
                        </a>
                    </li>
                    <li>
                        <a href="/exchange-rates"
                            class="hover:font-semibold hover:opacity-100 {{ $title == __('exchange-list.title') ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            {{-- Daftar Kurs --}}
                            {{ __('layout.rates') }}
                        </a>
                    </li>
                    <li>
                        <a href="/about"
                            class="hover:font-semibold hover:opacity-100 {{ $title == __('about.title') ? 'font-bold navbar-selected px-2 rounded-sm' : 'opacity-60' }}">
                            {{ __('layout.about') }}
                        </a>
                    </li>

                    {{-- menu bahasa --}}
                    <li class="relative">
                        <div class="cursor-pointer group opacity-60 hover:opacity-100"
                            title="{{ __('layout.langTitle') }}"
                            onclick="document.getElementById('languageSelector').classList.toggle('hidden')">
                            <i data-feather='globe' class=""></i>
                        </div>
                        <form method="post" action="/language" id="languageSelector"
                            onchange="document.getElementById('languageSubmit').click()"
                            class="absolute hidden top-10 right-0 border-2 py-3 px-5 primary-element">
                            @csrf
                            <div class="">{{ __('layout.lang') }}</div>
                            {{-- indonesia --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="indonesian" value="id"
                                    {{ request()->cookie('locale') == 'id' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="indonesian" class="cursor-pointer">Indonesia</label>
                            </div>
                            {{-- inggris --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="english" value="en"
                                    {{ request()->cookie('locale') == 'en' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="english" class="cursor-pointer">English</label>
                            </div>
                            {{-- prancis --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="france" value="fr"
                                    {{ request()->cookie('locale') == 'fr' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="france" class="cursor-pointer">Français</label>
                            </div>
                            {{-- prancis --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="spain" value="es"
                                    {{ request()->cookie('locale') == 'es' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="spain" class="cursor-pointer">Español</label>
                            </div>
                            {{-- portugis --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="portuguese" value="pt"
                                    {{ request()->cookie('locale') == 'pt' ? 'checked' : '' }}
                                    onchange="document.getElementById('languageSubmit').click()" class="cursor-pointer">
                                <label for="portuguese" class="cursor-pointer">Português</label>
                            </div>
                            {{-- rusia --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="russian" value="ru"
                                    {{ request()->cookie('locale') == 'ru' ? 'checked' : '' }}
                                    onchange="document.getElementById('languageSubmit').click()" class="cursor-pointer">
                                <label for="russian" class="cursor-pointer">Русский</label>
                            </div>
                            {{-- Vietnamese --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="vietnamese" value="vi"
                                    {{ request()->cookie('locale') == 'vi' ? 'checked' : '' }}
                                    onchange="document.getElementById('languageSubmit').click()"
                                    class="cursor-pointer">
                                <label for="vietnamese" class="cursor-pointer">TiếngViệt</label>
                            </div>
                            {{-- tiongkok (simpel) --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="chinese" value="zh"
                                    {{ request()->cookie('locale') == 'zh' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="chinese" class="cursor-pointer">中文</label>
                            </div>
                            {{-- jepang --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="japanese" value="jp"
                                    {{ request()->cookie('locale') == 'jp' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="japanese" class="cursor-pointer">日本語</label>
                            </div>
                            {{-- korea --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="korean" value="ko"
                                    {{ request()->cookie('locale') == 'ko' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="korean" class="cursor-pointer">한국어</label>
                            </div>
                            {{-- hindi --}}
                            <div class="flex space-x-2">
                                <input type="radio" name="lang" id="hindi" value="hi"
                                    {{ request()->cookie('locale') == 'hi' ? 'checked' : '' }} class="cursor-pointer">
                                <label for="hindi" class="cursor-pointer">हिंदी</label>
                            </div>
                            <input id="languageSubmit" type="submit" value="Submit" class="hidden">
                        </form>
                    </li>

                    {{-- tombol darkmode --}}
                    <li>
                        <button class="group flex items-center opacity-60 hover:opacity-100"
                            onclick="darkmodeToggle(document.getElementById('html'))">
                            <span title="{{ __('layout.enableDarkMode') }}" id="darkmodeOn" class="inline"><i
                                    data-feather='moon'class="group-hover:fill-black group-hover:cursor-pointer"></i></span>
                            <span title="{{ __('layout.enableLightMode') }}" id="darkmodeOff" class="hidden"><i
                                    data-feather='sun'
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
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == __('index.title') ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    {{-- Hitung Valas --}}
                    {{ __('layout.converter') }}
                </a>
            </li>
            <li class="">
                <a href="/daftar-kurs"
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == __('exchange-list.title') ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    {{-- Daftar Kurs --}}
                    {{ __('layout.rates') }}
                </a>
            </li>
            <li class="">
                <a href="/tentang"
                    class="block hover:font-semibold hover:opacity-100 p-2 rounded-sm {{ $title == __('about.title') ? 'font-bold navbar-selected' : 'opacity-60' }}">
                    {{ __('layout.about') }}
                </a>
            </li>

            <li class="mt-5 flex justify-between">
                {{-- menu bahasa --}}
                <div class="relative">
                    <div class="cursor-pointer group flex items-center space-x-2 opacity-60 hover:opacity-100"
                        title="{{ __('layout.langTitle') }}"
                        onclick="document.getElementById('languageSelectorMobile').classList.toggle('hidden')">
                        <i data-feather='globe' class=""></i> <span>{{ __('layout.lang') }}</span>
                    </div>
                    <form method="post" action="/language" id="languageSelectorMobile"
                        onchange="document.getElementById('languageSubmitMobile').click()"
                        class="absolute hidden top-10 left-0 border-2 py-3 px-5 primary-element">
                        @csrf
                        <div class="">{{ __('layout.lang') }}</div>
                        {{-- indonesia --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="indonesianMobile" value="id"
                                {{ request()->cookie('locale') == 'id' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="indonesianMobile" class="cursor-pointer">Indonesia</label>
                        </div>
                        {{-- inggris --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="englishMobile" value="en"
                                {{ request()->cookie('locale') == 'en' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="englishMobile" class="cursor-pointer">English</label>
                        </div>
                        {{-- prancis --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="franceMobile" value="fr"
                                {{ request()->cookie('locale') == 'fr' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="franceMobile" class="cursor-pointer">Français</label>
                        </div>
                        {{-- prancis --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="spainMobile" value="es"
                                {{ request()->cookie('locale') == 'es' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="spainMobile" class="cursor-pointer">Español</label>
                        </div>
                        {{-- portugis --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="portugueseMobile" value="pt"
                                {{ request()->cookie('locale') == 'pt' ? 'checked' : '' }}
                                onchange="document.getElementById('languageSubmit').click()" class="cursor-pointer">
                            <label for="portugueseMobile" class="cursor-pointer">Português</label>
                        </div>
                        {{-- rusia --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="russianMobile" value="ru"
                                {{ request()->cookie('locale') == 'ru' ? 'checked' : '' }}
                                onchange="document.getElementById('languageSubmit').click()" class="cursor-pointer">
                            <label for="russianMobile" class="cursor-pointer">Русский</label>
                        </div>
                        {{-- Vietnamese --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="vietnameseMobile" value="vi"
                                {{ request()->cookie('locale') == 'vi' ? 'checked' : '' }}
                                onchange="document.getElementById('languageSubmit').click()" class="cursor-pointer">
                            <label for="vietnameseMobile" class="cursor-pointer">TiếngViệt</label>
                        </div>
                        {{-- tiongkok (simpel) --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="chineseMobile" value="zh"
                                {{ request()->cookie('locale') == 'zh' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="chineseMobile" class="cursor-pointer">中文</label>
                        </div>
                        {{-- jepang --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="japaneseMobile" value="jp"
                                {{ request()->cookie('locale') == 'jp' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="japaneseMobile" class="cursor-pointer">日本語</label>
                        </div>
                        {{-- korea --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="koreanMobile" value="ko"
                                {{ request()->cookie('locale') == 'ko' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="koreanMobile" class="cursor-pointer">한국어</label>
                        </div>
                        {{-- hindi --}}
                        <div class="flex space-x-2">
                            <input type="radio" name="lang" id="hindiMobile" value="hi"
                                {{ request()->cookie('locale') == 'hi' ? 'checked' : '' }} class="cursor-pointer">
                            <label for="hindiMobile" class="cursor-pointer">हिंदी</label>
                        </div>
                        <input id="languageSubmitMobile" type="submit" value="Submit" class="hidden">
                    </form>
                </div>

                {{-- tombol darkmode --}}
                <div class="">
                    <button class="group hover:cursor-pointer opacity-60 hover:opacity-100"
                        onclick="darkmodeToggle(document.getElementById('html'))">
                        <div id="darkmodeMobileOn" class="flex items-center space-x-2"
                            title="{{ __('layout.enableDarkMode') }}">
                            <i data-feather='moon' class="inline group-hover:fill-black"></i>
                            <span class="group-hover:text-black">{{ __('layout.darkmode') }}</span>
                        </div>
                        <div id="darkmodeMobileOff" class="flex hidden items-center space-x-2"
                            title="{{ __('layout.enableLightMode') }}">
                            <i data-feather='sun' class="inline group-hover:fill-amber-500"></i>
                            <span class="group-hover:text-amber-500">{{ __('layout.lightmode') }}</span>
                        </div>
                    </button>
                </div>
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
        <div class="">{!! __('layout.credit', ['love' => '<span class="text-red-500">&hearts;</span>']) !!} <a href="https://github.com/dwi11yoga" target="_blank"
                class="hover:font-bold">dwi11yoga</a></div>
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
