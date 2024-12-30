@extends('template')
@section('title')
Keranjang Belanja
@endsection
@section('content')
{{-- NAVIGATION PAGE --}}
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('assets/image/carousel-1.jpg');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Keranjang Belanja</h2>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Keranjang Belanja</li>
            </ol>
        </div>
    </nav>
</div>

{{-- MAIN CONTENT --}}
<section id="cart" class="carts pt-4">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <span>Keranjang Belanja</span>
            <h2>Keranjang Belanja</h2>
        </div>
        <div class="row gy-4 bg-light rounded">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    @if ($carts->isNotEmpty())
                    <div class="col-12 mb-3">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="form-check d-flex justify-content-start">
                                    <input class="form-check-input me-3" type="checkbox" id="select-all" onclick="selectAllCheckboxes(this)">
                                    <span style="font-size: 16px">Pilih Semua</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach ($carts as $key => $cart)
                    <div class="col-1 d-flex justify-content-center">
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" value="{{ $cart->id }}" name="selected_carts[]">
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="card list-products mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if ($cart->product->images->isNotEmpty())
                                    @php
                                    $firstImage = $cart->product->images->first()->image;
                                    @endphp
                                    <img src="{{ asset('images/products/'.$firstImage) }}" alt="" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body h-100 position-relative">
                                        <h4 class="card-title">{{ $cart->product->name }}</h4>
                                        <h5 class="card-subtitle">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</h5>
                                        <div class="product-quantity position-absolute bottom-0 end-0 p-3">
                                            <button class="btn trash me-1 btn-remove-from-cart" data-cart-id="{{ $cart->id }}"><i class="fa-solid fa-trash"></i></button>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-quantity-decrease" data-cart-id="{{ $cart->id }}"><i class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="form-control quantity-input" data-cart-id="{{ $cart->id }}" id="quantity_{{ $cart->id }}" name="qty_product_{{ $cart->id }}" value="1" min="1" max="{{ $cart->product->stock }}" data-price="{{ $cart->product->price }}">
                                                <button type="button" class="btn btn-quantity-increase" data-cart-id="{{ $cart->id }}"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card summary">
                    <div class="card-header">
                        <h4 class="mb-0">Ringkasan Belanja</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text mb-0">Total</p>
                            <p class="total-price mb-0">Rp<span id="total-price">0</span></p>
                        </div>
                        <hr>
                        <button class="btn btn-checkout w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">Beli</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="checkout-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Catatan</label>
                        <input type="text" class="form-control" id="note" name="note" required>
                    </div>
                    <input type="hidden" name="selected_carts" id="selected-carts">
                    <input type="hidden" name="qty_prod" id="qty_prod">
                    <input type="hidden" name="total_price" id="modal-total-price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function selectAllCheckboxes(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('input[name="selected_carts[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    $(document).ready(function() {
        let total_price = 0;

        function updateTotalPrice() {
            total_price = 0;
            $('input[name="selected_carts[]"]:checked').each(function() {
                let cartId = $(this).val();
                let quantity = parseInt($('input.quantity-input[data-cart-id="' + cartId + '"]').val());
                let price = parseFloat($('input.quantity-input[data-cart-id="' + cartId + '"]').data('price'));
                // total_price += quantity * price;
                if (!isNaN(quantity) && !isNaN(price)) {
                    total_price += quantity * price;
                }
            });
            $('#total-price').text(total_price.toLocaleString());
            $('#modal-total-price').val(total_price);
        }

        $('.quantity-input').change(function() {
            let cartId = $(this).data('cart-id');
            let quantity = parseInt($(this).val());
            let maxQuantity = parseInt($(this).attr('max'));

            if (quantity < 1) {
                $(this).val(1);
            } else if (quantity > maxQuantity) {
                $(this).val(maxQuantity);
            }

            updateTotalPrice();
        });

        $('.btn-quantity-decrease').click(function() {
            let cartId = $(this).data('cart-id');
            let quantityInput = $('input.quantity-input[data-cart-id="' + cartId + '"]');
            let quantity = parseInt(quantityInput.val()) - 1;

            if (quantity >= 1) {
                quantityInput.val(quantity).trigger('change');
            }
        });

        $('.btn-quantity-increase').click(function() {
            let cartId = $(this).data('cart-id');
            let quantityInput = $('input.quantity-input[data-cart-id="' + cartId + '"]');
            let quantity = parseInt(quantityInput.val()) + 1;
            let maxQuantity = parseInt(quantityInput.attr('max'));

            if (quantity <= maxQuantity) {
                quantityInput.val(quantity).trigger('change');
            }
        });

        $('.btn-remove-from-cart').click(function(e) {
            e.preventDefault();
            var cartId = $(this).data('cart-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('cart.remove') }}",
                data: {
                    cart_id: cartId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Success",
                            text: "Data berhasil dihapus dari keranjang anda",
                            type: "success"
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        alert('Gagal menghapus produk dari keranjang.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menghapus dari keranjang. Silakan coba lagi.');
                }
            });
        });

        $('.btn-checkout').click(function() {
            let selected_carts = [];
            let qty_prod = [];

            $('input[name="selected_carts[]"]:checked').each(function() {
                selected_carts.push($(this).val());
                let cartId = $(this).val();
                let qty = $('#quantity_' + cartId).val(); // Asumsi quantity disimpan dalam elemen dengan ID 'quantity_{cartId}'
                qty_prod.push(qty);
            });

            $('#selected-carts').val(selected_carts.join(','));
            $('#qty_prod').val(qty_prod.join(','));
        });


        $('#checkout-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('checkout.array') }}",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#checkoutModal').modal('hide');
                        Swal.fire({
                            title: "Success",
                            text: "Checkout berhasil",
                            type: "success"
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            type: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat checkout. Silakan coba lagi.",
                        type: "error"
                    });
                }
            });
        });

        updateTotalPrice();
    });
</script>
@endsection