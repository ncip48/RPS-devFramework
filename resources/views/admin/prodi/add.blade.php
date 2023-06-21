@section('title', 'Prodi')

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Prodi</h3>
                <p class="text-subtitle text-muted">Menambahkan data prodi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.prodi.index') }}">Prodi</a></li>
                        <li class="breadcrumb-item active">Tambah Prodi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Prodi</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.prodi.store') }}" autocomplete="off"
                                id="form-tambah-prodi">
                                {{-- create input with csrf token and bootstrap class --}}
                                @csrf
                                <div class="form-group">
                                    <label for="id_fakultas">Fakultas</label>
                                    <select name="id_fakultas" id="id_fakultas" class="form-select">
                                        <option value="0">Tidak Ada</option>
                                        @foreach ($fakultases as $fakultas)
                                        <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_fakultas')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Prodi</label>
                                    <input type="text" id="name" class="form-control" placeholder="Informatika"
                                        name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_kaprodi">Kaprodi</label>
                                    <select name="id_kaprodi" id="id_kaprodi" class="form-select">
                                        <option value="0">Tidak Ada</option>
                                        @foreach ($kaprodis as $kaprodi)
                                            <option value="{{ $kaprodi->id }}">{{ $kaprodi->nama_dosen }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kaprodi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_sekprodi">Sekprodi</label>
                                    <select name="id_sekprodi" id="id_sekprodi" class="form-select">
                                        <option value="0">Tidak Ada</option>
                                        @foreach ($sekprodis as $sekprodi)
                                            <option value="{{ $sekprodi->id }}">{{ $sekprodi->nama_dosen }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sekprodi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer py-0 border-top-0 pb-4">
                        <button type="submit" class="btn btn-primary" form="form-tambah-prodi"><i
                                class="bi bi-save me-2"></i>
                            Simpan</button>
                        <a href="{{ route('admin.prodi.index') }}" class="btn btn-danger ms-2"><i
                                class="bi bi-x-circle me-2"></i>
                            Batal</a>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
