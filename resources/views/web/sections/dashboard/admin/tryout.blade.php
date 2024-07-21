@extends('web.layout-dashboard')
@section('title', 'Try Out')
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        
        .bootstrap-select .dropdown-menu{
            height: 70px;
        }

        .bootstrap-select {
            width: 100% !important;
        }
        .inner .show {
            max-height: 100%;
            font-size: 14px;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            font-size: 14px;
        }

        .checkout-form input {
            margin-bottom: 0px;
        }

    </style>
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-coolor-white rbt-shadow-box mb--60">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Manajemen Tryout</h4>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0" style="font-size: 18px;">
                Try Out
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="tryout-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

     <!-- Start Modal create tutor -->
     <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Tambah Try Out
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('tryouts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="name">Nama Try Out</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}" placeholder="Nama Try Out">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="datetime-local" name="start_date">
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="start_date">Tanggal Selesai</label>
                                    <input type="datetime-local" name="end_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="rbt-btn btn-gradient btn-md text-center hover-icon-reverse" style="color: white; border-radius: 4px; width: 100%">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">Simpan</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal create tutor -->

    <!-- Start Modal edit tutor -->
    <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Ubah Subtest Kategori
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="" id="editTryOut" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="tryOutId" name="tryOutId">
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="name">Nama Try Out</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}" placeholder="Nama Try Out">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="datetime-local" id="start_date" name="start_date" value="">
                                </div>
                                
                                <div class="col-12 mb--30">
                                    <label for="end_date">Tanggal Selesai</label>
                                    <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="rbt-btn btn-gradient btn-md text-center hover-icon-reverse" style="color: white; border-radius: 4px; width: 100%">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">Simpan</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal edit tutor -->

</div>
<input type="hidden" id="table-url" value="{{ route('tryouts.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('name') || $errors->has('start_date') || $errors->has('end_date'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#tryout-table').DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            ajax: {
                'url': $('#table-url').val(),
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px'},
                { data: 'name', name: 'name'},
                { data: 'start_date', name: 'start_date', orderable: true},
                { data: 'end_date', name: 'end_date', orderable: true},
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action', width: '160px', orderable: false, searchable: false},
            ]
        });
    });

    // Handle delete button click
    $('#tryout-table').on('click', '.delete-tryout', function() {
        var tryOutId = $(this).data('id');
        Swal.fire({
            title: 'Anda yakin ingin menghapus tryout ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: true,
            width: '500px',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/tryout/delete/' + tryOutId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error deleting tryout.',
                        });
                    }
                });
            }
        });
    });


   // Handle edit button click
   $('#tryout-table').on('click', '.edit-tryout', function(e) {
        e.preventDefault();
        var rowData = $(this).closest('tr').find('td');
        var tryOutId = $(this).data('id');
        var route = '{{ route("tryouts.update", ":id") }}';
        route = route.replace(':id', tryOutId);

        // Extract the original date values from the table cells
        var startDate = rowData.eq(2).text().trim();
        var endDate = rowData.eq(3).text().trim();
        var startDateObject = moment(startDate, 'DD MMM YYYY, HH:mm');
        var formattedStartDate = startDateObject.format('YYYY-MM-DD HH:mm:ss');

        var endDateObject = moment(endDate, 'DD MMM YYYY, HH:mm');
        var formattedEndDate = endDateObject.format('YYYY-MM-DD HH:mm:ss');

        // Fill the modal form with the current data
        $('#editModal #tryOutId').val(tryOutId);
        $('#editModal #name').val(rowData.eq(1).text().trim());
        $('#editModal #start_date').val(formattedStartDate); // Fill start_date input
        $('#editModal #end_date').val(formattedEndDate); // Fill end_date input
        $('#editModal #editTryOut').attr('action', route);

        // Show the modal
        $('#editModal').modal('show');
    });

    //handle detail button click
    $('#tryout-table').on('click', '.view-subtest', function() {
        var tryOutId = $(this).data('id');
        $.ajax({
            url: '/subtest/' + tryOutId,
            type: 'GET',
            success: function(response) {
                location.href = '/subtest/' + tryOutId;
            },
            error: function(xhr) {
                alert('Error showing detail tryout.');
            }
        });
    });

</script>

@endpush