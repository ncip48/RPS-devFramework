@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'Tambah Pengajar')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah Pengajar</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('pengajar.store') }}" method="POST" autocomplete="off">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control"
                                        placeholder="NIP" value="{{ old('nip') }}">
                                    @error('nip')
                                        <label for="nip" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control"
                                        placeholder="NIK" value="{{ old('nik') }}">
                                    @error('nik')
                                        <label for="nik" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <label for="gender" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">No HP</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <label for="phone" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                @if ($helpers->isAdminGuard())
                                    <div class="mb-3">
                                        <label for="id_institute" class="form-label">Institusi</label>
                                        <select name="id_institute" id="id_institute" class="form-control">
                                            @foreach ($institutes as $institute)
                                                <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_institute')
                                            <label for="id_institute" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                @else
                                    <input type="hidden" name="id_institute" value="{{ $helpers->getInstituteId() }}">
                                @endif
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('pengajar.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
