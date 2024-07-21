@extends('web.layout-dashboard')
@section('title', 'Produk')
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        
        .bootstrap-select .dropdown-menu{
            height: 300px !important;
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

    </style>
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-coolor-white rbt-shadow-box mb--60">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Produk</h4>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0" style="font-size: 18px;">
                List Produk
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Tambah<i class="feather feather-plus"></i></button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="product-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Nama Try Out</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Price</th>
                        <th>Ie Gems</th>
                        <th>Peserta</th>
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
                        Tambah Produk
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="tryout_id">Try Out</label>
                                    <div class="filter-select rbt-modern-select">
                                        <select id="tryout_id" name="tryout_id" class="mb-0" data-live-search="true">
                                            <option value="" disabled>Pilih Tryout</option>
                                            @foreach ($tryouts as $tryout)
                                                <option value="{{ $tryout->id }}">{{ $tryout->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tryout_id')
                                            <span class="message-info">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="price">Harga</label>
                                    <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror mb-0" value="{{ old('price') }}" placeholder="Harga">
                                    @error('price')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="price">Ie Gems</label>
                                    <input type="number" id="ie_gems" name="ie_gems" class="form-control @error('ie_gems') is-invalid @enderror mb-0" value="{{ old('ie_gems') }}" placeholder="Ie Gems">
                                    @error('ie_gems')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="supported">Layanan yang didapatkan</label>
                                    <textarea id="supported" rows="5" name="supported" class="form-control @error('supported') is-invalid @enderror mb-0" placeholder="pisahkan item dengan enter">{{ old('supported') }}</textarea>
                                    @error('supported')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="not_supported">Layanan yang tidak didapatkan</label>
                                    <textarea id="not_supported" rows="5" name="not_supported" class="form-control @error('not_supported') is-invalid @enderror mb-0" placeholder="pisahkan item dengan enter">{{ old('not_supported') }}</textarea>
                                    @error('not_supported')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="answer_explanation_file">Pembahasan Soal</label>
                                    <div id="previewContainer"></div>
                                    <input type="file" id="answer_explanation_file" name="answer_explanation_file" style="border: none; margin-bottom: 0px;" accept=".pdf,.doc,.docx,.zip">
                                    @error('answer_explanation_file')
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
    <!-- End Modal create tutor -->

</div>
<input type="hidden" id="table-url" value="{{ route('products.get') }}">
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('tryout_id') || $errors->has('price') || $errors->has('ie_gems')  || $errors->has('supported') || $errors->has('not_supported') || $errors->has('answer_explanation_file'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif

        const priceInput = document.getElementById('price');

        priceInput.addEventListener('input', function (e) {
            const value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            if (value) {
                const formattedPrice = new Intl.NumberFormat('id').format(value);
                priceInput.value = formattedPrice; // Display the formatted price
            } else {
                priceInput.value = ''; // Clear the formatted price if input is empty
            }
        })
    });

</script>
<script>
    $(document).ready(function() {
        $('#product-table').DataTable({
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
                { data: 'try_outs.name', name: 'try_outs.name'},
                { data: 'try_outs.date', name: 'try_outs.date'},
                { data: 'price', name: 'price'},
                { data: 'ie_gems', name: 'ie_gems'},
                { data: 'participants', name: 'participants'},
                { data: 'action', name: 'action'},
            ]
        });
    });

    // Handle delete button click
    $('#product-table').on('click', '.delete-product', function() {
        var productId = $(this).data('id');
        
        Swal.fire({
            title: 'Anda yakin ingin menghapus product ini?',
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
                    url: '/produk/delete/' + productId,
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
                            text: 'Error deleting product.',
                        });
                    }
                });
            }
        });
    });


    //handle detail button click
    $('#product-table').on('click', '.view-participants', function() {
        var productId = $(this).data('id');
        console.log(productId);
        $.ajax({
            url: '/peserta/' + productId,
            type: 'GET',
            success: function(response) {
                location.href = '/peserta/' + productId;
            },
            error: function(xhr) {
                alert('Error showing detail participants.');
            }
        });
    });

    $('#product-table').on('click', '.generate-score', function() {
        var tryOutId = $(this).data('id');
        
        // Menampilkan alert konfirmasi dengan SweetAlert2
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan memproses penilaian untuk try out ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Ya, Proses',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: true,
        }).then((result) => {
            // Jika tombol konfirmasi diklik
            if (result.isConfirmed) {
                $.ajax({
                    url: '/proses-nilai/' + tryOutId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Menampilkan notifikasi sukses dengan SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Nilai berhasil dibuat.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Menampilkan notifikasi error dengan SweetAlert2
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses nilai.',
                        });
                    }
                });
            }
        });
    });


</script>

@endpush