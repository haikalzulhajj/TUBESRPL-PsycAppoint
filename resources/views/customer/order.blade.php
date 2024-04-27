@extends('layout')

@section('title', 'WhizCycle | Pesanan')

@section('content')

    <div id="setoran-sampah" class="bg-light">

            <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="images/logo.png" alt="logo">
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="home">
                        <img src="icons/home-icon.png" alt="logo">
                        <span>Home</span>    
                    </a>
                </li>
                <li>
                    <a href="pesan">
                        <img src="icons/setoran-icon.png" alt="logo">
                        <span>Setoran Sampah</span>
                    </a>
                </li>
                <li>
                    <a href="history">
                        <img src="icons/history-icon.png" alt="logo">
                        <span>History</span>
                    </a>
                </li>
                <li>
                    <a href="redeemspoints">
                        <img src="icons/points-icon.png" alt="logo">
                        <span>Redeems Points</span>
                    </a>
                </li>
                <li>
                    <a href="edukasi">
                        <img src="icons/edukasi-icon.png" alt="logo">
                        <span>Edukasi Lingkungan</span>
                    </a>
                </li>
                <li>
                    <a href="customerservice">
                        <img src="icons/cs-icon.png" alt="logo">
                        <span>Customer Service</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div id="content" class="p-5">
            <div class="bg-white p-4 rounded-3 shadow">
                <h5>Biodata</h5>
                <hr>
                <form action="order" method="post">
                    @csrf
                    <div class="row row-cols-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="my-input">Name</label>
                                <input id="my-input" class="form-control" style="background-color: #e0e0e0;" type="text" name="name" value="<?php echo Auth::user()->name; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="my-input">No. HP</label>
                                <input id="my-input" class="form-control" style="background-color: #e0e0e0;" type="number" name="phoneNo" value="<?php echo Auth::user()->phoneNo; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="my-input">Alamat</label>
                                <input id="my-input" class="form-control" style="background-color: #e0e0e0;" type="text" name="address" value="<?php echo Auth::user()->address; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="my-input">Tanggal Penjemputan</label>
                                <input id="my-input" class="form-control" type="date" name="pickup_date">
                            </div>
                            <div class="form-group">
                                <label for="my-input">Jam Penjemputan</label>
                                <input id="my-input" class="form-control" type="time" name="pickup_time">
                            </div>
                        </div>
                    </div>

                    <h5>Kategori Sampah</h5>
                    <hr>
                        <div class="form-group">
                            <label for="my-input">organik / anorganik</label>
                            <select name="category_trash" class="form-control" >
                                <option>Organik</option>
                                <option>Anorganik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Berat (kg)</label>
                            <input id="my-input" class="form-control" type="number" name="amount">
                        </div>
                        <div class="form-group">
                            <label for="my-input">Catatan</label>
                            <input id="my-input" class="form-control" type="text" name="notes">
                        </div>
                        <div class="form-group">
                            <label for="my-input">Pembayaran</label>
                            <input id="my-input" class="form-control" type="file" name="file_payment">
                        </div>

                        <div class="text-start">
                            <button type="submit" class="btn btn-success px-5"> SUBMIT </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
