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
                            <div class="row">
                                <div class="col-md-9">
                                    <h1 class="card-title">Jadwalkan Pengambilan Sampah Anda Sekarang! Dengan Mudah dan Efisien!</h1>
                                    <p class="card-content">Aplikasi WhizCycle adalah solusi untuk menyelesaikan masalah sosial tentang kebersihan lingkungan. 
                                        <span>
                                            Mulai sekarang, atur jadwal pengambilan sampah Anda dengan mudah! Pilih tanggal dan tentukan waktu pengumpulan sampah Anda. Kami siap membantu Anda menjaga lingkungan bersih dan memberikan layanan yang praktis dan efisien. Ayo beraksi sekarang!
                                        </span>
                                    </p>

                                    <div class="text-start">
                                        <a href ="order" name="order" class="btn-custom btn-lg">Pesan Ojol</a>
                                    </div>
                            </div>
                            <div class="col-md-3 card-img-container">
                                <img src="images/Driver.png" alt="image" class="card-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection