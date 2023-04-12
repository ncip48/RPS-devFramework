<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

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

</x-maz-sidebar>
