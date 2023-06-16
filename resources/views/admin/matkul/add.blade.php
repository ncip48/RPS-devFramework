@section('title', 'matkul')

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah matkul</h3>
                <p class="text-subtitle text-muted">Menambahkan data matkul</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.matkul.index') }}">matkul</a></li>
                        <li class="breadcrumb-item active">Tambah matkul</li>
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
                        <h4 class="card-title">Tambah Data matkul</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.matkul.store') }}" autocomplete="off"
                                id="form-tambah-matkul">
                                {{-- create input with csrf token and bootstrap class --}}
                                @csrf
                                <div class="form-group">
                                    <label for="nama_matkul">matkul</label>
                                    <input type="text" id="nama_matkul" class="form-control" placeholder="Masukkan matkul"
                                        name="nama_matkul">
                                    @error('nama_matkul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_dosen">Dosen</label>
                                    <input  id="id_dosen" class="form-control"
                                        placeholder="Masukan ID Anda" name="id_dosen">
                                    @error('id_dosen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_prodi">Prodi</label>
                                    <input type="text" id="id_prodi" class="form-control" placeholder="Masukan Prodi"
                                        name="id_prodi">
                                    @error('id_prodi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer py-0 border-top-0 pb-4">
                        <button type="submit" class="btn btn-primary" form="form-tambah-matkul"><i
                                class="bi bi-save me-2"></i>
                            Simpan</button>
                        <a href="{{ route('admin.matkul.index') }}" class="btn btn-danger ms-2"><i
                                class="bi bi-x-circle me-2"></i>
                            Batal</a>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
