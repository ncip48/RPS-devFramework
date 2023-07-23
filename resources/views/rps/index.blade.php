@inject('helpers', 'App\Http\Controllers\Controller')

@extends('layouts.app')

@section('title', 'List RPS')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List RPS</h4>
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
                                    <a href="{{ route('rps.create') }}" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Materi</th>
                                        <th>Semester</th>
                                        <th>Periode</th>
                                        <th>Pengajar</th>
                                        <th>Pembuat</th>
                                        @if ($helpers->isAdminGuard())
                                            <th>Institusi</th>
                                        @endif
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($learning_plans as $learning_plan)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $learning_plan->course_name }}</td>
                                            <td>{{ $learning_plan->semester }}</td>
                                            <td>{{ $learning_plan->periode }}</td>
                                            <td>
                                                @foreach ($learning_plan->teachers as $teacher)
                                                    <p>{{ $loop->iteration }}. {{ $teacher }}</p>
                                                @endforeach
                                            </td>
                                            {{-- <td>{{ $learning_plan->phone }}</td> --}}
                                            @if ($helpers->isAdminGuard())
                                                <td>{{ $learning_plan->institute_name }}</td>
                                            @endif
                                            <td>{{ $learning_plan->creator_name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('rps.print', $learning_plan) }}"
                                                        class="status_btn btn-primary">Print</a>
                                                    <a href="{{ route('rps.show', $learning_plan) }}"
                                                        class="status_btn">Lihat</a>
                                                    <form action="{{ route('rps.destroy', $learning_plan) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $learning_plan->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="status_btn red_btn cursor-pointer"
                                                            onclick="document.getElementById('delete-form-{{ $learning_plan->id }}').submit()">Delete</a>
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
