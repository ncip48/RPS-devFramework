@section('title', 'Dosen')

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Dosen</h3>
                <p class="text-subtitle text-muted">Mengedit data dosen</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dosen.index') }}">dosen</a></li>
                        <li class="breadcrumb-item active">Edit dosen</li>
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
                        <h4 class="card-title">Edit Data Dosen</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.dosen.update', $dosen) }}" autocomplete="off"
                                id="form-edit-dosen">
                                {{-- create input with csrf token and bootstrap class --}}
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_dosen">Nama</label>
                                    <input type="text" id="nama_dosen" class="form-control" placeholder="Masukan Nama Anda"
                                        name="nama_dosen" value="{{ $dosen->nama_dosen }}">
                                    @error('nama_dosen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" id="nip" class="form-control" placeholder="Masukan NIP Anda"
                                        name="nip" value="{{ $dosen->nip }}">
                                    @error('nip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat_dosen">Alamat</label>
                                    <input type="text" id="alamat_dosen" class="form-control" placeholder="Masukan Alamat Anda"
                                        name="alamat_dosen">
                                    @error('alamat_dosen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group w-25">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                        <option value="0" {{ $dosen->jenis_kelamin == 0 ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="1" {{ $dosen->jenis_kelamin == 1 ? 'selected' : '' }}>perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-footer py-0 border-top-0 pb-4">
                        <button type="submit" class="btn btn-primary" form="form-edit-dosen"><i
                                class="bi bi-save me-2"></i>
                            Simpan</button>
                        <a href="{{ route('admin.dosen.index') }}" class="btn btn-danger ms-2"><i
                                class="bi bi-x-circle me-2"></i>
                            Batal</a>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
