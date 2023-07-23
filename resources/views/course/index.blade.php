@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'List Materi')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List Materi</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here..." id="search"
                                                autocomplete="false">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </div>
                                </div>
                                @if (!$helpers->isPersonalGuard())
                                    <div class="add_button ms-2">
                                        <a href="{{ route('materi.create') }}" class="btn_1">Add New</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if ($helpers->isAdminGuard())
                                            <th>Institusi</th>
                                        @endif
                                        <th>Jurusan</th>
                                        @if (!$helpers->isPersonalGuard())
                                            <th>Pengajar</th>
                                        @endif
                                        <th>Kode</th>
                                        <th>Nama Materi</th>
                                        <th>Bobot</th>
                                        @if (!$helpers->isPersonalGuard())
                                            <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $course)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            @if ($helpers->isAdminGuard())
                                                <td>{{ $course->institute_name }}</td>
                                            @endif
                                            <td>{{ $course->department_name }}</td>
                                            @if (!$helpers->isPersonalGuard())
                                                <td>{{ $course->teacher_name }}</td>
                                            @endif
                                            <td>{{ $course->code }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->credit == 0 ? '-' : $course->credit }}</td>
                                            @if (!$helpers->isPersonalGuard())
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('materi.edit', $course) }}"
                                                            class="status_btn">Edit</a>
                                                        <form action="{{ route('materi.destroy', $course) }}" method="POST"
                                                            class="d-inline" id="delete-form-{{ $course->id }}">
                                                            @csrf
                                                            @method('delete')
                                                            <a class="status_btn red_btn cursor-pointer"
                                                                onclick="document.getElementById('delete-form-{{ $course->id }}').submit()">Delete</a>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
