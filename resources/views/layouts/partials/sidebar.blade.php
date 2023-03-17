<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="url('admin/dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="User" :link="url('admin/user')" icon="bi bi-person-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Dosen" :link="url('admin/dosen')" icon="bi bi-person-circle"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Fakultas" :link="url('admin/fakultas')" icon="bi bi-cone-striped"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Program Studi" :link="url('admin/prodi')" icon="bi bi-book-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Mata Kuliah" :link="url('admin/matkul')" icon="bi bi-file-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="RPS" :link="url('admin/rps')" icon="bi bi-file-earmark-text-fill"></x-maz-sidebar-item>

    <hr />
    <li class="sidebar-item">
        <a onclick="" class='sidebar-link cursor-pointer'>
            <i class="bi bi-door-closed-fill"></i>
            <span>Logout</span>
        </a>
    </li>

</x-maz-sidebar>
