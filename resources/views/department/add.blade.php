@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah Jurusan</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('jurusan.store') }}" method="POST" autocomplete="off">
                                @csrf
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
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode</label>
                                    <input type="text" name="code" id="code" class="form-control"
                                        placeholder="Code" value="{{ old('code') }}">
                                    @error('code')
                                        <label for="code" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Jurusan</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('jurusan.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
