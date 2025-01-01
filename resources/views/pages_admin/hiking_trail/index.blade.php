@extends('template_admin')
@section('title')
Hiking Trail
@endsection
@section('content')
<h1 class="h3 mb-4 text-gray-800">Data Hiking Trail</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Hiking Trail</h6>
        <button type="button" class="btn btn-primary" id="open-modal" data-toggle="modal" data-target="#exampleModal">
            Tambah Hiking Trail
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered global-table" id="tableHikingTrail" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Gunung</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="metode" id="metode" value="tambah">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group has-error">
                                <label class="form-control-label">Nama Gunung <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="text" name="name" value="" placeholder="Masukan Nama Gunung" required>
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-error">
                                <label class="form-control-label">Titik Koordinat Longitude <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="number" step="0.000001" name="longitude" value="" placeholder="Masukan Titik Koordinat Longitude" required style="-webkit-appearance: none; -moz-appearance: textfield; appearance: none;">
                                <span class="has-error help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-error">
                                <label class="form-control-label">Titik Kordinat Latitude <span style="color: red">*</span></label>
                                <input autocomplete="off" class="form-control" type="number" step="0.000001" name="latitude" value="" placeholder="Masukan Titik Kordinat Latitude" required style="-webkit-appearance: none; -moz-appearance: textfield; appearance: none;">
                                <span class="has-error help-block"></span>
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
    $(document).ready(function() {
        var table = $('#tableHikingTrail').DataTable({
            ordering: false,
            responsive: true,
            processing: true,
            serverSide: true,
            saveState: true,
            ajax: '{{ route("admin.hiking-trail.datatables") }}',
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'longitude', name: 'longitude' },
                { data: 'latitude', name: 'latitude' },
                { data: 'actions', searchable: false, orderable: false },
            ],
            language: {
                searchPlaceholder: 'Cari Disini...',
                sSearch: '',
                lengthMenu: 'Tampilkan _MENU_ Data',
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
            var longitude = parseFloat($('input[name="longitude"]').val());
            var latitude = parseFloat($('input[name="latitude"]').val());
            var action = $("#btn-save").data("action");
            var url = '{{ route("admin.hiking-trail.crud") }}';
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

        $('#tableHikingTrail').on('click', '.edit-modal', function() {
            var data = table.row($(this).parents('tr')).data();
            $('#exampleModalLabel').text('Edit Produk');
            $('#btn-save').data('action', 'edit').text('Update');
            $('#metode').val('edit');
            $('#id').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="longitude"]').val(data.longitude);
            $('input[name="latitude"]').val(data.latitude);
            $('#exampleModal').modal('show');
        });

        $('#tableHikingTrail').on('click', '.delete-modal', function() {
            var url = '{{ route("admin.hiking-trail.crud") }}';
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
            $('#btn-save').data('action', 'add').text('Save');
            $('#metode').val('tambah');
            $('#exampleModalLabel').text('Tambah Hiking Trail');
            $('.help-block').text('').hide();
            $('input[name="name"]').attr('required', true);
            $('input[name="longitude"]').attr('required', true);
            $('input[name="latitude"]').attr('required', true);
        });
    });
</script>
@endsection