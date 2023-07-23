@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'List Pengajar')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List Pengajar</h4>
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
                                    <a href="{{ route('pengajar.create') }}" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        @if ($helpers->isAdminGuard())
                                            <th>Institusi</th>
                                        @endif
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($teachers as $teacher)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->nip }}</td>
                                            <td>{{ $teacher->nik }}</td>
                                            <td>{{ $teacher->gender }}</td>
                                            <td>{{ $teacher->phone }}</td>
                                            @if ($helpers->isAdminGuard())
                                                <td>{{ $teacher->institute_name }}</td>
                                            @endif
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('pengajar.edit', $teacher) }}"
                                                        class="status_btn">Edit</a>
                                                    <form action="{{ route('pengajar.destroy', $teacher) }}" method="POST"
                                                        class="d-inline" id="delete-form-{{ $teacher->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="status_btn red_btn cursor-pointer"
                                                            onclick="document.getElementById('delete-form-{{ $teacher->id }}').submit()">Delete</a>
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
