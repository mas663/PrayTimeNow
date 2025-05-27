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
        // Validasi input
        $request->validate([
            'city' => 'required|string',
            'date' => 'required|date'
        ]);

        // Ambil koordinat dari Nominatim API
        $locationRes = Http::withHeaders([
            'User-Agent' => 'PrayTimeNow-LaravelApp/1.0 (your-email@example.com)'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $request->city,
            'format' => 'json',
            'limit' => 1
        ]);

        if (!$locationRes->successful() || empty($locationRes->json())) {
            return back()->withInput()->with('error', 'Kota tidak ditemukan');
        }

        $coords = $locationRes->json()[0];
        $lat = $coords['lat'];
        $lon = $coords['lon'];

        // Konversi tanggal ke timestamp
        $timestamp = strtotime($request->date);
        if (!$timestamp) {
            return back()->withInput()->with('error', 'Tanggal tidak valid');
        }

        // Fetch jadwal sholat dari API Aladhan
        $prayRes = Http::get("http://api.aladhan.com/v1/timings/{$timestamp}", [
            'latitude' => $lat,
            'longitude' => $lon,
            'method' => 2
        ]);

        if (!$prayRes->successful()) {
            return back()->withInput()->with('error', 'Gagal mengambil data jadwal sholat');
        }

        $data = $prayRes->json()['data']['timings'];

        // Kembalikan ke halaman yang sama dengan data
        return view('pray.index', compact('data', 'request'));
    }
}
