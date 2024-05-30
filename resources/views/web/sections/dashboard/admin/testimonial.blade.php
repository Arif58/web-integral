@extends('web.layout-dashboard')
@section('title', 'Testimoni Siswa')
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-coolor-white rbt-shadow-box mb--60">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Landing Page</h4>
        </div>
        <div class="section-title d-flex justify-content-between">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Testimoni Siswa
            </h4>
            <button class="rbt-btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#formModal" >Tambah +</button>
        </div>
    </div>

    <!-- start modal form testimoni -->
    <!-- Start Modal Daftar -->
    <div class="rbt-default-modal modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" style="background: transparent">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Tambah Testimoni Siswa
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('testimonials.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--10">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Nama Lengkap" class="form-control">
                                </div>

                                <div class="col-12 mb--10">
                                    <label for="major">Jurusan</label>
                                    <input type="text" id="major" name="major" placeholder="Jurusan">
                                </div>

                                <div class="col-12 mb--10">
                                    <label for="testimonials">Testimoni</label>
                                    <textarea id="testimonials" rows="5" name="testimonials"></textarea>
                                </div>

                                <div class="col-12 mb--10">
                                    <label for="photo">Foto</label>
                                    <input type="file" id="photo" name="photo" style="border: none">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer pt--30 justify-content-center">
                    <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal" style="width: 280px;">Batal</button>
                    <button type="submit" class="rbt-btn btn-gradient btn-md" style="color: white; border-radius: 4px; width: 280px">Simpan</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Daftar -->
</div>
@endsection