<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PrayTimeNow | Jadwal Sholat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(to bottom, #e9fce9, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: scale(1.02);
        }

        .prayer-icon {
            font-size: 2rem;
            color: #0d6efd;
        }

        footer {
            margin-top: 60px;
            background-color: #0d6efd;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .title-shadow {
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold title-shadow">🕌 PrayTimeNow</h1>
        <p class="text-muted">Cek Jadwal Sholat Berdasarkan Lokasi dan Tanggal</p>
    </div>

    {{-- Form --}}
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('praytime.fetch') }}" class="p-4 bg-white rounded shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" id="city" name="city" class="form-control" required value="{{ old('city', $request->city ?? '') }}">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" id="date" name="date" class="form-control" required value="{{ old('date', $request->date ?? '') }}">
                </div>
                <button type="submit" class="btn btn-success w-100"><i class="bi bi-search"></i> Cari Jadwal</button>
            </form>
        </div>
    </div>

    {{-- Jadwal Sholat --}}
    @if (isset($data))
        <div class="text-center mt-5">
            <h3>Jadwal Sholat untuk <span class="text-capitalize">{{ $request->city }}</span> ({{ $request->date }})</h3>
        </div>

        <div class="row justify-content-center mt-4 g-3">
            @php
                $icons = [
                    'Fajr' => 'sunrise',
                    'Dhuhr' => 'sun',
                    'Asr' => 'cloud-sun',
                    'Maghrib' => 'moon',
                    'Isha' => 'moon-stars'
                ];
                $labels = [
                    'Fajr' => 'Subuh',
                    'Dhuhr' => 'Dzuhur',
                    'Asr' => 'Ashar',
                    'Maghrib' => 'Maghrib',
                    'Isha' => 'Isya'
                ];
            @endphp

            @foreach (['Fajr','Dhuhr','Asr','Maghrib','Isha'] as $key)
                <div class="col-md-4 col-lg-3">
                    <div class="card card-custom text-center p-3">
                        <div class="prayer-icon mb-2"><i class="bi bi-{{ $icons[$key] }}"></i></div>
                        <h5 class="mb-1">{{ $labels[$key] }}</h5>
                        <h3 class="text-primary">{{ $data[$key] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Footer --}}
<footer>
    <small>&copy; {{ date('Y') }} PrayTimeNow | Cek Jadwal Sholat by Group-8_PSO [B]</small>
</footer>

</body>
</html>
