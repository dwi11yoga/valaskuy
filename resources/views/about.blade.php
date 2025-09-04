@extends('layout')

@section('content')
    <h1 class="text-5xl">Tentang</h1>
    <div class="">
        Valaskuy! adalah sebuah kalkulator kurs sederhana dan cepat yang dirancang untuk membantu pengguna menghitung
        konversi mata uang dengan mudah. Antarmukanya responsif dan ramah pengguna, sehingga cocok dipakai oleh pemula
        maupun yang sudah familiar dengan konversi valas. Sistem mengambil data kurs dari <a
            href="https://github.com/fawazahmed0/exchange-api" target="_blank" title="Kunjungi repositori github" class="underline underline-offset-4 decoration-4 hover:font-bold" >github/fawazahmed0</a> dan
        menyajikannya dalam tampilan yang mudah dibaca, lengkap dengan persentase perubahan dibanding hari sebelumnya untuk
        memberi konteks pergerakan nilai valuta.
    </div>
    <div class="">
        Sistem ini dibangun oleh <a href="https://github.com/dwi11yoga" target="_blank" class="underline underline-offset-4 decoration-4 hover:font-bold" title="Kunjungi profil github">dwi11yoga</a> menggunakan Laravel, Tailwind, dan FeatherIcons.
    </div>
@endsection
