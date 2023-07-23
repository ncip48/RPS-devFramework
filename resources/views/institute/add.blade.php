@extends('layouts.app')

@section('title', 'Tambah Institusi')

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
                            <form action="{{ route('institusi.store') }}" method="POST" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="TK">TK</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="PT">Perguruan Tinggi</option>
                                    </select>
                                    @error('type')
                                        <label for="type" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Institusi</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    @error('email')
                                        <label for="email" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                        <label for="password" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                    @error('address')
                                        <label for="address" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">No Telp</label>
                                    <input type="text" name="phone" id="phone" class="form-control">
                                    @error('phone')
                                        <label for="phone" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="province" class="form-label">Provinsi</label>
                                    <input type="text" name="province" id="province" class="form-control">
                                    @error('province')
                                        <label for="province" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">Kab/Kota</label>
                                    <input type="text" name="city" id="city" class="form-control">
                                    @error('city')
                                        <label for="city" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="district" class="form-label">Kecamatan</label>
                                    <input type="text" name="district" id="district" class="form-control">
                                    @error('district')
                                        <label for="district" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                    @error('logo')
                                        <label for="logo" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_product" class="form-label">Package</label>
                                    <select name="id_product" id="id_product" class="form-control">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_product')
                                        <label for="id_product" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                                <a href="{{ route('institusi.index') }}" class="btn btn-secondary mb-4">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
