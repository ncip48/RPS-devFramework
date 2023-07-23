@section('title', 'Matkul')
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Matkul</h3>
                <p class="text-subtitle text-muted">Menampilkan data Matkul</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mata Kuliah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">List Mata Kuliah</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            @if (session('success'))
                                <div class="alert alert-light-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('admin.matkul.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i> Tambahkan</a>
                                <form action="{{ route('admin.matkul.index') }}" method="GET" autocomplete="off">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-secondary"
                                            placeholder="Cari matkul" name="search">
                                        <button class="btn btn-secondary" type="submit" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- table head dark -->
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Matkul</th>
                                            <th>Nama Matkul</th>
                                            <th>Dosen</th>
                                            <th>Prodi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($matkuls as $matkul)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $matkul->kode_matkul}}</td>
                                                <td>{{ $matkul->nama_matkul}}</td>
                                                <td>{{ $matkul->dosen}}</td>
                                                <td>{{ $matkul->prodi}}</td>                     
                                                <td>
                                                    <a href="{{ route('admin.matkul.edit', $matkul->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.matkul.destroy', $matkul->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    Data tidak tersedia
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                {{ $matkuls->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>