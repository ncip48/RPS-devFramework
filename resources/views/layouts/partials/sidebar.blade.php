{{-- <x-maz-sidebar :href="url('admin/dashboard')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    @if (Auth::user()->role == 0)
        <x-maz-sidebar-item name="Dashboard" :link="url('admin/dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="User" :link="url('admin/user')" icon="bi bi-person-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Dosen" :link="url('admin/dosen')" icon="bi bi-person-circle"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Fakultas" :link="url('admin/fakultas')" icon="bi bi-cone-striped"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Program Studi" :link="url('admin/prodi')" icon="bi bi-book-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Mata Kuliah" :link="url('admin/matkul')" icon="bi bi-file-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="RPS" :link="url('admin/rps')" icon="bi bi-file-earmark-text-fill"></x-maz-sidebar-item>
    @else
        <x-maz-sidebar-item name="Dashboard" :link="url('dosen/dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Mata Kuliah" :link="url('dosen/matkul')" icon="bi bi-file-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="RPS" :link="url('dosen/rps')" icon="bi bi-file-earmark-text-fill"></x-maz-sidebar-item>
    @endif

    <hr />
    <li class="sidebar-item">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
        </form>
        <a class='sidebar-link cursor-pointer' onclick="document.getElementById('logout-form').submit()">
            <i class="bi bi-door-closed-fill"></i>
            <span>Logout</span>
        </a>
    </li>

</x-maz-sidebar> --}}

@php
    //call the controller Controller.php file
    $controller = new App\Http\Controllers\Controller();
@endphp

<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="{{ url('dashboard') }}"><img src="{{ asset('img/logo.png') }}" alt /></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        @if ($controller->getGuard() == 'web')
            <x-sidebar-item name="Dashboard" :link="url('dashboard')" icon="bi bi-grid-fill"></x-sidebar-item>
            <x-sidebar-item name="Master Produk" :link="url('produk')" icon="bi bi-box2-fill"></x-sidebar-item>
            <x-sidebar-item name="Master Institusi" :link="url('institusi')" icon="bi bi-building-fill">
                <x-sidebar-sub-item name="Intitusi" :link="url('institusi')">
                </x-sidebar-sub-item>
                <x-sidebar-sub-item name="Pengajar" :link="url('pengajar')">
                </x-sidebar-sub-item>
                <x-sidebar-sub-item name="Jurusan" :link="url('jurusan')">
                </x-sidebar-sub-item>
                <x-sidebar-sub-item name="Materi" :link="url('materi')">
                </x-sidebar-sub-item>
            </x-sidebar-item>
            <x-sidebar-item name="Master Personal" :link="url('personal')" icon="bi bi-person-square"></x-sidebar-item>
            <x-sidebar-item name="Template RPS" :link="url('template-rps')" icon="bi bi-file-earmark-break-fill">
            </x-sidebar-item>
            <x-sidebar-item name="RPS" :link="url('rps')" icon="bi bi-file-earmark-fill"></x-sidebar-item>
            <x-sidebar-item name="Transaksi" :link="url('invoice')" icon="bi bi-receipt"></x-sidebar-item>
        @elseif ($controller->getGuard() == 'institute')
            <x-sidebar-item name="Dashboard" :link="url('dashboard')" icon="bi bi-grid-fill"></x-sidebar-item>
            <x-sidebar-item name="Pengajar" :link="url('pengajar')" icon="bi bi-people-fill"></x-sidebar-item>
            <x-sidebar-item name="Personal" :link="url('personal')" icon="bi bi-person-square"></x-sidebar-item>
            <x-sidebar-item name="Jurusan" :link="url('jurusan')" icon="bi bi-display-fill"></x-sidebar-item>
            <x-sidebar-item name="Materi" :link="url('materi')" icon="bi bi-book-fill"></x-sidebar-item>
            <x-sidebar-item name="Template RPS" :link="url('template-rps')" icon="bi bi-file-earmark-break-fill">
            </x-sidebar-item>
            <x-sidebar-item name="RPS" :link="url('rps')" icon="bi bi-file-earmark-fill"></x-sidebar-item>
            <x-sidebar-item name="Subscribe" :link="url('invoice')" icon="bi bi-receipt"></x-sidebar-item>
            <x-sidebar-item name="Panduan" :link="url('panduan')" icon="bi bi-question-circle-fill"></x-sidebar-item>
        @elseif ($controller->getGuard() == 'personal')
            <x-sidebar-item name="Dashboard" :link="url('dashboard')" icon="bi bi-grid-fill"></x-sidebar-item>
            <x-sidebar-item name="Materi" :link="url('materi')" icon="bi bi-book-fill"></x-sidebar-item>
            <x-sidebar-item name="RPS" :link="url('rps')" icon="bi bi-file-earmark-fill"></x-sidebar-item>
        @endif

        {{-- <hr /> --}}
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
            </form>
            <a class='sidebar-link cursor-pointer' onclick="document.getElementById('logout-form').submit()">
                <i class="bi bi-door-closed-fill" style="font-size: 1.4rem;"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>
