@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Tambah Produk</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('produk.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        placeholder="Description">
                                    @error('description')
                                        <label for="description" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" name="price" id="price" class="form-control"
                                        placeholder="Price">
                                    @error('price')
                                        <label for="price" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
