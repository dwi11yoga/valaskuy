<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ExchangeListController extends Controller
{
    // 
    protected $apiUrl, $apiVer, $apiDate, $apiEndpoint;

    public function __construct()
    {
        $this->apiUrl = env('CURRENCY_API_URL');
        $this->apiVer = env('CURRENCY_API_VER', 'v1');
        $this->apiDate = env('CURRENCY_API_DATE', 'latest');
        $this->apiEndpoint = env('CURRENCY_API_ENDPOINT', 'currencies/idr');
    }

    //View daftar list
    public function index(Request $request)
    {
        // dapatkan daftar mata uang
        $currencyList = $this->getCurrencyList();

        // cek apakah ada request
        if (isset($request->currency)) {
            // jika ada
            // validasi
            $validatedData = $request->validate([
                'currency' => 'required'
            ]);
            // dapatkan kode mata uang
            $currencyCode = $this->getCurrencyCode($request->currency);
            // cek apakah kode mata uang ada pada daftar mata uang
            if (empty($currencyList[$currencyCode])) {
                return back()->withInput()->withErrors([
                    'currency' => __('validationMessage.wrongCurrencyCode'),
                ]);
            }
        } else {
            // atur agar cede mata uang default adalah idr
            $currencyCode = 'idr';
        }

        // dapatkan nilai tukar mata uang lengkap
        $exchangeRates = $this->getExchangeRates($currencyCode, 'latest');
        // tanggal diperbarui
        $date = $exchangeRates['date'];
        $exchangeDate = Carbon::parse($date)->translatedFormat('d F Y');
        // hapus data tanggal pada variabel $exchangeRates
        $exchangeRates = $exchangeRates[$currencyCode];

        // dapatkan nilai tukar lengkap kemarin untuk mengetahui kenaikan/penurunan nilai mata uang
        $yesterdayDate = Carbon::parse($date)->subDay()->format('Y-m-d');
        $exchangeRatesYesterday = $this->getExchangeRates($currencyCode, $yesterdayDate);
        $exchangeRatesYesterday = $exchangeRatesYesterday[$currencyCode];

        // hitung persentase kenaikan/penurunan mata uang
        foreach ($exchangeRates as $id => $value) {
            if (!empty($exchangeRatesYesterday[$id])) {
                $changes[$id] = number_format((($value - $exchangeRatesYesterday[$id]) / $exchangeRatesYesterday[$id]) * 100, 3, ',', '.') . '%';
            } else {
                $changes[$id] = 'N/A';
            }
            // $changes[$id] = number_format($changes[$id], 2, ',', '.');
        }

        // konversi nilai mata uang yang menggunakan notasi ilmiah
        foreach ($exchangeRates as $id => $value) {
            $exchangeRates[$id] = $this->autoNumberFormat($value);
        }

        return view('exchange-list', [
            'title' => __('exchange-list.title'),
            'currencyCode' => strtoupper($currencyCode),
            'currencyList' => $currencyList,
            'exchangeRates' => $exchangeRates,
            'exchangeDate' => $exchangeDate,
            'changes' => $changes,
            'yesterdayDate' => Carbon::parse($yesterdayDate),
        ]);
    }
}
