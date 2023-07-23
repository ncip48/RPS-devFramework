@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                        <div class="single_quick_activity">
                                            <h4>Jumlah Pengajar</h4>
                                            <h3>
                                                <span>{{ $teachers }}</span>
                                            </h3>
                                            <p>Jumlah pengajar yang terdaftar</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Jumlah Jurusan</h4>
                                            <h3>
                                                <span>{{ $departments }}</span>
                                            </h3>
                                            <p>Jumlah jurusan yang ditambahkan</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Jumlah RPS</h4>
                                            <h3>
                                                <span>{{ $rpses }}</span>
                                            </h3>
                                            <p>Jumlah RPS yang ditambahkan</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Tagihan</h4>
                                            <h3>
                                                Rp.
                                                <span>{{ $invoices }}</span>
                                            </h3>
                                            <p>Jumlah tagihan yang belum dibayar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
