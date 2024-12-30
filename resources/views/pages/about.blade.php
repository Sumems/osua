@extends('template')
@section('title')
Produk
@endsection
@section('content')
{{-- NAVIGATION PAGE --}}
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('assets/image/carousel-1.jpg');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Produk</h2>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Produk</li>
            </ol>
        </div>
    </nav>
</div>

{{-- MAIN CONTENT --}}
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4">
            <div class="col-lg-6 position-relative align-self-center order-lg-last order-first">
                <img src="assets/image/python.png" class="img-fluid" alt="">
                <a href="https://youtu.be/Pg0baUTEsIc?si=oTFa4Hc5zzvzghho" class="glightbox play-btn"></a>
            </div>
            <div class="col-lg-6 content order-last order-lg-first">
                <h3>Tentang Osua</h3>
                <p>
                    OSUA adalah merek sepatu lokal yang menawarkan kualitas premium dengan harga yang terjangkau. Dibuat dengan perhatian terhadap detail dan kualitas material, setiap pasang sepatu OSUA didesain untuk memberikan kenyamanan, daya tahan, dan gaya yang tak tertandingi. Dengan fokus pada inovasi dan keunggulan dalam pembuatan sepatu, OSUA berkomitmen untuk memberikan pengalaman berbelanja yang memuaskan bagi pelanggan, sambil tetap menjaga standar kualitas tinggi dan harga yang bersaing. Dengan OSUA, Anda dapat menemukan solusi alas kaki yang sempurna untuk setiap kesempatan, dari gaya sehari-hari hingga petualangan di alam terbuka, tanpa harus mengorbankan kualitas atau keanggunan. Sambut kenyamanan dan gaya dengan sepatu OSUA, merek lokal yang menempatkan kepuasan pelanggan di garis depan.
                </p>
                <ul>
                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bi bi-diagram-3"></i>
                        <div>
                            <h5>Kulitas Terbaik</h5>
                            <p>Memberikan produk sepatu berkualitas tinggi dengan desain yang unik dan inovatif.</p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-fullscreen-exit"></i>
                        <div>
                            <h5>Pelayanan Unggul</h5>
                            <p>Menyediakan layanan pelanggan yang unggul untuk memastikan kepuasan pelanggan yang tinggi.</p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-broadcast"></i>
                        <div>
                            <h5>Menjaga Integritas dan Etika Bisnis</h5>
                            <p>Berkomitmen untuk menjaga integritas dan etika bisnis yang tinggi dalam setiap aspek operasional kami.</p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-broadcast"></i>
                        <div>
                            <h5>Kemitraan yang Berkelanjutan</h5>
                            <p>Mengembangkan kemitraan yang berkelanjutan dengan pemasok dan mitra bisnis untuk menciptakan nilai tambah bagi semua pihak yang terlibat.</p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-broadcast"></i>
                        <div>
                            <h5>Kontribusi Terhadap Pembangunan Masyarakat</h5>
                            <p>Mengembangkan kemitraan yang berkelanjutan dengan pemasok dan mitra bisnis untuk menciptakan nilai tambah bagi semua pihak yang terlibat.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- <section id="team" class="team pt-0">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <span>Our Tim</span>
            <h2>Our Tim</h2>
        </div>
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>Rofi'ul Himam</h4>
                        <span>Web Development</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>Muhammad Sya'iq Dhiya'ul Haq</h4>
                        <span>Marketing</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>Zahrah Nisrina Mumtaz</h4>
                        <span>Content</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>Muhammad Hasanudin Ali</h4>
                        <span>Content</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
@section('js')

@endsection
