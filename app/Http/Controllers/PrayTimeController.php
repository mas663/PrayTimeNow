<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrayTimeController extends Controller
{
    public function index()
    {
        return view('pray.index');
    }

    public function getPrayTime(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'date' => 'required|date'
        ]);

        $city = $request->city;
        $date = $request->date;

        $locationRes = Http::withHeaders([
            'User-Agent' => 'PrayTimeNowApp/1.0 (praytimenow@example.com)'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $city,
            'format' => 'json',
            'limit' => 1,
            'addressdetails' => 1,
        ]);

        if (!$locationRes->successful() || empty($locationRes->json())) {
            return back()->withInput()->with('error', 'Kota tidak ditemukan. Pastikan penulisan benar, seperti "Surabaya", "Malang", atau "Tokyo".');
        }

        $location = $locationRes->json()[0];
        $lat = $location['lat'];
        $lon = $location['lon'];

        $timestamp = strtotime($date);
        if (!$timestamp) {
            return back()->withInput()->with('error', 'Tanggal tidak valid.');
        }

        $prayRes = Http::get("https://api.aladhan.com/v1/timings/{$timestamp}", [
            'latitude' => $lat,
            'longitude' => $lon,
            'method' => 2
        ]);

        if (!$prayRes->successful()) {
            return back()->withInput()->with('error', 'Gagal mengambil data jadwal sholat.');
        }

        $data = $prayRes->json()['data']['timings'];

        return view('pray.index', compact('data', 'request'));
    }

    public function getCities()
    {
        $path = resource_path('data/cities.json');
        $cities = json_decode(file_get_contents($path), true);
        return response()->json($cities);
    }
}
