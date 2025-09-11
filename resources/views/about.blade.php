@extends('layout')

@section('content')
    <h1 class="text-5xl">{{ __('about.title') }}</h1>
    <div class="">
        {{ __('about.paragraph1') }}
    </div>
    <div class="">
        {!! __('about.paragraph2', [
            'url' =>
                '<a href="https://github.com/fawazahmed0/exchange-api" target="_blank" title="Kunjungi repositori github" class="underline underline-offset-4 decoration-4 hover:font-bold" >github/fawazahmed0</a>',
        ]) !!}
    </div>
    <div class="">
        {{ __('about.paragraph3') }}
    </div>
@endsection
