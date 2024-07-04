@extends('web.layout-dashboard')
@section('title', 'Tryout Subtest')
@push('css')
    <style>
        .rbt-title-style-3{
            font-size: 18px;
        }

        .rbt-btn.btn-sm {
            padding: 0 10px; 
            height: 35px; 
            line-height: 35px;
        }

        .bootstrap-select .dropdown-menu{
            height: 70px;
        }

        /* .bootstrap-select {
            width: 100% !important;
        }
        .inner .show {
            max-height: 100%;
            font-size: 14px;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            font-size: 14px;
        }

        .rbt-modern-select .bootstrap-select button.btn-light {
            border: 1px solid var(--color-badge-1);
            border-radius: 6px;
        }

        .checkout-form input {
            margin-bottom: 0px;
        } */
    </style>
@endpush
@section('content')
<div class="content">
    {{-- @dd($product); --}}
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Peserta </h4>
        </div>
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3">
                <a href="/produk" class="me-4"><i class="feather feather-arrow-left"></i></a><b>Daftar Produk / </b><span style="color: #9f9f9f; font-weight: normal">{{ $product->tryOut->name }}</span>       
            </h4>
        </div>
    
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="subtest-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Rata-rata Skor</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="table-url" value="{{ route('participants.get', $product->id) }}">
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#subtest-table').DataTable({
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
                { data: 'email', name: 'email'},
                { data: 'average_score', name: 'average_score'},
            ]
        });
    });
</script>    
@endpush