@extends('layout')

@section('title', 'WhizCycle | Pesanan')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Order</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Biodata</h5>
                    <hr>

                        <!-- Biodata Form Elements -->
                        <form action="order" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input id="inputName" class="form-control" style="background-color: #F3F2F2;" type="text" name="name" value="<?php echo Auth::user()->name; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">No.Hp</label>
                                <div class="col-sm-10">
                                    <input id="inputNumber" class="form-control" style="background-color: #F3F2F2;" type="number" name="phoneNo" value="<?php echo Auth::user()->phoneNo; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input id="inputAddress" class="form-control" style="background-color: #F3F2F2;" type="text" name="address" value="<?php echo Auth::user()->address; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Penjemputan</label>
                                <div class="col-sm-10">
                                    <input id="inputDate" class="form-control" type="date" name="pickup_date" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Jam Penjemputan</label>
                                <div class="col-sm-10">
                                    <input id="inputTime" class="form-control" type="time" name="pickup_time" required>
                                </div>
                            </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori</h5>
                        <hr>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Organik / Anorganik</label>
                                <div class="col-sm-10">
                                    <select name="category_trash" class="form-select" aria-label="Default select example" required>
                                        <option selected>Organik</option>
                                        <option value="anorganik">Anorganik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAmount" class="col-sm-2 col-form-label">Berat (kg)</label>
                                <div class="col-sm-10">
                                    <input id="inputAmount" class="form-control" type="number" name="amount" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNotes" class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input id="inputNotes" class="form-control" type="textarea" name="notes" required>
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pembayaran</h5>
                        <hr>
                            
                            <div class="row mb-3">
                                <label for="inputFilePayment" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                                <div class="col-sm-10">
                                    <input id="inputFilePayment" class="form-control" type="file" name="file_payment" require>
                                </div>
                            </div>

                            <div class="card-description">
                                <p>Keterangan Pembayaran : </p>
                                <ul>
                                    <li class="list-group-item">1. Berat 0 - 5 Kg = Rp 25.000,-</li>
                                    <li class="list-group-item">2. Berat 6 - 10 Kg = Rp 40.000,-</li>
                                    <li class="list-group-item">3. Berat > 10 Kg = Rp 50.000,-</li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-custom btn-lg px-5"> SUBMIT </button>
                            </div>
                            
                        </form><!-- End General Form Elements -->


                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

@endsection
