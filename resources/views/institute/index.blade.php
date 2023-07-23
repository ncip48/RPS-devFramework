@extends('layouts.app')

@section('title', 'Institusi')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List Institusi</h4>
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
                                    <a href="{{ route('institusi.create') }}" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($institutes as $institute)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $institute->name }}</td>
                                            <td>{{ $institute->email }}</td>
                                            <td>{{ $institute->address }}</td>
                                            <td>{{ $institute->phone }}</td>
                                            <td>{{ $institute->product_name }}</td>
                                            <td>
                                                @if ($institute->status == 1)
                                                    <span class="text-success">Aktif</span>
                                                @else
                                                    <span class="text-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('institusi.edit', $institute->id) }}"
                                                        class="status_btn">Edit</a>
                                                    <form action="{{ route('institusi.destroy', $institute->id) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $institute->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="status_btn red_btn cursor-pointer"
                                                            onclick="document.getElementById('delete-form-{{ $institute->id }}').submit()">Delete</a>
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
