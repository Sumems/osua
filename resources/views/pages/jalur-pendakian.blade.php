@extends('template')
@section('title')
    Jalur Pendakian
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('assets/image/carousel-1.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Jalur Pendakian</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Jalur Pendakian</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="hiking-trails" class="hiking-trails pt-4">
        <div class="container" data-aos="fade-up">
            <div class="col">
                <div class="row py-2">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Pilih Gunung & Titik Start</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="mountain" class="form-label">Pilih Gunung</label>
                                    <select class="form-select" id="mountain" name="mountain">
                                        <option value="">Pilih Gunung</option>
                                        @foreach ($hikingTrails as $mountain)
                                            <option value="{{ $mountain->name }}">
                                                {{ Str::replace('_', ' ', $mountain->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mt-3 mt-lg-0">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Informasi Jalur</h5>
                            </div>
                            <div class="card-body">
                                <div id="route-info">
                                    <p class="text-muted p-0 m-0" id="your-location"></p>
                                    <button class="btn btn-success w-100" id="show-route" disabled>Pindahkan pin hijau pada
                                        peta untuk memilih titik start</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="card">
                        <div class="card-body">
                            <iframe id="osrm-map"
                                src="https://map.project-osrm.org/?z=5&center=0.043945%2C116.059570&hl=en&alt=0&srv=2"
                                style="width: 100%; height: 600px; border: none;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Right Sidebar -->
    <div class="collapse" id="rightSidebar">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sidebar</h5>
                <button class="btn-close" data-bs-toggle="collapse" data-bs-target="#rightSidebar"
                    aria-label="Close"></button>
            </div>
            <div class="card-body">
                <p>Informasi tambahan atau konten sidebar lainnya dapat ditambahkan di sini.</p>
            </div>
        </div>
    </div>

    <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#rightSidebar" aria-expanded="false"
        aria-controls="rightSidebar">
        Toggle Sidebar
    </button>
@endsection

@section('css')
    <style>
        .hiking-trails .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .coordinates-display {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
@endsection

@section('js')
    <script>
        let latitude;
        let longitude;

        function getLocation() {
            if (navigator.geolocation) {
                // Tambahkan options untuk memaksa high accuracy
                const options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                };

                navigator.geolocation.getCurrentPosition(showPosition, showError, options);

                // Tambahkan pesan panduan
                const coordinatesDisplay = document.getElementById('your-location');
                coordinatesDisplay.innerHTML = `
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                Mohon izinkan akses lokasi di browser Anda:
                <ul>
                    <li>Klik ikon kunci/lokasi di address bar browser</li>
                    <li>Pilih "Izinkan" atau "Allow" untuk akses lokasi</li>
                    <li>Refresh halaman jika diperlukan</li>
                </ul>
            </div>`;
            } else {
                alert(
                    "Geolocation tidak didukung oleh browser ini. Mohon gunakan browser modern seperti Chrome, Firefox, atau Safari.");
            }
        }

        function showPosition(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
            const coordinatesDisplay = document.getElementById('your-location');
            coordinatesDisplay.innerHTML = `Lokasi Anda: Latitude: ${latitude}, Longitude: ${longitude}`;
            document.getElementById('show-route').disabled = true;
            updateMap([latitude, longitude]);
        }

        function showError(error) {
            const coordinatesDisplay = document.getElementById('your-location');
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    coordinatesDisplay.innerHTML = `
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    Akses lokasi ditolak. Untuk menggunakan fitur ini:
                    <ul>
                        <li>Klik ikon kunci/lokasi di address bar browser</li>
                        <li>Ubah pengaturan lokasi menjadi "Allow"</li>
                        <li>Refresh halaman ini</li>
                    </ul>
                </div>`;
                    break;
                case error.POSITION_UNAVAILABLE:
                    coordinatesDisplay.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i>
                    Lokasi tidak tersedia. Pastikan GPS perangkat Anda aktif.
                </div>`;
                    break;
                case error.TIMEOUT:
                    coordinatesDisplay.innerHTML = `
                <div class="alert alert-warning">
                    <i class="bi bi-clock"></i>
                    Waktu permintaan lokasi habis. Silakan coba lagi.
                </div>`;
                    break;
                case error.UNKNOWN_ERROR:
                    coordinatesDisplay.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i>
                    Terjadi kesalahan yang tidak diketahui. Silakan refresh halaman.
                </div>`;
                    break;
            }
        }

        function updateMap(startPoint) {
            const mountainId = document.getElementById('mountain').value;
            if (mountainId) {
                const mountain = mountainData[mountainId];
                const endPoint = mountain.center;
                const newUrl =
                    `https://map.project-osrm.org/?z=12&center=${(startPoint[0] + endPoint[0]) / 2}%2C${(startPoint[1] + endPoint[1]) / 2}&loc=${startPoint[0]}%2C${startPoint[1]}&loc=${endPoint[0]}%2C${endPoint[1]}&hl=en&alt=0&srv=2`;
                document.getElementById('osrm-map').src = newUrl;
            } else {
                document.getElementById('osrm-map').src =
                    "https://map.project-osrm.org/?z=5&center=0.043945%2C116.059570&hl=en&alt=0&srv=2";
            }
        }

        const mountainData = {
            @foreach ($hikingTrails as $mountain)
                {{ $mountain->name }}: {
                    center: [{{ $mountain->latitude }}, {{ $mountain->longitude }}],
                    name: "{{ $mountain->name }}",
                    summit: [{{ $mountain->latitude }}, {{ $mountain->longitude }}],
                    bounds: [
                        [{{ $mountain->latitude - 0.1 }}, {{ $mountain->longitude - 0.1 }}],
                        [{{ $mountain->latitude + 0.1 }}, {{ $mountain->longitude + 0.1 }}]
                    ]
                },
            @endforeach
        };

        document.getElementById('mountain').addEventListener('change', function() {
            updateMap([latitude, longitude]);
        });

        window.onload = getLocation;
    </script>
@endsection
