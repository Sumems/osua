@extends('template_admin')
@section('title')
Produk
@endsection
@section('content')
<h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        <button type="button" class="btn btn-primary" id="open-modal" data-toggle="modal" data-target="#exampleModal">
            Tambah Produk
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered global-table" id="tableProduct" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Produk</th>
                        <th width="40%">Deskripsi</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th width="11%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="metode" id="metode" value="tambah">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group has-error">
                                <label class="form-control-label">Nama Produk <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="text" name="name" value="" placeholder="Masukan Nama Produk" required>
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group has-error">
                                <label class="form-control-label">Stock <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="text" name="stock" value="" placeholder="Masukan Stock Produk" required>
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group has-error">
                                <label class="form-control-label">Harga <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="text" name="price" value="" placeholder="Masukan Harga Produk" required>
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group has-error">
                                <label class="form-control-label">Deskripsi <span style="color: red">*</span></label>
                                <textarea id="deskripsi" autocomplete="off" class="form-control" name="description" wrap="soft" runat="server" placeholder="Masukan Deskripsi Produk" style="overflow:auto; resize:none; height: 300px;" value=""></textarea>
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group has-error">
                                <label class="form-control-label">Gambar Produk <span style="color: red">*</span></label>
                                <div class="custom-file">
                                    <input autocomplete="off" class="custom-file-input" type="file" name="images[]" id="customFile" multiple required>
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                    <span class="has-error help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-save" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-action="add">Save</button>
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#customFile').on('change', function (event) {
            var inputFiles = event.currentTarget.files;
            var fileNames = [];
            for (var i = 0; i < inputFiles.length; i++) {
                fileNames.push(inputFiles[i].name);
            }
            $(this).siblings('.custom-file-label').html(fileNames.join(', '));
        });
    });

    let editor;
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    $(document).ready(function() {
        var table = $('#tableProduct').DataTable({
            ordering: false,
            responsive: true,
            processing: true,
            serverSide: true,
            saveState: true,
            ajax: '{{ route("admin.product.datatables") }}',
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description', searchable: false,
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            return data.length > 100 ? data.substr(0, 100) + '...' : data;
                        } else {
                            return data;
                        }
                    }
                },
                { data: 'price', name: 'price',
                    render: function(data, type, row) {
                        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                    }
                },
                { data: 'stock', name: 'stock' },
                { data: 'actions', searchable: false, orderable: false },
            ],
            language: {
                searchPlaceholder: 'Cari Disini...',
                sSearch: '',
                lengthMenu: 'Tampilkan _MENU_ Entri',
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
            }
        });

        $("#form").submit(function(e) {
            e.preventDefault();
            var action = $("#btn-save").data("action");
            var url = '{{ route("admin.product.crud") }}';
            var formData = new FormData(this);
            formData.append('metode', action === "add" ? 'tambah' : 'edit');
            formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Menambahkan CSRF token
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        type: "success"
                    });
                },
                error: function(response) {
                    if (response.status === 422) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').next('.help-block').text(value[0]).show();
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Gagal Menyimpan Data",
                            type: "error"
                        });
                    }
                }
            });
        });

        $('#tableProduct').on('click', '.edit-modal', function() {
            var data = table.row($(this).parents('tr')).data();
            $('#exampleModalLabel').text('Edit Produk');
            $('#btn-save').data('action', 'edit').text('Update');
            $('#metode').val('edit');
            $('#id').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="stock"]').val(data.stock);
            $('input[name="price"]').val(data.price);
            // $('textarea[name="description"]').val(data.description);
            editor.setData(data.description);
            $('#exampleModal').modal('show');
        });

        $('#tableProduct').on('click', '.delete-modal', function() {
            var url = '{{ route("admin.product.crud") }}';
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            id: $(this).data('id'),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire({
                                title: "Success",
                                text: response.message,
                                type: "success"
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: "Error",
                                text: "Gagal Menghapus Data",
                                type: "error"
                            });
                        }
                    });
                }
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#form')[0].reset();
            editor.setData('');
            $('#btn-save').data('action', 'add').text('Save');
            $('#metode').val('tambah');
            $('#exampleModalLabel').text('Tambah Produk');
            $('.help-block').text('').hide();
            // Reset input file
            $('#customFile').val(''); // Menghapus nilai file yang telah dipilih
            $(this).find('.custom-file-label').html('Pilih Gambar'); // Mengatur kembali teks label input file
        });
    });
</script>
@endsection