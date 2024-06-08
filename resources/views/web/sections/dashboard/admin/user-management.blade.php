@extends('web.layout-dashboard')
@section('title', 'Manajemen User')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <style>
        div.dt-container select.dt-input {
            width: 20%;
            height: auto;
            margin-right: 10px;
        }

        div.dt-container .dt-search input {
            margin-left: 10px;
        }
        div.dt-container .dt-paging .dt-paging-button.current {
            background: linear-gradient(rgb(29, 59, 100) 0%, rgb(55, 116, 155) 100%) !important;
            color: white !important;
        }
        div.dt-container {
            margin-bottom: 20px;
        }
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

        table.dataTable>tbody>tr>th, table.dataTable>tbody>tr>td {
            color: #616161;
            font-size: 16px;
        }

        table.dataTable thead th, table.dataTable tfoot th {
            font-weight: normal;
            font-size: 16px;
        }

        div.dt-container div.dt-layout-row {
            font-size: 16px;
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
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/manajemen-user/delete/' + userId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('user deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting user.');
                }
            });
        }
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