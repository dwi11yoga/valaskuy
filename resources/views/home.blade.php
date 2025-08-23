@extends('layout')

@section('content')
    <div class="grid grid-cols-2 gap-10 mx-20">
        {{-- teks --}}
        <div class="sticky top-0 flex items-center">
            <div class="">
                <h1 class="text-5xl font-bold">
                    Lakukan Perhitungan Valas
                </h1>
                <div class="max-w-4/5">
                    Hitung dengan mudah nilai tukar mata uang dari satu negara ke negara lain secara cepat dan akurat.
                </div>
            </div>
        </div>

        {{-- form --}}
        <div class="flex justify-center">
            <form action="/" method="POST" class="w-8/12">
                <div class="space-y-3">
                    {{-- mata uang asal --}}
                    <label for="asal">Mata uang asal</label>
                    <input type="text" name="asal" id="asal"
                        class="block border border-gray-400 rounded-md px-4 py-3 font-normal w-full">

                    {{-- Nominal --}}
                    <label for="asal">Nominal</label>
                    <input type="number" name="nominal" id="nominal"
                        class="block border border-gray-400 rounded-md px-4 py-3 font-normal w-full">

                    {{-- Mata uang tujuan --}}
                    <label for="asal">Ubah ke</label>
                    <input type="text" name="tujuan" id="tujuan"
                        class="block border border-gray-400 rounded-md px-4 py-3 font-normal w-full">

                    {{-- Mata uang tujuan --}}
                    <label for="asal">Pajak (%)</label>
                    <input type="number" name="tujuan" id="tujuan"
                        class="block border border-gray-400 rounded-md px-4 py-3 font-normal w-full">

                    {{-- @for ($i = 0; $i < 10; $i++)
                        <input type="number" name="tujuan" id="tujuan"
                            class="block border border-gray-400 rounded-md px-4 py-3 font-normal w-full">
                    @endfor --}}
                </div>

                {{-- sumbit --}}
                <input type="submit" value="Hitung"
                    class="block mt-5 border border-gray-400 rounded-md px-4 py-3 font-normal w-full cursor-pointer bg-black hover:bg-white text-white hover:text-black">
            </form>
        </div>
    </div>
@endsection
