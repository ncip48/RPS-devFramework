@section('title', 'fakultas')

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Fakultas</h3>
                <p class="text-subtitle text-muted">Mengedit data fakultas</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.fakultas.index') }}">fakultas</a></li>
                        <li class="breadcrumb-item active">Edit fakultas</li>
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
                        <h4 class="card-title">Edit Data Fakultas</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.fakultas.update', $fakultas) }}" autocomplete="off"
                                id="form-edit-fakultas">
                                {{-- create input with csrf token and bootstrap class --}}
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_fakultas">Fakultas</label>
                                    <input type="text" id="nama_fakultas" class="form-control" placeholder="Masukan Fakultas Anda"
                                        name="nama_fakultas" value="{{ $fakultas->nama_fakultas }}">
                                    @error('nama_fakultas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_dekan">ID Dekan</label>
                                    <input type="text" id="Id_dekan" class="form-control" placeholder="Masukan ID Anda"
                                        name="id_dekan" value="{{ $fakultas->id_dekan }}">
                                    @error('id_dekan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_dekan">Nama Dekan</label>
                                    <input type="text" id="nama_dekan" class="form-control" placeholder="Masukan Nama Anda"
                                        name="nama_dekan">
                                    @error('nama_dekan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-footer py-0 border-top-0 pb-4">
                        <button type="submit" class="btn btn-primary" form="form-edit-fakultas"><i
                                class="bi bi-save me-2"></i>
                            Simpan</button>
                        <a href="{{ route('admin.fakultas.index') }}" class="btn btn-danger ms-2"><i
                                class="bi bi-x-circle me-2"></i>
                            Batal</a>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
