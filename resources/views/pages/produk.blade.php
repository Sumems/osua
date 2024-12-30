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
<section id="product" class="products pt-4">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <span>Produk</span>
            <h2>Produk</h2>
        </div>
        <div class="row gy-4">
            @foreach ($products as $key => $product)    
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="z-index: {{ count($products) - $key }}">
                <div class="card">
                    <div class="card-img">
                    @if ($product->images->isNotEmpty())
                        @php
                            $firstImage = $product->images->first()->image;    
                        @endphp
                        <img src="{{ asset('images/products/'.$firstImage) }}" alt="" class="img-fluid">
                    @else
                        <img src="{{ asset('assets/image/carousel-1.jpg') }}" alt="" class="img-fluid">
                    @endif
                        {{-- <img src="assets/image/rexsar.png" alt="" class="img-fluid"> --}}
                    </div>
                    <h3><a href="{{ route('detail-product', $product->id) }}" class="fs-3 pb-0 text-truncate-multiline">{{ $product->name }}</a></h3>
                    <span class="price fs-5">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    {{-- <p class="text-truncate-multiline mb-2">
                        {!! html_entity_decode($product->description) !!}
                    </p> --}}
                    <p class="truncate-multiline">
                        {!! \Str::limit(html_entity_decode($product->description), 100) !!}
                    </p>
                    <div class="d-flex justify-content-end dropend">
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