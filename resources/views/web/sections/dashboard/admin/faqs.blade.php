@extends('web.layout-dashboard')
@section('title', 'FAQ')
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
                FAQ
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal" >Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="faqs-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
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
                        Tambah FAQ
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="form_type" value="tambah">
                                <div class="col-12 mb--30">
                                    <label for="question">Pertanyaan</label>
                                    <textarea id="question" rows="5" name="question" class="form-control @error('question') is-invalid @enderror mb-0">{{ old('question') }}</textarea>
                                    @error('question')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="answer">Jawaban</label>
                                    <textarea id="answer" rows="5" name="answer" class="form-control @error('answer') is-invalid @enderror mb-0">{{ old('answer') }}</textarea>
                                    @error('answer')
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
                        Ubah Tutor
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="" id="editTutorForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="form_type" value="edit">
                            <input type="hidden" id="faqId" name="faqId">
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="question">Pertanyaan</label>
                                    <textarea id="question" rows="5" name="question" class="form-control @error('question') is-invalid @enderror mb-0">{{ old('question') }}</textarea>
                                    @error('question')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="answer">Jawaban</label>
                                    <textarea id="answer" rows="5" name="answer" class="form-control @error('answer') is-invalid @enderror mb-0">{{ old('answer') }}</textarea>
                                    @error('answer')
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
<input type="hidden" id="table-url" value="{{ route('faqs.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('question') || $errors->has('answer'))
            @if(old('form_type') == 'tambah')
                var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            @elseif(old('form_type') == 'edit')
                var formModal = new bootstrap.Modal(document.getElementById('editModal'));

                var faqId = '{{ old('faqId') }}';
                var route = '{{ route("faqs.update", ":id") }}';
                route = route.replace(':id', faqId);

                // Fill the modal form with the current data
                $('#editModal #faqId').val(faqId);
                $('#editModal #question').val('{{ old('question') }}');
                $('#editModal #answer').val('{{ old('answer') }}');
                $('#editModal #editTutorForm').attr('action', route);
            @endif
            formModal.show();
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#faqs-table').DataTable({
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
                { data: 'question', name: 'question', width: '40%'},
                { data: 'answer', name: 'answer', width: '50%'},
                { data: 'action', name: 'action', width: '100%'},
            ]
        });
    });

    // Handle delete button click
    $('#faqs-table').on('click', '.delete-faq', function() {
        var faqId = $(this).data('id');
        Swal.fire({
            title: 'Anda yakin ingin menghapus FAQ ini?',
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
                    url: '/faq/delete/' + faqId,
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
                            text: 'Error deleting FAQ.',
                        });
                    }
                });
            }
        });
    });


    // Handle edit button click
    $('#faqs-table').on('click', '.edit-faq', function(e) {
        e.preventDefault();
        var rowData = $(this).closest('tr').find('td');
        var faqId = $(this).data('id');
        var route = '{{ route("faqs.update", ":id") }}';
        route = route.replace(':id', faqId);

        // Fill the modal form with the current data
        $('#editModal #faqId').val(faqId);
        $('#editModal #question').val(rowData.eq(1).text());
        $('#editModal #answer').val(rowData.eq(2).text());
        $('#editModal #editTutorForm').attr('action', route);
        
        // Show the modal
        $('#editModal').modal('show');
    });
</script>

@endpush