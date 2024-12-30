@extends('template')
@section('title')
Wishlist
@endsection
@section('content')
{{-- NAVIGATION PAGE --}}
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('assets/image/carousel-1.jpg');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Wishlist</h2>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wishlist</li>
            </ol>
        </div>
    </nav>
</div>

{{-- MAIN CONTENT --}}
<section id="product" class="products pt-4">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <span>Wishlist</span>
            <h2>Wishlist</h2>
        </div>
        {{-- {{ dd($wishlists->product) }} --}}
        <div class="row gy-4">
            @foreach ($wishlists as $key => $wishlist) 
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="z-index: {{ count($wishlists) - $key }}">
                <div class="card">
                    <div class="card-img">
                    @if ($wishlist->product->images->isNotEmpty())
                        @php
                            $firstImage = $wishlist->product->images->first()->image;    
                        @endphp
                        <img src="{{ asset('images/products/'.$firstImage) }}" alt="" class="img-fluid">
                    @endif
                    </div>
                    <h3><a href="" class="fs-3 pb-0 text-truncate-multiline">{{ $wishlist->product->name }}</a></h3>
                    <span class="price fs-5">Rp200.000</span>
                    <p class="text-truncate-multiline mb-2">
                        Rexsar adalah sepatu low-cut yang dirancang untuk kegiatan hiking. Material utama sepatu ini adalah Leather Synthetic yang menawarkan ketahanan. Sepatu ini menggunakan outsole Sol Rubber Vibram Anti Slip dan insole Soft Foam untuk bantalan yang empuk.
                    </p>
                    <div class="d-flex justify-content-between align-items-center dropend">
                        <div>
                            <span class="badge text-bg-light ms-2">Hiking Series</span>
                        </div>
                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item btn-remove-from-wishlist" data-wishlist-id="{{ $wishlist->id }}" href="#">Hapus dari wishlist</a></li>
                            <li><a class="dropdown-item btn-add-to-cart" data-product-id="{{ $wishlist->product->id }}" href="#">Tambah ke keranjang</a></li>
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
        $('.btn-add-to-cart').click(function(e) {
            e.preventDefault();
            
            var productId = $(this).data('product-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('cart.add') }}",
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Produk telah ditambahkan ke keranjang.');
                        // Di sini Anda dapat menambahkan logika tambahan setelah berhasil
                    } else {
                        alert('Gagal menambahkan produk ke keranjang.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menambahkan ke keranjang. Silakan coba lagi.');
                }
            });
        });

        $('.btn-remove-from-wishlist').click(function(e) {
            e.preventDefault();
            
            var wishlistId = $(this).data('wishlist-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('wishlist.remove') }}",
                data: {
                    wishlist_id: wishlistId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // alert('Produk telah dihapus dari wishlist.');
                        Swal.fire({
                            title: "Success",
                            text: "Data berhasil di hapus dari wishlist anda",
                            type: "success"
                        }).then(() => {
                            location.reload(); // Refresh halaman setelah berhasil dihapus
                        });
                    } else {
                        alert('Gagal menghapus produk dari wishlist.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menghapus dari wishlist. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection