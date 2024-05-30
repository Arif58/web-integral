@extends('web.layout-dashboard')
@section('title', 'Testimoni Siswa')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <style>
        div.dt-container select.dt-input {
            width: 20%;
            height: auto;
        }
        div.dt-container .dt-paging .dt-paging-button.current {
            background: linear-gradient(rgb(29, 59, 100) 0%, rgb(55, 116, 155) 100%) !important;
            color: white !important;
        }
        div.dt-container {
            margin-bottom: 20px;
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
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Testimoni Siswa
            </h4>
            <button class="rbt-btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#formModal" >Tambah +</button>
        </div>
        <div style="border-bottom: 2px solid var(--color-border-2); margin-bottom: 24px;">
            <table class="table" id="testimonials-table">
                <thead class="bg-gradient-18">
                    <tr class="color-white">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Testimoni</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($testimonials as $key => $testimonial)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->major }}</td>
                            <td>{{ $testimonial->testimonials }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" style="max-width: 100px; height: auto;">
                            </td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Edit</a>
                                <form action="" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Testimoni yang Ditampilkan
            </h4>
            <a href="/ubah-profil"><p class="font-weight-light">Ubah</p></a>
        </div>
        <div class="row">
            @foreach ($highlightOrderRowOne as $key => $item)
                <div class="col">
                    <b>Testimoni {{ $item->highlighted_order}}</b>
                    <p class="">{{ $item->name }}</p>
                </div>
            @endforeach
        </div>
        <div class="row mt-5">
            @foreach ($highlightOrderRowTwo as $key => $item)
                <div class="col">
                    <b>Testimoni {{ $item->highlighted_order}}</b>
                    <div class="rbt-profile-content b2">{{ $item->name }}</div>
                </div>
            @endforeach
        </div>
    </div>

     <!-- start modal form testimoni -->
     <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Tambah Testimoni Siswa
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Nama Lengkap" class="form-control @error('name') is-invalid @enderror mb-0" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="major">Jurusan</label>
                                    <input type="text" id="major" name="major" placeholder="Jurusan" class="form-control @error('major') is-invalid @enderror mb-0" value="{{ old('major') }}">
                                    @error('major')
                                        <span class="message-info">{{ $message }}</span>  
                                    @enderror
                                </div>

                                <div class="col-12 mb--30">
                                    <label for="testimonials">Testimoni</label>
                                    <textarea id="testimonials" rows="5" name="testimonials" class="form-control @error('testimonials') is-invalid @enderror mb-0">{{ old('testimonials') }}</textarea>
                                    @error('testimonials')
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
                            <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal" style="width: 280px;">Batal</button>
                            <button type="submit" class="rbt-btn btn-gradient btn-md" style="color: white; border-radius: 4px; width: 280px">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Daftar -->

</div>
<input type="hidden" id="table-url" value="{{ route('testimonials.get') }}">
@endsection
@push('scripts')
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

    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#testimonials-table').DataTable({
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
                { data: 'major', name: 'major', width: '15%'},
                { data: 'testimonials', name: 'testimonials', width: '35%'},
                { data: 'photo', name: 'photo' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@endpush