@extends('layouts/private')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
                </div>
                <div class="card-body">
                    <p>Halo {{ auth()->user()->name }}, Selamat Datang di Aplikasi Sistem Web untuk Pengamanan Data Laporan
                        Bill of Lading PT Buana Express dengan Penerapan Enkripsi AES-256.</p>
                </div>
            </div>
            <div class="card shadow mb-4">
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
                                Jakarta. Sejak berdiri pada tahun [tahun berdiri], kami telah berkomitmen untuk menyediakan
                                layanan
                                pengiriman yang cepat, aman, dan terpercaya kepada pelanggan kami di seluruh Indonesia.</p>
                        </div>
                    </div>

                    <p>Dengan didukung oleh teknologi terkini dan jaringan distribusi yang luas, PT Buana Express menawarkan
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
            </div>
        </div>
    </div>
@endsection
