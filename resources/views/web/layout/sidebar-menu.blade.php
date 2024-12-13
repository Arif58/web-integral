<li><a href="/dashboard"><i class="feather-home"></i><span>Dashboard</span></a></li>

@if (Auth::user()->role === 'student')
<li><a href="/tryout-saya"><i class="feather-book-open"></i><span>Try Out Saya</span></a></li>
<li><a href="/pencapaian"><i class="feather-award"></i><span>Pencapaian</span></a></li>
<li><a href="/riwayat-pembelian"><i class="feather-shopping-cart"></i><span>Riwayat Pembelian</span></a></li>
@elseif (Auth::user()->role === 'admin')
<li class="accordion" id="accordionOne">
    <div class="accordion-item border-0">
        <a href="#" class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="button">
            <i class="feather-home"></i><span>Landing Page</span>
            <i class="feather-chevron-down arrow-icon"></i>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionOne">
            <ul>
                <li class="mt-2 mb--0 ms-3"><a href="/testimoni-siswa"><span>Testimoni Siswa</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/prestasi-siswa"><span>Prestasi Siswa</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tutor"><span>Tutor</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/faq"><span>FAQ</span></a></li>
            </ul>
        </div>
    </div>
</li>
<li class="accordion" id="accordionTwo">
    <div class="accordion-item border-0">
        <a href="#" class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="button">
            <i class="feather-home"></i><span>Pendidikan Tinggi</span>
            <i class="feather-chevron-down arrow-icon"></i>
        </a>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionTwo">
            <ul>
                <li class="mt-2 mb--0 ms-3"><a href="/rumpun"><span>Rumpun</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/universitas"><span>Universitas</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/program-studi"><span>Program Studi</span></a></li>
            </ul>
        </div>
    </div>
</li>
<li class="accordion" id="accordionThree">
    <div class="accordion-item border-0">
        <a href="#" class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="button">
            <i class="feather-clipboard"></i><span>Manajemen Try Out</span>
            <i class="feather-chevron-down arrow-icon"></i>
        </a>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionThree">
            <ul>
                <li class="mt-2 mb--0 ms-3"><a href="/kategori-subtest"><span>Kategori Subtest</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tryout"><span>Try Out</span></a></li>
            </ul>
        </div>
    </div>
</li>
<li><a href="/produk"><i class="feather-shopping-cart"></i><span>Produk</span></a></li>
<li><a href="/manajemen-user"><i class="feather-users"></i><span>Manajemen User</span></a></li>
@endif
<li><a href="/profil-saya"><i class="feather-user"></i><span>Profil Saya</span></a></li>
<li>
    {{-- <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather-log-out"></i><span>Keluar</span></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form> --}}
    <a  href="#" onclick="confirmLogout(event)"><i class="feather-log-out"></i><span>Keluar</span></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.accordion-toggle').on('click', function() {
            // Toggle class on the icon
            $(this).find('.arrow-icon').toggleClass('rotate-180');
        });
    });

</script>
@endpush
