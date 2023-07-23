@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'Tambah RPS')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah RPS</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('rps.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_template" class="form-label">Template</label>
                                    <select name="id_template" id="id_template" class="form-control">
                                        @foreach ($templates as $template)
                                            <option value="{{ $template->id }}">{{ $template->course_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_template')
                                        <label for="id_template" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="semester" class="form-label">Semester</label>
                                    <input type="text" name="semester" id="semester" class="form-control"
                                        placeholder="Semester" value="{{ old('semester') }}">
                                    @error('semester')
                                        <label for="semester" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="periode" class="form-label">Tahun Ajaran</label>
                                    <input type="text" name="periode" id="periode" class="form-control"
                                        placeholder="Periode" value="{{ old('periode') }}">
                                    @error('periode')
                                        <label for="periode" class="text-danger">{{ $message }}</label>
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
                                <a href="{{ route('rps.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
