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

    <title>{{ __('503.title') }} | Valaskuy!</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">

</head>

<body class="flex items-center justify-center h-screen">
    <section class="max-w-96">
        <h1 class="">503</h1>
        <div class="-mt-4 text-lg font-semibold">{{ __('503.title') }}</div>
        <div class="font-light mt-8">
            {!! __('503.description', [
                'reload' =>
                    '<span class="cursor-pointer underline underline-offset-4 decoration-4 hover:font-bold" onclick="location.reload()">' .
                    __('503.reload') .
                    '</span>',
            ]) !!}
        </div>
    </section>
</body>

</html>
