@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'Tambah Template')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah Template</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('template-rps.store') }}" method="POST" autocomplete="off">
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
                                    <label for="id_course" class="form-label">Materi</label>
                                    <select name="id_course" id="id_course" class="form-control">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }} -
                                                {{ $course->teacher_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_course')
                                        <label for="id_course" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-end mb-3">
                                    <div>
                                        <label for="id_teacher" class="form-label">Pengajar</label>
                                        <input type="hidden" name="teacher" id="teacher">
                                        <div id="result-pengajar">

                                        </div>
                                        <select name="id_teacher" id="id_teacher" class="form-control">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }} -
                                                    {{ $teacher->nip }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="ms-3 btn btn-primary mt-2" id="btn-tambah-pengajar">Tambah
                                        Pengajar</button>
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('template-rps.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#btn-tambah-pengajar").click(function() {
                let id_teacher = $("#id_teacher").val();
                let teacher_name = $("#id_teacher option:selected").text();
                //remove space too big
                //if teacher already exist dont append
                if ($("#teacher").val().includes(id_teacher))
                    return;

                teacher_name = teacher_name.replace(/\s\s+/g, ' ');
                let html = `
                    <div class="d-flex align-items-center mb-2 justify-content-between">
                        <span class="text-success">${teacher_name}</span>
                        <button type="button" class="btn ms-3 btn-hapus-pengajar"><i class="bi bi-trash text-danger"></i></button>
                    </div>
                `;
                $("#result-pengajar").append(html);
                //append id_teahcer input with comma and loop every click if one or last element is remove comma
                $("#teacher").val(function(i, val) {
                    if (val == "")
                        return id_teacher;
                    else if (val[val.length - 1] == ",")
                        return val + id_teacher;
                    else if (val[val.length - 1] != "," &&
                        val[val.length - 1] != " ")
                        return val + "," + id_teacher;
                    else
                        return val + id_teacher;
                });
            });

            $(document).on("click", ".btn-hapus-pengajar", function() {
                $(this).parent().remove();
            });
        });
    </script>
@endpush
