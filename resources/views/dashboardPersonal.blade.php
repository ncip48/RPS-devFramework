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
                                            <h4>Jumlah Materi</h4>
                                            <h3>
                                                <span>{{ $courses }}</span>
                                            </h3>
                                            <p>Jumlah materi yang dimiliki</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Jumlah RPS</h4>
                                            <h3>
                                                <span>{{ $rpses }}</span>
                                            </h3>
                                            <p>Jumlah RPS yang digenerate</p>
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
