<li><a href="/dashboard"><i class="feather-home"></i><span>Dashboard</span></a></li>

@if (Auth::user()->role === 'student')
<li><a href="/tryout-saya"><i class="feather-book-open"></i><span>Try Out Saya</span></a></li>
<li><a href="/pencapaian"><i class="feather-award"></i><span>Pencapaian</span></a></li>
<li><a href="/pencapaian"><i class="feather-shopping-cart"></i><span>Riwayat Pembelian</span></a></li>
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
                <li class="border-top-0 my-0 ms-3"><a href="/tryout/hasil"><span>Prestasi Siswa</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tryout/hasil"><span>Tutor</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tryout/hasil"><span>FAQ</span></a></li>
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
                <li class="mt-2 mb--0 ms-3"><a href="/tryout"><span>Rumpun</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tryout/hasil"><span>Universitas</span></a></li>
                <li class="border-top-0 my-0 ms-3"><a href="/tryout/hasil"><span>Program Studi</span></a></li>
            </ul>
        </div>
    </div>
</li>
@endif
<li><a href="/profil"><i class="feather-user"></i><span>Profil Saya</span></a></li>
<li>
    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather-log-out"></i><span>Keluar</span></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
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
