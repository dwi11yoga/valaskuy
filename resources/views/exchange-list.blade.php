@extends('layout')
@section('content')
    {{-- header/judul --}}
    <div class="">
        <h1 class="text-5xl">{{ __('exchange-list.title') }}</h1>
        <div class="md:max-w-2/3">
            {{ __('exchange-list.subtitle') }}
            {{-- Lihat daftar lengkap nilai tukar mata uang terkini berdasarkan pilihan mata uang utama kamu. --}}
        </div>
    </div>

    {{-- Pilih mata uang --}}
    <div class="">
        <form method="GET" class="flex space-x-2">
            {{-- Mata uang tujuan --}}
            <input type="text" name="currency" id="currency" list="currencyList"
                placeholder="{{ __('exchange-list.currencyPlaceholder') }}" required
                value="{{ old('currency', request('currency'), 'Indonesian Rupiah (IDR)') }}"
                class="block border rounded-md px-4 py-3 w-full @error('currency')
                            border-red-500
                            @else
                            border-gray-400
                        @enderror">
            <datalist id="currencyList">
                @foreach ($currencyList as $id => $currency)
                    <option>{{ $currency }} ({{ strtoupper($id) }})</option>
                @endforeach
            </datalist>

            <input type="submit" value="{{ __('exchange-list.submitText') }}"
                class="border rounded-md px-4 py-3 cursor-pointer button-color transition-colors">

        </form>
        @error('currency')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- keterangan --}}
    <div class="text-sm">
        <div class="">
            *{{ __('exchange-list.lastUpdatefootnote', ['currency' => $currencyCode, 'date' => $exchangeDate]) }}</div>
        <div class="">
            *{{ __('exchange-list.changesFootnote', ['date' => now()->subDay()->format('Y-m-d') == $yesterdayDate->format('Y-m-d') ? __('exchange-list.theadChangesYesterday') : __('exchange-list.theadChangesNotYesterday') . " " .$yesterdayDate->translatedFormat('d F Y')]) }}
        </div>
    </div>

    {{-- Daftar kurs --}}
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="highlight">
                    {{-- <th class="text-left p-4">#</th> --}}
                    <th class="text-left p-4">{{ __('exchange-list.theadCode') }}</th>
                    <th class="text-left p-4">{{ __('exchange-list.theadCurrency') }}</th>
                    <th class="text-left p-4">{{ __('exchange-list.theadValue') }}</th>
                    <th class="text-left p-4">{{ __('exchange-list.theadChanges'    ) }}</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($exchangeRates as $id => $value)
                    {{-- cek apakah perubahan mata uang naik/minus --}}
                    <?php
                    $change = substr($changes[$id], 0, 1); // ambil huruf pertama
                    if ($changes[$id] == 'N/A') {
                        $textColor = '';
                    } elseif ($change == '-') {
                        $textColor = 'text-red-500';
                    } else {
                        $textColor = 'text-green-500';
                        // tambahkan + pada persentase perubahan
                        $changes[$id] = '+' . $changes[$id];
                    }
                    ?>
                    <tr class="{{ $i % 2 == 0 ? 'table-even' : '' }}">
                        {{-- <td class="text-left p-4">{{ $i }}</td> --}}
                        <td class="text-left p-4 uppercase">{{ $id }}</td>
                        <td class="text-left p-4">{{ $currencyList[$id] ?? '' }}</td>
                        <td class="text-left p-4">{{ $value }}</td>
                        <td class="text-left p-4 {{ $textColor }}">
                            {{ $changes[$id] }}</td>
                    </tr>
                    <?php $i = $i + 1; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
