<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class Controller
{
    // Dapatkan daftar mata uang
    public function getCurrencyList()
    {
        // cek apakah daftar mata uang pernah disimpan di session
        $cekSession = session('currencyList');
        if ($cekSession == null) { // jika tidak ada
            // url api
            $apiUrl = env('CURRENCY_API_URL');
            $apiVer = env('CURRENCY_API_VER', 'v1');
            $apiDate = env('CURRENCY_API_DATE', 'latest');
            $apiEndpoint = 'currencies';
            $urlAPI = $apiUrl . '@' . $apiDate . '/' . 'v1' . '/' . $apiEndpoint . '.json';

            // dapatkan daftar mata uang dari api
            $currencyList = Http::timeout(5)->get($urlAPI);

            // jika status nya bukan 200, alihkan ke halaman error (503)
            if ($currencyList->failed()) {
                abort(503, 'bla', [
                    'title' => 'Error',
                ]);
            }
            $currencyList = $currencyList->json();

            // hapus mata uang yang tidak memiliki keterangan mata uang
            $currencyList = array_filter($currencyList, fn($v) => $v !== "");

            // simpan ke session
            session(['currencyList' => $currencyList]);
        } else {
            // jika cookie ada, ambil data dari session
            $currencyList = $cekSession;
        }

        return $currencyList;
    }

    // Dapatkan daftar nilai tukar
    public function getExchangeRates(string $baseCurrency, string $date)
    {
        // ambil data dari api
        $apiUrl = env('CURRENCY_API_URL');
        $apiVer = env('CURRENCY_API_VER', 'v1');
        // $apiDate = env('CURRENCY_API_DATE', 'latest');
        $urlAPI = $apiUrl . '@' . $date . '/' . $apiVer . '/currencies/' . $baseCurrency . '.json';
        $rates = Http::timeout(5)->get($urlAPI);

        // jika status nya bukan 200, alihkan ke halaman error (503)
        if ($rates->failed()) {
            abort(503, 'bla', [
                'title' => 'Error',
            ]);
        }

        $rates = $rates->json();
        return $rates;
    }

    // Ekstrak kode mata uang yang pada request user
    public function getCurrencyCode($string)
    {
        // posisi kurung buka dan tutup
        $start = strpos($string, "(") + 1;
        $end = strpos($string, ')', $start);

        // ambil kode dalam kurung
        $code = substr($string, $start, $end - $start);
        return strtolower($code);
    }

    // Fungsi untuk mengatur jumlah koma pada number format & konversi nilai yang menggunakan notasi ilmiah
    public function autoNumberFormat($number)
    {
        // ubah jadi string dengan presisi tinggi
        $str = rtrim(sprintf('%.12F', $number), '0');
        $str = rtrim($str, '.');

        // pisahkan bilangan bulat dan pecahan
        if (strpos($str, '.') !== false) {
            [$int, $dec] = explode('.', $str);

            // kalau dua digit desimal pertama > 0
            // tampilkan semua desimal sampai ketemu angka bukan nol
            return number_format($int, 0, ',', '.') . ',' . $dec;
        } else {
            // kalau tidak ada desimal
            return number_format($str, 0, ',', '.');
        }
    }
}
