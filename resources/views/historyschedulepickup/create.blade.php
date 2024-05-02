@extends('layout')

@section('content')
  <section id='form'>
    <div class="container">
      <h1 class="tambahh1">Setoran Sampah</h1>
      <p class="tambahp">Isi Biodata</p>
      <form action="{{ route('schedulepickup.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nama">Nama</label>
        <input id="nama" name="nama" type="text" required placeholder="Masukkan Nama">
        <label for="no_hp">No. HP</label>
        <input id="no_hp" name="no_hp" type="text" required placeholder="Masukkan No. HP">
        <label for="alamat">Alamat</label>
        <input id="alamat" name="alamat" type="text" required placeholder="Masukkan Alamat">
        <label for="tanggal_penjemputan">Tanggal Penjemputan</label>
        <input id="tanggal_penjemputan" name="tanggal_penjemputan" type="date" required>
        <label for="jam_penjemputan">Jam Penjemputan</label>
        <input id="jam_penjemputan" name="jam_penjemputan" type="time" required>
        <label for="kategori_sampah">Kategori Sampah</label>
        <input id="kategori_sampah" name="kategori_sampah" type="text" required placeholder="Masukkan Kategori Sampah">
        <label for="berat">Berat Sampah (kg)</label>
        <input id="berat" name="berat" type="number" step="0.01" required placeholder="Masukkan Berat Sampah">
        <label for="pembayaran">Pembayaran</label>
        <input id="pembayaran" name="pembayaran" type="text" required placeholder="Masukkan Metode Pembayaran">
        <label for="driver_id">ID Driver</label>
        <input id="driver_id" name="driver_id" type="text" required placeholder="Masukkan ID Driver">
        <label for="status">Status</label>
        <input id="status" name="status" type="text" required placeholder="Masukkan Status">
        <button class="btn btn-primary" type="submit" style="margin-top: 40px;">Selesai</button>
      </form>
    </div>
  </section>
@endsection
