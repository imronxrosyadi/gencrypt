@extends('layouts/private')

@section('container')
    <div class="row justify-content-center">
        <!-- Encryption Card -->
        <div class="col-xl-5 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-auto py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Dokumen Terenkripsi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $encryptedData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-lock-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dokumen Diproses</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Enkripsi
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Dekripsi
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-5 col-md-6 mb-4">
            <div class="card border-right-success shadow h-auto py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dokumen Terdekripsi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $decryptedData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-unlock-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
                </div>
                <div class="card-body">
                    <p>Halo <b>{{ auth()->user()->name }}</b>, Selamat Datang di Aplikasi Sistem Web untuk Pengamanan Data
                        Laporan
                        Bill of Lading PT Buana Express dengan Penerapan Enkripsi AES-256.</p>
                    <p><b>Tujuan</b></p>
                    <p>
                        Proyek ini bertujuan untuk mengembangkan aplikasi yang dapat membantu PT. Buana Express dalam
                        melindungi dokumen Bill of Lading. Aplikasi ini dirancang untuk memudahkan proses enkripsi dan
                        dekripsi file, sekaligus menjaga integritas serta kerahasiaan dokumen tersebut. Dengan adanya sistem
                        ini, diharapkan PT. Buana Express dapat lebih efisien dalam menyimpan dan mengelola data, sekaligus
                        meningkatkan keamanan operasional perusahaan secara menyeluruh.</p>
                </div>
            </div>
            {{-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tentang Kami</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <img src="{{ asset('img/buana-xpress-logo.png') }}" alt="PT BUANA EXPRESS DASH" width="350px"
                                height="auto">
                        </div>
                        <div class="col-7">
                            <p><b>PT Buana Express</b> adalah perusahaan yang bergerak di bidang jasa pengiriman terkemuka
                                yang
                                berbasis di
                                Jakarta. Sejak berdiri Kami telah berkomitmen untuk menyediakan
                                layanan
                                pengiriman yang cepat, aman, dan terpercaya kepada pelanggan kami di seluruh Indonesia.</p>
                        </div>
                    </div>

                    <p class="mt-3">Dengan didukung oleh teknologi terkini dan jaringan distribusi yang luas, PT Buana
                        Express menawarkan
                        berbagai solusi logistik yang mencakup: </p>
                    <ul>
                        <li>Pengiriman dokumen dan paket.</li>
                        <li>Layanan ekspres untuk kebutuhan mendesak.</li>
                        <li>Pengiriman skala besar untuk kebutuhan bisnis.</li>
                    </ul>
                    <p>Kami memahami pentingnya kecepatan dan keakuratan dalam setiap pengiriman. Oleh karena itu, tim
                        profesional kami selalu berusaha memberikan pengalaman terbaik dengan memastikan setiap barang tiba
                        tepat waktu dan dalam kondisi sempurna.
                    </p>
                    <p>
                        <b>Visi Kami:</b>
                    </p>
                    <p>Menjadi mitra terpercaya dalam layanan pengiriman di Indonesia dengan terus berinovasi dan memberikan
                        solusi logistik yang efektif.
                    </p>
                    <p>
                        <b>Misi Kami:</b>
                    </p>
                    <p>
                        1. Memberikan layanan pengiriman yang cepat, aman, dan andal.
                    </p>
                    <p>
                        2. Mengutamakan kepuasan pelanggan melalui pelayanan yang profesional.
                    </p>
                    <p>
                        3. Membangun hubungan jangka panjang dengan pelanggan dan mitra bisnis
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

{{-- @section('javascript_content')
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Enkripsi", "Dekripsi"],
                datasets: [{
                    data: [{{ $encryptedData }}, {{ $decryptedData }}],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endsection --}}
