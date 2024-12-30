@extends('template')
@section('title')
Detail Product
@endsection
@section('content')

{{-- MAIN CONTENT --}}
<section id="detail-product" class="detail-product">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 mt-2">
            <div class="col-lg-6" data-aos="fade-up">
                {{-- {{ dd($products->images[0]->image) }} --}}
                <div class="detail-product-img">
                    @if(isset($products->images[0]))
                    <img src="{{ asset('images/products/'.$products->images[0]->image) }}" alt="" class="img-fluid" id="img-preview">
                    @else
                    <img src="" alt="No image available" class="img-fluid" id="img-preview" style="display:none;">
                    @endif
                </div>
                <div class="row mt-3" id="other-img">
                    @foreach ($products->images as $key => $image)
                    <div class="col-3">
                        <img src="{{ asset('images/products/'.$image->image) }}" alt="" class="img-fluid @if ($key == 0) border-black @endif">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <h2 class="h2 product-name">{{ $products->name }}</h2>
                <span class="badge text-bg-light mb-2">Hiking Series</span>
                <h3 class="h3 price mb-3" data-product-price="{{ $products->price }}">Rp {{ number_format($products->price, 0, ',', '.') }}</h3>
                <h4>Warna Tersedia:</h4>
                <div class="product-color d-flex gap-2 mb-3" id="product-color">
                    <div class="rounded-circle" style="background-color: black; width: 25px; height: 25px"></div>
                    <div class="rounded-circle" style="background-color: grey; width: 25px; height: 25px"></div>
                    <div class="rounded-circle" style="background-color: var(--gold); width: 25px; height: 25px"></div>
                </div>
                <h4>Ukuran Tersedia:</h4>
                <div class="product-size d-flex gap-1 mb-3" id="product-size">
                    <div class="rounded-2 border-black d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">38</div>
                    <div class="rounded-2 border-black d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">39</div>
                    <div class="rounded-2 border-black d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">40</div>
                    <div class="rounded-2 border-black d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">41</div>
                    <div class="rounded-2 border-black d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">42</div>
                </div>
                <hr>
                <div class="row d-flex justify-content-end mb-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <button class="btn product-buy w-100" type="button" data-bs-toggle="modal" data-bs-target="#myModal">Beli Sekarang</button>
                            </div>
                            <div class="col-3">
                                <button class="btn product-cart w-100 btn-add-to-cart" data-product-id="{{ $products->id }}"><i class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="product-description">
                    <h4>Deskripsi</h4>
                    <div>
                        {!! html_entity_decode($products->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="checkout-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $products->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            Informasi Barang
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    {{-- <img src="assets/image/rexsar.png" alt="" class="img-fluid rounded-1"> --}}
                                                    @if(isset($products->images[0]))
                                                    <img src="{{ asset('images/products/'.$products->images[0]->image) }}" alt="" class="img-fluid" id="img-preview">
                                                    @else
                                                    <img src="" alt="No image available" class="img-fluid" id="img-preview" style="display:none;">
                                                    @endif
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">Nama Produk</label>
                                                        <input autocomplete="off" class="form-control" type="text" name="product_name" value="{{ $products->name }}" disabled>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">Harga</label>
                                                        <input autocomplete="off" class="form-control" type="text" name="product_price" value="{{ $products->price }}" disabled>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                    <div class="form-group has-error">
                                                        <label class="form-label">Jumlah <span style="color: red">*</span></label>
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-outline-secondary" id="btn-minus">-</button>
                                                            <input type="number" class="form-control text-center" name="quantity" id="quantity" value="1" min="1" required>
                                                            <button type="button" class="btn btn-outline-secondary" id="btn-plus">+</button>
                                                        </div>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            Informasi Customer
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">Alamat <span style="color: red">*</span></label>
                                                        <input autocomplete="off" class="form-control" type="text" name="address" value="" placeholder="Masukan Alamat" required>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">No. Telepon <span style="color: red">*</span></label>
                                                        <input autocomplete="off" class="form-control" type="text" name="telephone" value="" placeholder="Masukan No. Telepon yang Dapat Dihubungi" required>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">Catatan <span style="color: red">*</span></label>
                                                        <input autocomplete="off" class="form-control" type="text" name="note" value="" placeholder="Tambahkan Catatan untuk Warna dan Ukuran. Contoh 'Hitam, 42'" required>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                    <div class="form-group has-error mb-2">
                                                        <label class="form-label">Metode Pembayaran <span style="color: red">*</span></label>
                                                        <select class="form-select" name="payment_method" required>
                                                            <option selected disabled>-- Silahkan Pilih Metode Pembayaran --</option>
                                                            <option value="Transfer Bank">Transfer Bank</option>
                                                            <option value="Kartu Kredit">Kartu Kredit</option>
                                                            <option value="E-Wallet">E-Wallet</option>
                                                            <option value="QRIS">QRIS</option>
                                                        </select>
                                                        <span class="has-error help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow">
                                <div class="card-header">
                                    Ringkasan Pesanan
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text mb-0">Total Harga</p>
                                        <input type="hidden" name="total_price" id="total-price-hidden" />
                                        <p class="mb-0 fs-4 fw-bold" id="total-price-display">Rp {{ number_format($products->price, 0, ',', '.') }}</p>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <div class="modal-footer">
                <button type="submit" id="btn-save" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-url="" data-tbl="" data-action ="" >Save</button>
                <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-bs-dismiss="modal">Close</button>'
            </div> --}}
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    const imgPreview = document.getElementById('img-preview');
    const otherImg = document.getElementById('other-img').querySelectorAll('img');
    const productPrice = parseInt(document.querySelector('.price').getAttribute('data-product-price'));
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('total-price-display');
    const totalPriceHidden = document.getElementById('total-price-hidden');

    // Update total price function
    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value);
        const totalPrice = productPrice * quantity;
        totalPriceDisplay.innerHTML = 'Rp ' + totalPrice.toLocaleString('id-ID', {
            minimumFractionDigits: 0
        });
        totalPriceHidden.value = totalPrice;
    }

    otherImg.forEach(img => {
        img.addEventListener('click', event => {
            imgPreview.src = event.target.src;
            otherImg.forEach(img => img.classList.remove('border-black'));
            event.target.classList.add('border-black');
        });
    });

    document.getElementById('btn-minus').addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
            updateTotalPrice();
        }
    });

    document.getElementById('btn-plus').addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
        updateTotalPrice();
    });

    quantityInput.addEventListener('input', updateTotalPrice);

    $("#checkout-form").submit(function(e) {
        e.preventDefault();
        var url = '{{ route("checkout.single") }}';
        var formData = new FormData(this);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Menambahkan CSRF token
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#myModal').modal('hide');
                Swal.fire({
                    title: "Success",
                    text: "Success",
                    type: "success"
                }).then(() => {
                    // Reset the form
                    $('#checkout-form')[0].reset();
                    // Reset the image preview and total price
                    updateTotalPrice();
                });
            },
            error: function(response) {
                $('#myModal').modal('hide');
                Swal.fire({
                    title: "Error",
                    text: "Gagal Checkout Data",
                    type: "error"
                }).then(() => {
                    // Reset the form
                    $('#checkout-form')[0].reset();
                    // Reset the image preview and total price
                    updateTotalPrice();
                });
            }
        });
    });

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
    });
</script>

@endsection