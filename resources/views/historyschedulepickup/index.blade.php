@extends('layout')

@section('content')
<section id="list">
  <div class="container">
    <h1>WhizCycle</h1>
    @if (count($data_order) > 0)

    <div class="table-responsive">
      <table class="table-striped table">
        <thead>
          <tr>
            <th>ID User</th>
            <th>Kategori Sampah</th>
            <th>Tanggal Pemesanan</th>
            <th>Waktu Pemesanan</th>
            <th>Jenis</th>
            <th>Berat</th>
            <th>Catatan</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($data_order as $order)
          
          <tr>
            <td>{{ $order->schedule_id }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->pickup_date }}</td>
            <td>{{ $order->pickup_time }}</td>
            <td>{{ $order->category_trash }}</td>
            <td>{{ $order->amount }}</td>
            <td>{{ $order->notes }}</td>
            <td>{{ $order->file_payment }}</td>
            <td>Pending</td>  
            <td>
            <form action="{{ route('history', $order->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Hapus</button>
</form>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
    @else
        <p>Tidak ada order di sini.</p>
    @endif
  </div>
</section>
@endsection
