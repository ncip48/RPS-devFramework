@extends('layouts.app')

@section('title', 'Edit Institusi')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Edit Produk</h4>
                        </div>
                        <div class="QA_table ">
                            <form action="{{ route('institusi.update', $institute) }}" method="POST"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="TK" {{ $institute->type == 'TK' ? 'selected' : '' }}>TK</option>
                                        <option value="SD" {{ $institute->type == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ $institute->type == 'SMP' ? 'selected' : '' }}>SMP
                                        </option>
                                        <option value="SMA" {{ $institute->type == 'SMA' ? 'selected' : '' }}>SMA
                                        </option>
                                        <option value="SMK" {{ $institute->type == 'SMK' ? 'selected' : '' }}>SMK
                                        </option>
                                        <option value="PT" {{ $institute->type == 'PT' ? 'selected' : '' }}>Perguruan
                                            Tinggi</option>
                                    </select>
                                    @error('type')
                                        <label for="type" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $institute->name }}">
                                    @error('name')
                                        <label for="name" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $institute->email }}">
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
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ $institute->address }}">
                                    @error('address')
                                        <label for="address" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ $institute->phone }}">
                                    @error('phone')
                                        <label for="phone" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" name="province" id="province" class="form-control"
                                        value="{{ $institute->province }}">
                                    @error('province')
                                        <label for="province" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        value="{{ $institute->city }}">
                                    @error('city')
                                        <label for="city" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" name="district" id="district" class="form-control"
                                        value="{{ $institute->district }}">
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
                                    <label for="id_product" class="form-label">Product</label>
                                    <select name="id_product" id="id_product" class="form-control">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id === $institute->id_product ? 'selected' : '' }}>
                                                {{ $product->name }}</option>
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
