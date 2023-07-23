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
                                            <h4>Total Penjualan</h4>
                                            <h3>
                                                Rp.
                                                <span>{{ $sales }}</span>
                                            </h3>
                                            <p>Pendapatan keseluruhan dari penjualan</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Penjualan Harian</h4>
                                            <h3>
                                                Rp.
                                                <span>{{ $dailySales }}</span>
                                            </h3>
                                            <p>Pendapatan dari penjualan hari ini</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Penjualan Bulanan</h4>
                                            <h3>
                                                Rp.
                                                <span>{{ $monthlySales }}</span>
                                            </h3>
                                            <p>Pendapatan dari penjualan bulan ini</p>
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Total Institusi</h4>
                                            <h3>
                                                <span>{{ $institutes }}</span>
                                            </h3>
                                            <p>Jumlah sekolah yang bergabung</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6">
                    <div class="white_box min_400">
                        <div class="box_header box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">
                                    Penjualan Tahun {{ date('Y') }}
                                </h3>
                            </div>
                        </div>
                        <div id="area_active"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header">
                            <div class="main-title">
                                <h3 class="mb-0">
                                    Perguruan Tinggi vs Sekolah
                                </h3>
                            </div>
                        </div>
                        <canvas height="220px" id="doughutChart"></canvas>
                        <div class="legend_style mt_10px mt-4">
                            <li class="d-block">
                                <span style="background-color: #df67c1"></span>
                                Perguruan Tinggi
                            </li>
                            <li class="d-block">
                                <span style="background-color: #6ae0bd"></span>
                                Sekolah
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">
                                    Institusi Per Kategori
                                </h3>
                            </div>
                        </div>
                        <canvas height="220px" id="doughutChart2"></canvas>
                        <div class="legend_style legend_style_grid mt_10px mt-4">
                            <li class="d-block">
                                <span style="background-color: #3B76EF"></span>
                                TK
                            </li>
                            <li class="d-block">
                                <span style="background-color: #00B382"></span>
                                SD
                            </li>
                            <li class="d-block">
                                <span style="background-color: #79A9F7"></span>
                                SMP
                            </li>
                            <li class="d-block">
                                <span style="background-color: #FF7B36"></span>
                                SMA
                            </li>
                            <li class="d-block">
                                <span style="background-color: #E8205E"></span>
                                SMK
                            </li>
                            <li class="d-block">
                                <span style="background-color: #DF67C1"></span>
                                Perguruan Tinggi
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header">
                            <div class="main-title">
                                <h3 class="mb-0">Penjualan Kuartal per Produk</h3>
                            </div>
                        </div>
                        <div id="stackbar_active"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header box_header_block align-items-">
                            <div class="main-title">
                                <h3 class="mb-0">
                                    10 Pendaftar Terbaru
                                </h3>
                            </div>
                        </div>
                        <h2>asdasdas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById("doughutChart").getContext("2d");
        ctx.height = 220;
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Perguruan Tinggi", "Sekolah"],
                defaultFontFamily: "Poppins",
                datasets: [{
                    label: "My First dataset",
                    data: [{{ $PTVsOtherPT[0] }}, {{ $PTVsOtherPT[1] }}],
                    backgroundColor: [
                        "#df67c1",
                        "#6ae0bd",
                    ],
                    hoverBackgroundColor: [
                        "rgba(242, 23, 128, .5)",
                        "rgba(242, 23, 128, .4)",
                    ],
                    //data hover for doughnut
                }, ],
            },
            options: {
                responsive: true,
            },
        });

        const ctx2 = document.getElementById("doughutChart2").getContext("2d");
        ctx2.height = 220;
        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: ["TK", "SD", "SMP", "SMA", "SMK", "Perguruan Tinggi"],
                defaultFontFamily: "Poppins",
                datasets: [{
                    data: [
                        {{ $instituteByType['TK'] }},
                        {{ $instituteByType['SD'] }},
                        {{ $instituteByType['SMP'] }},
                        {{ $instituteByType['SMA'] }},
                        {{ $instituteByType['SMK'] }},
                        {{ $instituteByType['PT'] }},
                    ],
                    backgroundColor: [
                        "#3B76EF",
                        "#00B382",
                        "#79A9F7",
                        "#FF7B36",
                        "#E8205E",
                        '#DF67C1'
                    ],
                    hoverBackgroundColor: [
                        "#FF7B36",
                        "#FF7B36",
                        "#FF7B36",
                        "#FF7B36",
                        "#FF7B36",
                        "#FF7B36",
                    ],
                }, ],
            },
            options: {
                responsive: true
            },
        });

        var options = {
            series: [{
                name: "series1",
                data: [31, 40, 28, 51, 42, 109, 100, 22, 55, 12, 120, 20]
            }],
            chart: {
                height: 350,
                type: "area",
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            xaxis: {
                labels: {
                    show: true,
                    formatter: function(val) {
                        const months = [
                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ];
                        const index = months.indexOf(val);
                        // Return month name for alternate months
                        // return index % 2 === 0 ? val : months[index];
                        return months[val - 1];
                    }
                }
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                }
            },
        };
        var chart = new ApexCharts(document.querySelector("#area_active"), options);
        chart.render();
    </script>
@endpush
