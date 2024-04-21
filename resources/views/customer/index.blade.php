@extends('layout')

@section('title', 'WhizCycle')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Beranda</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <div class="row row-cos-1">
                           <div class="col-md-6">
                                <h1>Jadwalkan Pengambilan Sampah Anda Sekarang! Dengan Mudah dan Efisien!</h1>
                                <p>Aplikasi WhizCycle adalah solusi untuk menyelesaikan masalah sosial tentang kebersihan lingkungan.</p>
                                <p>Mulai sekarang, atur jadwal pengambilan sampah Anda dengan mudah! Pilih tanggal dan tentukan waktu  pengumpulan sampah Anda. Kami siap membantu Anda menjaga lingkungan bersih dan memberikan layanan yang praktis dan efisien. Ayo beraksi sekarang!</p>
                                <div class="text-start">
                                    <a href ="order" name="order" class="btn btn-success btn-lg">Pesan Ojol</a>
                                </div>
                           </div>
                            <div class="col-md-6">
                                <img src="images/Driver.png" alt="image" width="300" height="200">
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        </div>
    </div>

@endsection