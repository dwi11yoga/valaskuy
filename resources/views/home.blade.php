@extends('layout')

@section('content')
    <div class="grid grid-cols-2 gap-10 mx-20">
        {{-- teks --}}
        <div class="sticky top-0 flex items-center">
            <div class="">
                <h1 class="text-5xl font-bold">
                    {{-- Lakukan Perhitungan Valas --}}
                    Konverter Mata Uang Online
                </h1>
                <div class="max-w-4/5">
                    {{-- Hitung dengan mudah nilai tukar mata uang dari satu negara ke negara lain secara cepat dan akurat. --}}
                    Hitung nilai tukar mata uang secara cepat dan akurat dengan kalkulator mata uang real-time.
                </div>

                {{-- Hasil --}}
                {{-- <div class="mt-6 p-6 rounded-md" style="background-color: var(--primary-color)"> --}}
                {{-- judul --}}
                {{-- <div class="flex justify-between items-center mb-3">
                        <div class="">Hasil Tukar</div>
                        <div class="text-sm">Data 20 Agustus 2025</div>
                    </div> --}}

                {{-- isi --}}
                {{-- <div class="-space-y-3">
                        <div class="">
                            <div class="">
                                USD
                                <h1 class="-mt-3">20 =</h1>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                IDR
                                <h1 class="-mt-3">325.000</h1>
                            </div>
                        </div>
                    </div> --}}

                {{-- keterangan --}}
                {{-- <div class="">USD 1 = IDR 16.267</div>
                    <div class="">Pajak = IDR 15.000 (10%)</div>
                </div> --}}
            </div>
        </div>

        {{-- form & hasil --}}
        <div class="flex justify-center items-center">
            {{-- form --}}
            <form action="/" method="POST" class="w-8/12" id="form">
                @csrf
                <div class="space-y-3">
                    {{-- mata uang asal --}}
                    <label for="from">Mata uang asal</label>
                    <input type="text" name="from" id="from" list="currencyList" value="{{ old('from', $request['from'] ?? '') }}"
                        required
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('from')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('from')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Nominal --}}
                    <label for="amount">Nominal</label>
                    <input type="number" name="amount" id="amount" min="1" value="{{ old('amount', $request['amount'] ?? '') }}"
                        min="1" required
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('amount')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('amount')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Mata uang tujuan --}}
                    <label for="to">Ubah ke</label>
                    <input type="text" name="to" id="to" list="currencyList" value="{{ old('to', $request['to'] ?? '') }}"
                        required
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('to')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('to')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Mata uang tujuan --}}
                    <label for="tax">Pajak (%)</label>
                    <input type="number" name="tax" id="tax" value="{{ old('tax', $tax['percentage'] ?? 0) }}" min="0"
                        required
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('tax')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('tax')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- daftar mata uang --}}
                    <datalist id="currencyList">
                        @foreach ($currencies as $id => $currency)
                            <option>{{ $currency }} ({{ strtoupper($id) }})</option>
                        @endforeach
                    </datalist>
                </div>

                {{-- sumbit --}}
                <input type="submit" value="Hitung"
                    class="block mt-5 border border-gray-400 rounded-md px-4 py-3 font-normal w-full cursor-pointer bg-black hover:bg-white text-white hover:text-black transition-colors">
            </form>

            {{-- Hasil --}}
            <div class="min-w-80 hidden" id="result">
                @if (!empty($rateCalculation))
                    <div class="mt-6 p-6 rounded-md" style="background-color: var(--primary-color)">
                        {{-- judul --}}
                        <div class="flex justify-between items-center mb-3">
                            <div class="">Hasil Tukar</div>
                        </div>

                        {{-- hasil --}}
                        <div class="-space-y-3">
                            <div class="">
                                <div class="">
                                    {{ $from }}
                                    <h1 class="-mt-3 break-words">{{ $amount }} =</h1>
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    {{ $to }}*
                                    <h1 class="-mt-3 break-words">{{ $rateCalculation }}</h1>
                                </div>
                            </div>
                        </div>

                        {{-- keterangan --}}
                        <div class="">1 {{ $from }} = {{ $exchangeRate }} {{ $to }}</div>
                        <div class="">Pajak = {{ $tax['amount'] }} {{ $to }} ({{ $tax['percentage'] }}%)
                        </div>
                        <div class="text-sm mt-5 italic">*Termasuk pajak</div>
                        <div class="text-sm italic">*Data {{ $date }}</div>
                    </div>

                    {{-- tombol kalkulasi kembali --}}
                    <button id="calculateAgain"
                        class="block mt-3 border border-gray-400 rounded-md px-4 py-3 font-normal w-full cursor-pointer bg-black hover:bg-white text-white hover:text-black transition-colors">
                        Kalkulasi lagi
                    </button>
                @endif
            </div>

        </div>
    </div>

    @if (!empty($rateCalculation))
        <script>
            // jalankan saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                hideContent(document.getElementById('form'))
                showContent(document.getElementById('result'))
            });

            // jalankan ketika tombol kalkulasi dipencet
            document.getElementById('calculateAgain').addEventListener('click', function() {
                hideContent(document.getElementById('result'))
                showContent(document.getElementById('form'))

            });
        </script>
    @endif
@endsection
