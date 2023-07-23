@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>List Produk</h4>
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
                                    <a href="{{ route('produk.create') }}" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>@formatRupiah($product->price)</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('produk.edit', $product) }}"
                                                        class="status_btn">Edit</a>
                                                    <form action="{{ route('produk.destroy', $product) }}" method="POST"
                                                        class="d-inline" id="delete-form-{{ $product->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="status_btn red_btn cursor-pointer"
                                                            onclick="document.getElementById('delete-form-{{ $product->id }}').submit()">Delete</a>
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
