@extends('web.layout-dashboard')
@section('title', 'Program Studi')
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
            height: 120px;
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
                Program Studi
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="major-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Universitas</th>
                        <th>Rumpun</th>
                        <th>Jurusan</th>
                        <th>Passing Grade</th>
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
                        Tambah Program Studi
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('majors.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="university">Universitas</label>
                                    <select id="university_id" name="university_id" class="form-control @error('university_id') is-invalid @enderror mb-0">
                                        <option value="" selected disabled>Pilih Universitas</option>
                                        @foreach ($universities as $university)
                                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('university_id')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="cluster">Rumpun</label>
                                    <select id="cluster_id" name="cluster_id" class="form-control @error('cluster_id') is-invalid @enderror mb-0">
                                        <option value="" selected disabled>Pilih Rumpun</option>
                                        @foreach ($clusters as $cluster)
                                            <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cluster_id')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="name">Jurusan</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}" placeholder="Jurusan">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="passing_grade">Passing Grade</label>
                                    <input type="text" id="passing_grade" name="passing_grade" class="form-control @error('passing_grade') is-invalid @enderror mb-0" value="{{ old('passing_grade') }}" placeholder="Passing Grade">
                                    @error('passing_grade')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="rbt-btn btn-gradient btn-md" style="color: white; border-radius: 4px; width: 100%">Simpan</button>
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
                        Ubah Tutor
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="" id="editMajorForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="majorId" name="majorId">
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="university">Universitas</label>
                                    <select id="edit_university_id" name="university_id" class="form-control @error('university_id') is-invalid @enderror mb-0">
                                        <option value="" disabled>Pilih Universitas</option>
                                        @foreach ($universities as $university)
                                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('university_id')
                                        <span class="message-info">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="cluster">Rumpun</label>
                                    <select id="edit_cluster_id" name="cluster_id" class="form-control @error('cluster_id') is-invalid @enderror mb-0">
                                        <option value="" disabled>Pilih Rumpun</option>
                                        @foreach ($clusters as $cluster)
                                            <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cluster_id')
                                        <span class="message-info">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="name">Jurusan</label>
                                    <input type="text" id="edit_name" name="name" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}" placeholder="Jurusan">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="passing_grade">Passing Grade</label>
                                    <input type="text" id="edit_passing_grade" name="passing_grade" class="form-control @error('passing_grade') is-invalid @enderror mb-0" value="{{ old('passing_grade') }}" placeholder="Passing Grade">
                                    @error('passing_grade')
                                        <span class="message-info">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="rbt-btn btn-gradient btn-md" style="color: white; border-radius: 4px; width: 100%">Simpan</button>
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
<input type="hidden" id="table-url" value="{{ route('majors.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('name') || $errors->has('cluster_id') || $errors->has('university_id') || $errors->has('passing_grade'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#major-table').DataTable({
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
                { data: 'university.name', name: 'university.name'},
                { data: 'cluster.name', name: 'cluster.name'},
                { data: 'name', name: 'name'},
                { data: 'passing_grade', name: 'passing_grade'},
                { data: 'action', name: 'action', width: '100px'},
            ]
        });
    });

    // Handle delete button click
    $('#major-table').on('click', '.delete-major', function() {
        var majorId = $(this).data('id');
        if (confirm('Are you sure you want to delete this major?')) {
            $.ajax({
                url: '/program-studi/delete/' + majorId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Major deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting major.');
                }
            });
        }
    });

    // Handle edit button click
    $('#major-table').on('click', '.edit-major', function(e) {
        e.preventDefault();
        
        var majorId = $(this).data('id');
        var universityId = $(this).data('university_id');
        var clusterId = $(this).data('cluster_id');

        // Check the data retrieved from the clicked button
        // console.log('Major ID:', majorId);
        // console.log('University ID:', universityId);
        // console.log('Cluster ID:', clusterId);

        var route = '{{ route("majors.update", ":id") }}';
        route = route.replace(':id', majorId);

        var rowData = $(this).closest('tr').find('td');
        
        // Fill the modal form with the current data
        $('#editModal #majorId').val(majorId);
        $('#editModal #edit_university_id').val(universityId).change();
        $('#editModal #edit_cluster_id').val(clusterId).change();
        $('#editModal #edit_name').val(rowData.eq(3).text());
        $('#editModal #edit_passing_grade').val(rowData.eq(4).text());
        $('#editModal #editMajorForm').attr('action', route);

        // Show the modal
        $('#editModal').modal('show');
    });
</script>

@endpush