@extends('template');
@section('title')
Home
@endsection
@section('content')
{{-- CAROUSEL HERO WITH SWIPER --}}
<section id="hero" class="hero d-flex align-items-center">
    <div class="slides-1 swiper" data-aos="fade-up">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="container">
                    <div class="row gy-4 d-flex justify-content-between">
                        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                            <h2 data-aos="fade-up">OSUA</h2>
                            <p data-aos="fade-up" data-aos-delay="100">OSUA merupakan Sepatu lokal berkualitas tinggi untuk menemani petualanganmu. Dibuat dengan material pilihan dan desain yang trendi, OSUA menawarkan kenyamanan dan performa maksimal dalam setiap langkahmu.</p>
                        </div>
                        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                            <img src="{{ asset('assets/image/logo.png') }}" class="img-fluid mb-3 mb-lg-0" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<main id="main">
    <section id="article" class="article pt-4">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <span>Artikel</span>
                <h2>Artikel</h2>
            </div>
            <div class="row gy-4">
                @foreach ($articles as $article)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-img">
                            <img src="{{ asset('images/articles/'.$article->image) }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="{{ route('detail-article', $article->id ) }}" class="stretched-link">{{ $article->title }}</a></h3>
                        <p class="text-truncate-multiline">{!! \Str::limit(html_entity_decode($article->description), 100) !!}</p>
                        <a class="readmore"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="about" class="about pt-0">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-center order-lg-last order-first">
                    <img src="assets/image/python.png" class="img-fluid" alt="">
                    <a href="https://youtu.be/Pg0baUTEsIc?si=oTFa4Hc5zzvzghho" class="glightbox play-btn"></a>
                </div>
                <div class="col-lg-6 content order-last order-lg-first">
                    <h3>Tentang Osua</h3>
                    <p>
                        OSUA adalah merek sepatu lokal yang menawarkan kualitas premium dengan harga yang terjangkau. Dibuat dengan perhatian terhadap detail dan kualitas material, setiap pasang sepatu OSUA didesain untuk memberikan kenyamanan, daya tahan, dan gaya yang tak tertandingi.
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
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="product" class="products pt-4">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <span>Produk</span>
                <h2>Produk</h2>
            </div>
            <div class="row gy-4">
                @foreach ($products as $key => $product)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-img">
                            {{-- <img src="{{ 'images/products' }}" alt="" class="img-fluid"> --}}
                            @if ($product->images->isNotEmpty())
                                @php
                                    $firstImage = $product->images->first()->image;    
                                @endphp
                                <img src="{{ asset('images/products/'.$firstImage) }}" alt="" class="img-fluid">
                            @else
                                <img src="{{ asset('assets/image/carousel-1.jpg') }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <h3><a href="" class="fs-3 pb-0 text-truncate-multiline">{{ $product->name }}</a></h3>
                        <span class="price fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <p class="text-truncate-multiline mb-2">
                            {!! \Str::limit(html_entity_decode($product->description), 100) !!}
                        </p>
                        <div class="d-flex justify-content-end dropend">
                            {{-- <div>
                                <span class="badge text-bg-light ms-2">Hiking Series</span>
                            </div> --}}
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item btn-add-to-wishlist" data-product-id="{{ $product->id }}" href="#">Tambah ke wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.btn-add-to-wishlist').click(function(e) {
            e.preventDefault();
            
            var productId = $(this).data('product-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('wishlist.add') }}",
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Produk telah ditambahkan ke wishlist.');
                        // Di sini Anda dapat menambahkan logika tambahan setelah berhasil
                    } else {
                        alert('Gagal menambahkan produk ke wishlist.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menambahkan ke wishlist. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection