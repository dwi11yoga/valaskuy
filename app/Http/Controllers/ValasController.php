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

        return view('index', [
            'title' => __('index.title'),
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
        ], [
            // pesan error
            'from.required' => __('validationMessage.from.required'),
            'to.required' => __('validationMessage.to.required'),
            'amount.required' => __('validationMessage.amount.required'),
            'amount.numeric' => __('validationMessage.amount.numeric'),
            'amount.min' => __('validationMessage.amount.min'),
            'tax.numeric' => __('validationMessage.tax.numeric'),
        ]);

        // Ambil kode mata uang dari request
        $from = $this->getCurrencyCode($validatedData['from']);
        $to = $this->getCurrencyCode($validatedData['to']);

        // dapatkan seluruh daftar mata uang
        $currencyList = $this->getCurrencyList();

        // cek apakah kode mata uang yang dipilih ada pada daftar mata uang
        $check = [
            'from' => $from,
            'to' => $to
        ];
        foreach ($check as $id => $d) {
            if (empty($currencyList[$d])) {
                $error[$id] = __('validationMessage.wrongCurrencyCode');
            }
        }
        // jika ada kode mata uang dipilih tidak ada pada daftar mata uang
        if (isset($error)) {
            return back()->withInput()->withErrors($error);
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
        return view('index')->with([
            'title' => __('index.title'),
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

    // Simpan prefrensi bahasa
    public function lang(Request $request)
    {
        // simpan di cookie
        $duration = 365 * 24 * 60; // satu tahun
        Cookie::queue('locale', $request->lang, $duration);
        session(['locale' => $request->lang]);
        return back();
    }
}
