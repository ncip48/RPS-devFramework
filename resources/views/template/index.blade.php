@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'List Template RPS')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List Template RPS</h4>
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
                                <div class="add_button ms-2">
                                    <a href="{{ route('template-rps.create') }}" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if ($helpers->isAdminGuard())
                                            <th>Institusi</th>
                                        @endif
                                        <th>Jurusan</th>
                                        <th>Materi</th>
                                        <th>Pengajar</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($templates as $template)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            @if ($helpers->isAdminGuard())
                                                <td>{{ $template->institute_name }}</td>
                                            @endif
                                            <td>{{ $template->department_name }}</td>
                                            <td>{{ $template->course_name }}</td>
                                            <td>
                                                @foreach ($template->teachers as $teacher)
                                                    <p>{{ $loop->iteration }}. {{ $teacher }}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('template-rps.show', $template) }}"
                                                        class="status_btn">Lihat</a>
                                                    {{-- <a href="{{ route('template-rps.edit', $template) }}"
                                                        class="status_btn">Edit</a> --}}
                                                    <form action="{{ route('template-rps.destroy', $template) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $template->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="status_btn red_btn cursor-pointer"
                                                            onclick="document.getElementById('delete-form-{{ $template->id }}').submit()">Delete</a>
                                                    </form>
                                                </div>
                                            </td>
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
