@extends('web.layout-dashboard')
@section('title', 'Manajemen User')
@push('css')
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
    </style>
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-coolor-white rbt-shadow-box mb--60">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Landing Page</h4>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0" style="font-size: 18px;">
                Manajemen User
            </h4>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="user-management-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Role</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
<input type="hidden" id="table-url" value="{{ route('user-management.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user-management-table').DataTable({
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
                { data: 'role', name: 'role'},
                { data: 'fullname', name: 'fullname'},
                { data: 'email', name: 'email'},
                { data: 'city.name', name: 'city.name'},
                { data: 'action', name: 'action', width: '100px'},
            ]
        });
    });

    // Handle delete button click
    $('#user-management-table').on('click', '.delete-user', function() {
        var userId = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data user setelah di hapus!",
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: true,
            width: '500px',
        }).then((result) => {
            // jika tombol ya di klik maka akan menghapus data
            if (result.isConfirmed) {
                $.ajax({
                    url: '/manajemen-user/delete/' + userId,
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
                            title: 'Gagal',
                            text: 'Error deleting user.',
                        });
                    }
                });
            }
        });
    });


    // Handle show button click
    $('#user-management-table').on('click', '.detail-user', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '/manajemen-user/detail/' + userId,
            type: 'GET',
            success: function(response) {
                location.href = '/manajemen-user/detail/' + userId;
            },
        });

    });
</script>

@endpush