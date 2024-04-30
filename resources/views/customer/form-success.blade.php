@extends('layout')

@section('title', 'WhizCycle | Pembayaran Berhasil')

@section('content')

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                    <div class="text-center">
                        <img src="images/success-payment.png" alt="image" class="success-img">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <i class="bi bi-check-circle-fill icon-custom" style="font-size: 48px;"></i>
                            <p class="fw-bold fs-4 m-0">Pembayaran Anda Berhasil</p>
                        </div>

                        <a href="home" class="btn-custom btn-lg mt-3">Kembali Ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

@endsection
