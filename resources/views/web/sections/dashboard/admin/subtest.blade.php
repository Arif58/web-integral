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

        .rbt-modern-select .bootstrap-select button.btn-light {
            border: 1px solid var(--color-badge-1);
            border-radius: 6px;
        }

        .checkout-form input {
            margin-bottom: 0px;
        }
    </style>
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Try Out</h4>
        </div>
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3">
                <a href="/tryout" class="me-4"><i class="feather feather-arrow-left"></i></a><b>Daftar Try Out / </b><span style="color: #9f9f9f; font-weight: normal">{{ $tryOutDetail->name }}</span>       
            </h4>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 border-bottom-0 my-auto">
                <b>Data Try Out</b>
            </h4>
            {{-- <button class="rbt-btn btn-sm bg-color-danger" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Hapus<i class="feather feather-trash"></i></button> --}}
        </div>
        <div class="container mb-5" style="border: 1px solid #757575">
            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 pt--30">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Nama Try Out</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $tryOutDetail->name }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Waktu Mulai</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2"><span class="local_date">{{ $tryOutDetail->start_date }}</span></div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15 pb--30">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Waktu Selesai</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2"><span class="local_date">{{ $tryOutDetail->end_date }}</span></div>
                </div>
            </div>
            <!-- End Profile Row  -->
        </div>
        
        {{-- subtest --}}
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0" style="font-size: 18px;">
                Subtes
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="subtest-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Kategori Subtes</th>
                        <th>Subtes</th>
                        <th>Durasi (menit)</th>
                        <th>Jumlah Soal</th>
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
                        Tambah Subtes
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('subtests.store', $tryOutDetail->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="rbt-form-group col-12 mb--30">
                                    <label for="category">Kategori Subtes</label>
                                    <div class="filter-select rbt-modern-select">
                                        <select id="category_subtest_id" name="category_subtest_id" class=" mb-0">
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            @foreach ($categorySubtest as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_subtest_id')
                                            <span class="message-info">{{ $message }}</span>  
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="name">Subtes</label>
                                    <input type="text" id="name" name="name" class="mb-0" value="{{ old('name') }}" placeholder="Subtes">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="duration">Durasi (menit)</label>
                                    <input type="number" id="duration" name="duration" class=" mb-0" value="{{ old('duration') }}" placeholder="Durasi">
                                    @error('duration')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="total_question">Jumlah Soal</label>
                                    <input type="number" id="total_question" name="total_question" class="mb-0" value="{{ old('total_question') }}" placeholder="Jumlah Soal">
                                    @error('total_question')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
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
                        <form action="" id="editSubtest" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="subtestId" name="subtestId">
                            <div class="row">
                                <div class="rbt-form-group col-12 mb--30">
                                    <label for="category">Kategori Subtes</label>
                                    <div class="filter-select rbt-modern-select">
                                        <select id="edit_category_subtest_id" name="category_subtest_id" class="select-picker mb-0">
                                            {{-- <option value="" disabled>Pilih Kategori</option> --}}
                                            {{-- @foreach ($categorySubtest as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('category_subtest_id')
                                            <span class="message-info">{{ $message }}</span>  
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="name">Subtes</label>
                                    <input type="text" id="edit_name" name="name" class="mb-0" value="{{ old('name') }}" placeholder="Subtes">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="duration">Durasi (menit)</label>
                                    <input type="number" id="edit_duration" name="duration" class="mb-0" value="{{ old('duration') }}" placeholder="Durasi">
                                    @error('duration')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>
                                <div class="col-12 mb--30">
                                    <label for="total_question">Jumlah Soal</label>
                                    <input type="number" id="edit_total_question" name="total_question" class="mb-0" value="{{ old('total_question') }}" placeholder="Jumlah Soal">
                                    @error('total_question')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
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
<input type="hidden" id="table-url" value="{{ route('subtests.get', $tryOutDetail->id) }}">
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('name') || $errors->has('category_subtest_id') || $errors->has('duration') || $errors->has('total_question'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif
    });
</script>
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
                { data: 'category_subtest.name', name: 'category_subtest.name'},
                { data: 'name', name: 'name'},
                { data: 'duration', name: 'duration', width: '20px'},
                { data: 'total_question', name: 'total_question', width: '20px'},
                { data: 'action', name: 'action', width: '160px'},
            ]
        });
    });

    // Handle delete button click
    $('#subtest-table').on('click', '.delete-subtest', function() {
        var subtestId = $(this).data('id');
        if (confirm('Are you sure you want to delete this sub test?')) {
            $.ajax({
                url: '/subtest/delete/' + subtestId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('sub test deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting sub test.');
                }
            });
        }
    });

   // Handle edit button click
   $('#subtest-table').on('click', '.edit-subtest', function(e) {
        e.preventDefault();

        var rowData = $(this).closest('tr').find('td');
        var subtestId = $(this).data('id');
        //mendapatkan nilai category_subtest_id yg diparsing dari button edit
        var categorySubtestId = $(this).data('category_subtest_id');

        //mendapatkan nilai total_question yg diparsing dari button edit
        var total_question = $(this).data('total_question');

        var categorySubtest = @json($categorySubtest);

        var categorySubtestSelect = $('#edit_category_subtest_id');

        categorySubtestSelect.empty();

        categorySubtest.forEach(function(category) {
            console.log(categorySubtestId)
            var option = new Option(category.name, category.id);
            if (category.id == categorySubtestId) {
                option.selected = true;
            }
            categorySubtestSelect.append(option);
        });

        categorySubtestSelect.selectpicker('refresh');

        var route = '{{ route("subtests.update", ":id") }}';
        route = route.replace(':id', subtestId);

        // Fill the modal form with the current data
        $('#editModal #subtestId').val(subtestId);
        $('#editModal #editSubtest').attr('action', route);
        // $('#editModal #edit_category_subtest_id').val(categorySubtestId);
        $('#editModal #edit_name').val(rowData.eq(2).text());
        $('#editModal #edit_duration').val(rowData.eq(3).text());
        $('#editModal #edit_total_question').val(total_question);

        $('#editModal').modal('show');
    });

    //handle detail button click
    $('#subtest-table').on('click', '.view-question', function() {
        var subtestId = $(this).data('id');
        $.ajax({
            url: '/soal/' + subtestId,
            type: 'GET',
            success: function(response) {
                location.href = '/soal/' + subtestId;
            },
            error: function(xhr) {
                alert('Error showing detail question.');
            }
        });
    });
</script>
<script>
    (function () {
        var dates = document.getElementsByClassName('local_date');
        for(var i = 0; i < dates.length; i++) {
            var date = moment.utc(dates[i].textContent);
            dates[i].textContent = date.local().format('DD MMMM YYYY, HH:mm');
        }
    })();
</script>    
@endpush