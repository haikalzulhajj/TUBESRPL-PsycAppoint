@extends('layout')

@section('content')
  <section id="list">
    <div class="container">
      <h1>WhizCycle</h1>
      
        <div class="table-responsive">
          <table class="table-striped table">
            <thead>
              <tr>
                <th>ID User</th>
                <th>Kategori Sampah</th>
                <th>Tanggal Pemesanan</th>
                <th>Waktu Pemesanan</th>
                <th>Berat</th>
                <th>Catatan</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_order as $history)
              <tr>
                  <td>{{ $history->user_id }}</td>
                  <td>{{ $history->category_trash }}</td>
                  <td>{{ $history->pickup_date }}</td>
                  <td>{{ $history->pickup_time }}</td>
                  <td>{{ $history->amount }}</td>
                  <td>{{ $history->notes }}</td>
                  <td>Pending</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </section>
@endsection
