@extends('web.layout-dashboard')
@section('title', 'Prestasi Siswa')
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
                Prestasi Siswa
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal" >Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="student-achievements-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Prestasi</th>
                        <th>Asal Sekolah</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Prestasi yang Ditampilkan
            </h4>
            <a type="button" data-bs-toggle="modal" data-bs-target="#highlightedModal"><p class="font-weight-light">Ubah</p></a>
        </div>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3">
            @foreach (range(1, 6) as $order)
                @php
                    $item = $highlightedOrder->firstWhere('highlighted_order', $order);
                @endphp
                <div class="col px-3" style="margin-bottom: 24px;">
                    <b>Prestasi {{ $order }}</b>
                    <p style="margin-top: 8px; color: #9f9f9f">{{ $item ? $item->name : 'tidak ada' }}</p>
                </div>
            @endforeach
        </div>
    </div>

     <!-- Start Modal create student achievement -->
     <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Tambah Prestasi Siswa
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('student-achievements.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Nama Lengkap" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}" maxlength="20">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="achievement">Prestasi</label>
                                    <input type="text" id="achievement" name="achievement" placeholder="Prestasi" class="form-control @error('achievement') is-invalid @enderror mb-0" value="{{ old('achievement') }}" maxlength="80">
                                    @error('achievement')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="school">asal sekolah</label>
                                    <input type="text" id="school" name="school" placeholder="Asal Sekolah" class="form-control @error('school') is-invalid @enderror mb-0" value="{{ old('school') }}" maxlength="60">
                                    @error('school')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="photo">Foto</label>
                                    <div id="previewContainer"></div>
                                    <input type="file" id="photo" name="photo" accept="image/*" style="border: none; margin-bottom: 0px;">
                                    @error('photo')
                                        <span class="message-info" style="position: relative;">{{ $message }}</span>  
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
    <!-- End Modal create student achievement -->

    <!-- Start Modal edit student achievement -->
    <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Ubah Testimoni Siswa
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="" id="editTestimonialForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="studentAchievementId" name="studentAchievementId">
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Nama Lengkap" class="form-control @error('name') is-invalid @enderror mb-0" maxlength="20">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="achievement">Prestasi</label>
                                    <input type="text" id="achievement" name="achievement" placeholder="Jurusan" class="form-control @error('achievement') is-invalid @enderror mb-0" value="{{ old('achievement') }}" maxlength="80">
                                    @error('achievement')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="school">Asal Sekolah</label>
                                    <input type="text" id="school" name="school" placeholder="Asal Sekolah" class="form-control @error('school') is-invalid @enderror mb-0" value="{{ old('school') }}" maxlength="60">
                                    @error('school')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="photo">Foto</label>
                                    <div id="editPreviewContainer"></div>
                                    <input type="file" id="edit_photo" name="photo" accept="image/*" style="border: none; margin-bottom: 0px;">
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
    <!-- End Modal edit student achievement -->

   <!-- start modal edit highlighted -->
    <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="highlightedModal" tabindex="-1" aria-labelledby="highlightedModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 900px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Prestasi yang Ditampilkan
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <form action="{{ route('student-achievements.update-highlight') }}" method="POST">
                        @csrf
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3">
                            @foreach (range(1, 6) as $order)
                            @php
                                $item = $highlightedOrder->firstWhere('highlighted_order', $order);
                                $selectName = "highlighted_order[]";
                                $errorName = "highlighted_order.".$order-1;
                            @endphp
                            <div class="col mb-4">
                                <b>Prestasi {{ $order }}</b>
                                <select name="{{ $selectName }}" id="highlighted_order.{{ $order-1 }}" class="highlighted-select">
                                    <option value="" @if(!$item) selected @endif>Tidak Ada</option>
                                    @foreach ($achievements as $achievement)
                                        <option value="{{ $achievement->id }}" @if($item && $item->id == $achievement->id) selected @endif>{{ $achievement->name }}</option>
                                    @endforeach
                                </select>
                                @error($errorName)
                                    <span class="text-danger" style="font-size: 10px;">{{ $message }}</span>
                                @enderror
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center mt--55">
                            <div class="col-3">
                                <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                            </div>
                            <div class="col-5">
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
    <!-- End Modal edit highlighted --> 

</div>
<input type="hidden" id="table-url" value="{{ route('student-achievements.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = ''; // Clear previous preview

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '130px'; // Adjust as needed
                img.style.height = 'auto'; // Adjust as needed
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('edit_photo').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('editPreviewContainer');
        previewContainer.innerHTML = ''; // Clear previous preview

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '130px'; // Adjust as needed
                img.style.height = 'auto'; // Adjust as needed
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('name') || $errors->has('achievement') || $errors->has('school') || $errors->has('photo'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
            
        @elseif($errors->has('highlighted_order') || $errors->has('highlighted_order.*'))
            var highlightedModal = new bootstrap.Modal(document.getElementById('highlightedModal'));
            highlightedModal.show();
        @endif
    });


</script>
<script>
    $(document).ready(function() {
        $('#student-achievements-table').DataTable({
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
                { data: 'name', name: 'name', width: '15%'},
                { data: 'achievement', name: 'achievement'},
                { data: 'school', name: 'school', width: '15%'},
                { data: 'photo', name: 'photo', width: '25%', class: 'text-center' },
                { data: 'action', name: 'action' , width: '15%'},
            ]
        });
    });

    // Handle delete button click
    $('#student-achievements-table').on('click', '.delete-achievement', function() {
        var studentAchievementId = $(this).data('id');
        if (confirm('Are you sure you want to delete this student achievement?')) {
            $.ajax({
                url: '/prestasi-siswa/delete/' + studentAchievementId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Student Achievement deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting student achievement.');
                }
            });
        }
    });

    // Handle edit button click
    $('#student-achievements-table').on('click', '.edit-achievement', function(e) {
        e.preventDefault();
        var rowData = $(this).closest('tr').find('td');
        var studentAchievementId = $(this).data('id');
        var route = '{{ route("student-achievements.update", ":id") }}';
        route = route.replace(':id', studentAchievementId);

        // Fill the modal form with the current data
        $('#editModal #studentAchievementId').val(studentAchievementId);
        $('#editModal #name').val(rowData.eq(1).text());
        $('#editModal #achievement').val(rowData.eq(2).text());
        $('#editModal #school').val(rowData.eq(3).text());
        $('#editModal #editTestimonialForm').attr('action', route);

        // Set the image preview
        var imgSrc = rowData.eq(4).find('img').attr('src');
        console.log(imgSrc);
        if (imgSrc) {
            $('#editModal #editPreviewContainer').html('<img src="' + imgSrc + '" style="max-width: 130px; height: auto;">')
        } else {
            $('#editModal #editPreviewContainer').html('');
        }
        
        // Show the modal
        $('#editModal').modal('show');
    });
</script>

@endpush