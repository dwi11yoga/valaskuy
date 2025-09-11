@extends('layout')

@section('content')
    <div class="grid md:grid-cols-2 grid-cols-1 gap-10 md:mx-20">
        {{-- teks --}}
        <div class="flex items-center">
            <div class="">
                <h1 class="text-5xl font-bold">
                    {{-- Lakukan Perhitungan Valas --}}
                    {{-- Konverter Mata Uang Online --}}
                    {{ __('index.title') }}
                </h1>
                <div class="max-w-4/5">
                    {{-- Hitung dengan mudah nilai tukar mata uang dari satu negara ke negara lain secara cepat dan akurat. --}}
                    {{-- Hitung nilai tukar mata uang secara cepat dan akurat dengan kalkulator mata uang real-time. --}}
                    {{ __('index.subtitle') }}
                </div>
            </div>
        </div>

        {{-- form & hasil --}}
        <div class="flex justify-center items-center">
            {{-- form --}}
            <form action="/" method="POST" class="md:w-8/12 w-full" id="form">
                @csrf
                <div class="space-y-3">
                    {{-- mata uang asal --}}
                    <label for="from">{{ __('index.fromLabel') }}</label>
                    <input type="text" name="from" id="from" list="currencyList"
                        value="{{ old('from', $request['from'] ?? '') }}"
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('from')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('from')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Nominal --}}
                    <label for="amount">{{ __('index.amountLabel') }}</label>
                    <input type="text" name="amount" id="amount" min="1" step="any"
                        value="{{ old('amount', $request['amount'] ?? '') }}"
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('amount')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('amount')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Mata uang tujuan --}}
                    <label for="to">{{ __('index.toLabel') }}</label>
                    <input type="text" name="to" id="to" list="currencyList"
                        value="{{ old('to', $request['to'] ?? '') }}"
                        class="block border rounded-md px-4 py-3 font-normal w-full @error('to')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
                    @error('to')
                        <div class="text-sm text-red-500 -mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Mata uang tujuan --}}
                    <label for="tax">{{ __('index.taxLabel') }} (%)</label>
                    <input type="text" name="tax" id="tax" value="{{ old('tax', $tax['percentage'] ?? 0) }}"
                        min="0"
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
                <input type="submit" value="{{ __('index.submitText') }}"
                    class="block mt-5 border button-color border-gray-400 rounded-md px-4 py-3 font-normal w-full cursor-pointer transition-colors">
            </form>

            {{-- Hasil --}}
            <div class="md:min-w-96 md:w-fit w-full hidden" id="result">
                @if (!empty($rateCalculation))
                    <div class="mt-6 p-6 rounded-md highlight">
                        {{-- judul --}}
                        <div class="flex justify-between items-center mb-3">
                            <div class="">{{ __('index.result') }}</div>
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
                        <div class="">{{ __('index.taxLabel') }} = {{ $tax['amount'] }} {{ $to }}
                            ({{ $tax['percentage'] }}%)
                        </div>
                        <div class="text-sm mt-5 italic">*{{ __('index.taxFootnote') }}</div>
                        <div class="text-sm italic">*{{ __('index.updateFootnote') }} {{ $date }}</div>
                    </div>

                    {{-- tombol kalkulasi kembali --}}
                    <button id="calculateAgain"
                        class="block mt-3 border border-gray-400 rounded-md px-4 py-3 font-normal w-full cursor-pointer button-color transition-colors">
                        {{ __('index.calculateAgainText') }}
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
