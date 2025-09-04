<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Str;

class ValasController extends Controller
{
    protected $apiUrl;
    protected $apiVer;
    protected $apiDate;
    protected $apiEndpoint;
    protected $currencyList;

    public function __construct()
    {
        $this->apiUrl = env('CURRENCY_API_URL');
        $this->apiVer = env('CURRENCY_API_VER', 'v1');
        $this->apiDate = env('CURRENCY_API_DATE', 'latest');
        $this->apiEndpoint = env('CURRENCY_API_ENDPOINT', '/currencies/idr');
        $this->currencyList = env('CURRENCY_LIST', 'https://latest.currency-api.pages.dev/v1/currencies.json');
    }

    // fungsi untuk menampilkan jumlah desimal (koma) pada mata uang

    //Home -> Hitung Valas
    public function index()
    {
        // MENAMPILKAN DAFTAR MATA UANG
        $currencyList = $this->getCurrencyList();

        return view('home', [
            'title' => 'Konverter Mata Uang Online',
            'currencies' => $currencyList,
        ]);
    }

    // Fungsi kalkulator valas (POST)
    public function calculate(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required|numeric|min:1',
            'tax' => 'numeric'
        ]);

        // Ambil kode mata uang dari request
        $from = $this->getCurrencyCode($validatedData['from']);
        $to = $this->getCurrencyCode($validatedData['to']);

        // dapatkan seluruh daftar mata uang
        $currencyList = $this->getCurrencyList();

        // cek apakah kode mata uang ada pada daftar mata uang
        $check = [
            'from' => $from,
            'to' => $to
        ];
        foreach ($check as $id => $d) {
            if (empty($currencyList[$d])) {
                return back()->withInput()->withErrors([
                    $id => 'Mata uang yang kamu pilih tidak valid'
                ]);
            }
        }

        // ambil data dari api
        $rates = $this->getExchangeRates($from, 'latest');

        // lakukan kalkulasi
        $exchangeRate = $rates[$from][$to];
        $rateCalculation = $validatedData['amount'] * $exchangeRate;
        // hitung pajak
        $tax = ($rateCalculation * $validatedData['tax']) / 100;
        $rateCalculation = $rateCalculation + $tax;

        // kembali ke halaman home
        return view('home')->with([
            'title' => 'Konverter Mata Uang Online',
            'currencies' => $currencyList,
            'request' => [
                'from' => $request->from,
                'amount' => $request->amount,
                'to' => $request->to,
            ],
            'from' => strtoupper($from),
            'to' => strtoupper($to),
            'amount' => $this->autoNumberFormat($validatedData['amount']),
            'exchangeRate' => $this->autoNumberFormat($exchangeRate),
            'rateCalculation' => number_format($rateCalculation, 2, ',', '.'),
            'tax' => [
                'amount' => number_format($tax, 2, ',', '.'),
                'percentage' => $validatedData['tax']
            ],
            'date' => Carbon::parse($rates['date'])->translatedFormat('d F Y'),
        ]);
    }
}
