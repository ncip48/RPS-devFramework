@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah Materi</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('materi.store') }}" method="POST" autocomplete="off">
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
                                    <label for="id_department" class="form-label">Jurusan</label>
                                    <select name="id_department" id="id_department" class="form-control">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->code }} -
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_department')
                                        <label for="id_department" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_teacher" class="form-label">Pengajar</label>
                                    <select name="id_teacher" id="id_teacher" class="form-control">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_teacher')
                                        <label for="id_teacher" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode</label>
                                    <input type="text" name="code" id="code" class="form-control"
                                        placeholder="Code" value="{{ old('code') }}">
                                    @error('code')
                                        <label for="code" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Materi</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="credit" class="form-label">Bobot</label>
                                    <input type="number" name="credit" id="credit" class="form-control"
                                        placeholder="Credit" value="{{ old('credit') }}">
                                    <label for="credit" class="form-label">*untuk non Perguruan Tinggi, isi dengan
                                        0</label>
                                    @error('credit')
                                        <label for="credit" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('materi.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
