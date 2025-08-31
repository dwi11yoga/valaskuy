@extends('layout')
@section('content')
    {{-- header/judul --}}
    <div class="">
        <h1 class="text-5xl">Daftar Kurs</h1>
        <div class="max-w-2/3">
            {{-- Lihat nilai tukar terkini dari berbagai mata uang terhadap rupiah maupun antar mata uang asing. --}}
            Lihat daftar lengkap nilai tukar mata uang terkini berdasarkan pilihan mata uang utama kamu.
        </div>
    </div>

    {{-- Pilih mata uang --}}
    <div class="">
        <form method="GET" class="flex space-x-2">
            {{-- Mata uang tujuan --}}
            <input type="text" name="currency" id="currency" list="currencyList" placeholder="Pilih mata uang" required
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

            <input type="submit" value="Lihat"
                class="border rounded-md px-4 py-3 bg-black text-white cursor-pointer hover:bg-white hover:text-black transition-colors">

        </form>
        @error('currency')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- keterangan --}}
    <div class="text-sm">
        <div class="">*Nilai tukar {{ $currencyCode }} diperbarui pada {{ $exchangeDate }}.</div>
        <div class="">*Perubahan menunjukkan persentase kenaikan / penurunan nilai mata uang dibandingkan
            dengan {{ now()->subDay()->format('Y-m-d') == $yesterdayDate->format('Y-m-d') ? 'kemarin': 'tanggal '. $yesterdayDate->translatedFormat('d F Y') }}.</div>
    </div>

    {{-- Daftar kurs --}}
    <div class="">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-300">
                    {{-- <th class="text-left p-4">#</th> --}}
                    <th class="text-left p-4">Kode</th>
                    <th class="text-left p-4">Mata uang</th>
                    <th class="text-left p-4">Nilai</th>
                    <th class="text-left p-4">Perubahan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($exchangeRates as $id => $value)
                    {{-- cek apakah perubahan mata uang naik/minus --}}
                    <?php
                    $change = substr($changes[$id], 0, 1); // ambil huruf pertama
                    if ($changes[$id] == 'N/A') {
                        $textColor = 'text-black';
                    } elseif ($change == '-') {
                        $textColor = 'text-red-500';
                    } else {
                        $textColor = 'text-green-500';
                        // tambahkan + pada persentase perubahan
                        $changes[$id] = '+' . $changes[$id];
                    }
                    ?>
                    <tr class="{{ $i % 2 == 0 ? 'bg-neutral-100' : '' }} hover:bg-neutral-200">
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
