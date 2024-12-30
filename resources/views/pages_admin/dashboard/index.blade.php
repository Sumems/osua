@extends('template_admin')
@section('title')
    Dashboard
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Hello, {{ Auth::user()->name }}</h1>
    <p class="mb-4">Selamat datang di web admin OSUA</p>

    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card border-left-danger shadow h-100">
                <div class="card-header">
                    Produk Terlaris
                </div>
                <div class="card-body">
                    <canvas id="bestSellingChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-header">
                    User Paling Banyak Transaksi 
                </div>
                <div class="card-body">
                    {{ $userWithMostTransaction }}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card border-left-primary shadow h-100">
                <div class="card-header">
                    Penjualan Selama Setahun Terakhir
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bestSellingCtx = document.getElementById('bestSellingChart').getContext('2d');
        var bestSellingData = {
            labels: {!! json_encode(array_column($topProducts, 'name')) !!},
            datasets: [{
                data: {!! json_encode(array_column($topProducts, 'total_sold')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(199, 199, 199, 0.2)',
                    'rgba(83, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(199, 199, 199, 1)',
                    'rgba(83, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var bestSellingChart = new Chart(bestSellingCtx, {
            type: 'pie',
            data: bestSellingData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' items sold';
                            }
                        }
                    }
                }
            }
        });

        var salesCtx = document.getElementById('salesChart').getContext('2d');
        var salesData = {
            labels: {!! json_encode(array_column($salesData, 'month')) !!},
            datasets: [{
                label: 'Total Penjualan',
                data: {!! json_encode(array_column($salesData, 'total_sold')) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
                tension: 0.1
            }]
        };

        var salesChart = new Chart(salesCtx, {
            type: 'line',
            data: salesData,
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'month'
                        },
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Penjualan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Total Penjualan: ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
