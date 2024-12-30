

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
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Pilih Gunung & Titik Start</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="mountain" class="form-label">Pilih Gunung</label>
                                <select class="form-select" id="mountain" name="mountain">
                                    <option value="">Pilih Gunung</option>
                                    <option value="semeru">Gunung Semeru</option>
                                    <option value="rinjani">Gunung Rinjani</option>
                                    <option value="gede">Gunung Gede</option>
                                    <option value="cikuray">Gunung Cikuray</option>
                                    <option value="tangkuban_perahu">Gunung Tangkuban Perahu</option>
                                    <option value="bukit_tunggul">Gunung Bukit Tunggul</option>
                                    <option value="manglayang">Gunung Manglayang</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Titik Start</label>
                                <p class="coordinates-display mb-2">Klik pada peta untuk memilih titik start</p>
                                <div id="selected-coordinates" class="small text-muted"></div>
                            </div>
                            <button class="btn btn-primary w-100" id="show-route" disabled>Klik pada peta untuk memilih titik start</button>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informasi Jalur</h5>
                        </div>
                        <div class="card-body">
                            <div id="route-info">
                                <p class="text-muted">Pilih gunung dan titik start untuk melihat informasi jalur</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-0">
                            <iframe id="osrm-map" src="https://map.project-osrm.org/?z=5&center=0.043945%2C116.059570&hl=en&alt=0&srv=2" style="width: 100%; height: 600px; border: none;" allowfullscreen></iframe>
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
                <button class="btn-close" data-bs-toggle="collapse" data-bs-target="#rightSidebar" aria-label="Close"></button>
            </div>
            <div class="card-body">
                <p>Informasi tambahan atau konten sidebar lainnya dapat ditambahkan di sini.</p>
            </div>
        </div>
    </div>

    <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#rightSidebar" aria-expanded="false" aria-controls="rightSidebar">
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
        const mountainData = {
            semeru: {
                center: [-8.1077, 112.9220],
                name: "Gunung Semeru",
                summit: [-8.1077, 112.9220],
                bounds: [
                    [-8.2077, 112.8220],
                    [-8.0077, 113.0220]
                ],
                baseInfo: {
                    elevation: "3,676 m",
                }
            },
            rinjani: {
                center: [-8.4144, 116.4598],
                name: "Gunung Rinjani",
                summit: [-8.4144, 116.4598],
                bounds: [
                    [-8.5144, 116.3598],
                    [-8.3144, 116.5598]
                ],
                baseInfo: {
                    elevation: "3,726 m",
                }
            },
            gede: {
                center: [-6.7900, 106.9800],
                name: "Gunung Gede",
                summit: [-6.7900, 106.9800],
                bounds: [
                    [-6.8900, 106.8800],
                    [-6.6900, 107.0800]
                ],
                baseInfo: {
                    elevation: "2,958 m",
                }
            },
            cikuray: {
                center: [-7.3225130, 107.8598651],
                name: "Gunung Cikuray",
                summit: [-7.3225130, 107.8598651],
                bounds: [
                    [-7.3225130, 107.8598651],
                    [-7.3225130, 107.8598651]
                ],
                baseInfo: {
                    elevation: "2,818 m",
                }
            },
            tangkuban_perahu: {  // Data for Gunung Tangkuban Perahu
                center: [-6.7544, 107.6010],
                name: "Gunung Tangkuban Perahu",
                summit: [-6.7544, 107.6010],
                bounds: [
                    [-6.8544, 107.5010],
                    [-6.6544, 107.7010]
                ],
                baseInfo: {
                    elevation: "2,084 m",
                }
            },
            bukit_tunggul: {  // Data for Gunung Bukit Tunggul
                center: [-7.2675, 107.5750],
                name: "Gunung Bukit Tunggul",
                summit: [-7.2675, 107.5750],
                bounds: [
                    [-7.3675, 107.4750],
                    [-7.1675, 107.6750]
                ],
                baseInfo: {
                    elevation: "2,249 m",
                }
            },
            manglayang: {  // Data for Gunung Manglayang
                center: [-6.8833, 107.6889],
                name: "Gunung Manglayang",
                summit: [-6.8833, 107.6889],
                bounds: [
                    [-6.9833, 107.5889],
                    [-6.7833, 107.7889]
                ],
                baseInfo: {
                    elevation: "1,800 m",
                }
            }
        };

        document.getElementById('mountain').addEventListener('change', function() {
            const mountainId = this.value;

            if (mountainId) {
                const mountain = mountainData[mountainId];
                const mapFrame = document.getElementById('osrm-map');

                // Update map with mountain coordinates
                const center = mountain.center;
                const summit = mountain.summit;

                // Construct new iframe URL with mountain location
                const newUrl = `https://map.project-osrm.org/?z=12&center=${center[0]}%2C${center[1]}&loc=${summit[0]}%2C${summit[1]}&hl=en&alt=0&srv=2`;
                mapFrame.src = newUrl;

                // Enable clicking for start point
                document.getElementById('selected-coordinates').innerHTML = '';

                // Update route info
                const routeInfoHtml = `
                    <div class="route-details">
                        <h6>${mountain.name}</h6>
                        <p><strong>Ketinggian:</strong> ${mountain.baseInfo.elevation}</p>
                    </div>
                `;
                document.getElementById('route-info').innerHTML = routeInfoHtml;

            } else {
                // Reset map to default view
                document.getElementById('osrm-map').src = "https://map.project-osrm.org/?z=5&center=0.043945%2C116.059570&hl=en&alt=0&srv=2";
                document.getElementById('show-route').disabled = true;
                document.getElementById('route-info').innerHTML =
                    '<p class="text-muted">Pilih gunung dan titik start untuk melihat informasi jalur</p>';
            }
        });

        function modifyRoutingContainer() {
            const iframe = document.getElementById('osrm-map');

            iframe.addEventListener('load', function() {
                try {
                    const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                    const routingContainer = iframeDocument.querySelector('.leaflet-routing-container');

                    if (routingContainer) {
                        routingContainer.className += ' leaflet-routing-container-hide';
                    }
                } catch (e) {
                    console.log('Tidak dapat memodifikasi iframe karena same-origin policy:', e);
                }
            });
        }

        // Panggil fungsi saat dokumen dimuat
        document.addEventListener('DOMContentLoaded', modifyRoutingContainer);
    </script>
@endsection
