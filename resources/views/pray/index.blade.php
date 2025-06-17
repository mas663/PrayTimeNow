<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PrayTimeNow | Jadwal Sholat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
    html, body {
        height: 100%;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom, rgba(214, 208, 208, 0.92), rgba(0, 0, 0, 0.95)),
                    url('{{ asset('images/masjid.png') }}') no-repeat center center fixed;
        background-size: 120% auto;
        background-attachment: fixed;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .hero {
        background: linear-gradient(135deg,  #a1916e 20%, #d9c8a9 50%, #695f48 100%);
        color: rgb(0, 0, 0);
        padding: 15px 10px;
        text-align: center;
        min-height: 5vh;
    }

    .hero h1 {
    font-size: 1.75rem;
    font-weight: 700;
    }

    .hero p {
        font-size: 1rem;
        font-weight: 400;
    }

    .content {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .has-result .content {
        display: block;
        padding-top: 2rem;
    }

    .form-wrapper {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        transition: all 0.3s ease-in-out;
    }

    .form-box {
        background-color: #928660;
        border-radius: 40px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-height: 200px;
        width: 55%;
        margin: 0 auto;
    }

    .card-custom {
        padding: 1.5rem;
        font-size: 1.1rem;
        border-radius: 15px;
    }

    .card-custom:hover {
        transform: scale(1.03);
    }

    footer {
        background: linear-gradient(135deg, #a1916e, #695f48);
        color: #000000;
        padding: 20px 0;
        text-align: center;
    }

    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .custom-btn {
        background-color: #58513b;
        color: white;
        border: none;
    }

    .custom-btn:hover {
        background-color: #574c2a;
    }

    body.dark-mode {
    background: linear-gradient(to bottom, rgba(34, 34, 34, 0.92), rgba(0, 0, 0, 0.95)),
                url('{{ asset('images/masjid3.png') }}') no-repeat center center fixed;
    background-size: 120% auto;
    color: white;
    }

    body.dark-mode .hero {
    background: linear-gradient(135deg, #333 20%, #444 50%, #111 100%);
    color: white;
    }

    body.dark-mode .form-box {
        background-color: #444;
        color: white;
    }

    body.dark-mode .card-custom {
        background-color: #2e2e2e;
        color: white;
    }

    body.dark-mode .card-custom .text-dark {
    color: white !important;
    }

    body.dark-mode .text-muted {
    color: #ccc !important;
    }


    body.dark-mode footer {
        background: #222;
        color: #ccc;
    }

    body.dark-mode .custom-btn {
        background-color: #666;
        color: white;
    }

    body.dark-mode .custom-btn:hover {
        background-color: #555;
    }

    body.dark-mode .bi {
        color: white !important;
    }

    .countdown-text {
    color: #ffffff;
    }

    body.dark-mode .countdown-text {
        color: #ffffff;
    }

    </style>

</head>

<body class="{{ isset($data) ? 'has-result' : '' }}">
<div class="wrapper">

    {{-- Hero --}}
    <div class="hero position-relative text-center">
        <!-- Toggle Mode -->
        <div class="position-absolute top-0 end-0 m-2 d-flex align-items-center">
            <i class="bi bi-brightness-high-fill me-2"></i>
            <div class="form-check form-switch m-0">
                <input class="form-check-input" type="checkbox" id="modeToggle">
            </div>
            <i class="bi bi-moon-stars-fill ms-2"></i>
        </div>

        <!-- Judul -->
        <h1 class="display-5 fw-bold">🕌 PrayTimeNow</h1>
        <p class="lead">Cek Jadwal Sholat Akurat Berdasarkan Lokasi dan Tanggal</p>
    </div>

    {{-- Main Content --}}
    <div class="content container py-5 fade-in">
        <div class="form-wrapper">
            <div class="row justify-content-center">
                <div class="w-100" style="max-width: 1000px;">

                    {{-- Form dan error handling --}}
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

                    <form method="POST" action="{{ route('praytime.fetch') }}" class="form-box">
                        @csrf
                        <div class="mb-3">
                            <label for="city" class="form-label">Kota</label>
                            <select id="city" name="city" class="form-select" required>
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" id="date" name="date" class="form-control" required value="{{ old('date', $request->date ?? '') }}">
                        </div>
                        <button type="submit" class="btn custom-btn w-100 shadow-sm">
                            <i class="bi bi-search"></i> Cari Jadwal
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Jadwal Sholat --}}
        @if (isset($data))
            <div class="text-center mt-5">
                <h3>
                    <i class="bi bi-geo-alt-fill text-danger"></i>
                    Jadwal Sholat untuk <span class="text-capitalize">{{ $request->city }}</span>
                    <br>
                    <i class="bi bi-calendar-event text-primary"></i>
                    ({{ $request->date }})
                </h3>
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
                    <div class="col-6 col-md-2">
                        <div class="card text-center shadow-sm border-0 card-custom">
                            <div class="mb-2 text-primary">
                                <i class="bi bi-{{ $icons[$key] }}" style="font-size: 2rem;"></i>
                            </div>
                            <small class="text-muted">{{ $labels[$key] }}</small>
                            <div class="fw-bold text-dark" style="font-size: 1.2rem;">{{ $data[$key] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="text-center mt-3">
        <p id="countdown" class="fw-bold countdown-text" style="font-size: 1.1rem;"></p>
    </div>

    {{-- Footer --}}
    <footer>
        <small>&copy; {{ date('Y') }} PrayTimeNow | by Group-8_PSO [B]</small>
        <div class="mt-2">
            <a href="https://www.its.ac.id/" class="text-white me-3" target="_blank"><i class="bi bi-building-fill"></i></a>
            <a href="https://github.com/mas663/PrayTimeNow.git" class="text-white" target="_blank"><i class="bi bi-github"></i></a>
        </div>
    </footer>
</div>

<script>
    const toggle = document.getElementById('modeToggle');
    const isDark = localStorage.getItem('darkMode') === 'true';

    if (isDark) document.body.classList.add('dark-mode');
    toggle.checked = isDark;

    toggle.addEventListener('change', function () {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    });
</script>

<script>
@if (isset($data))
    function getNextPrayerTime() {
        const now = new Date();
        const times = {
            Subuh: "{{ $data['Fajr'] }}",
            Dzuhur: "{{ $data['Dhuhr'] }}",
            Ashar: "{{ $data['Asr'] }}",
            Maghrib: "{{ $data['Maghrib'] }}",
            Isya: "{{ $data['Isha'] }}"
        };

        const dateStr = "{{ $request->date }}";
        for (const [name, time] of Object.entries(times)) {
            const targetTime = new Date(`${dateStr}T${time}`);
            if (targetTime > now) {
                return { name, time: targetTime };
            }
        }
        return null; // Semua waktu telah lewat
    }

    function updateCountdown() {
        const countdown = document.getElementById("countdown");
        const prayer = getNextPrayerTime();

        if (!prayer) {
            countdown.textContent = "Semua waktu sholat hari ini telah lewat.";
            return;
        }

        const interval = setInterval(() => {
            const now = new Date();
            const diff = prayer.time - now;

            if (diff <= 0) {
                clearInterval(interval);
                countdown.textContent = `Sudah masuk waktu sholat ${prayer.name}!`;
                return;
            }

            const hours = Math.floor(diff / 1000 / 60 / 60);
            const minutes = Math.floor((diff / 1000 / 60) % 60);
            const seconds = Math.floor((diff / 1000) % 60);

            countdown.textContent = `Sholat ${prayer.name} dalam ${hours}j ${minutes}m ${seconds}d`;
        }, 1000);
    }

    updateCountdown();
@endif
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("city");
    const currentValue = "{{ old('city', $request->city ?? '') }}";

    fetch('/data/cities.json')
        .then(res => res.json())
        .then(data => {
            data.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                if (city === currentValue) option.selected = true;
                select.appendChild(option);
            });
        });
});
</script>

</body>
</html>
