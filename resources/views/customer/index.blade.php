@extends('layout')

@section('title', 'Setara.id')

@section('content')

<main id="main" class="main">
    <!-- Page Content  -->
    <div class="pagetitle">
        <h1 style="color: #6F2C80;">Homepage</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Butuh Teman Cerita? Yuk, Buat Janji di PsycAppoint! 🌼</h1>
                        <p class="card-content">Punya masalah soal cinta, keluarga, kerjaan, atau hal pribadi? Di PsycAppoint, kamu bisa bikin janji bersama konselor, terapis, atau psikolog dengan mudah.
                            <span>
                            Curhatin apa aja yang bikin kamu kepikiran dan dapatkan saran serta dukungan yang kamu butuhin. Yuk, bareng-bareng kita prioritaskan dan menjaga kesehatan mental kita.
                        </p>

                        <div class="text-start">
                            <a href="order" name="order" class="btn-custom btn-sm" style="background-color: purple;">Make an Appointment Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-img-container">
                    <img src="images/Sharing.jpg" alt="image" class="card-img">
                </div>
                <div class="card card-img-container">
                    <img src="images/Sharing.jpg" alt="image" class="card-img">
                </div>
                <div class="card card-img-container">
                    <img src="images/Sharing.jpg" alt="image" class="card-img">
                </div>
                
            </div>
        </div>
    </section>

</main>

@endsection
