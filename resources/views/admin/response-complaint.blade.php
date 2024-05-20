@extends('admin-layout')

@section('title', 'WhizCycle | Pesanan')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Customer Service</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Response Complaint</h5>
                        <hr>

                        @if(Session::has('status'))
                            <div class="alert alert-success"> {{ Session::get('status') }}</div>
                        @endif

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Nama User</th>
                                    <th>Subjek</th>
                                    <th>Deskripsi</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaintdata as $data)                            
                                    <tr>
                                        <td scope="row">{{ $data -> complaint_id }}</td>
                                        <td scope="row">{{ $data -> user -> name}}</td>
                                        <td scope="row">{{ $data -> subjek }}</td>
                                        <td scope="row">{{ $data -> description }}</td>
                                        <td scope="row" >{{ $data -> updated_at }}</td>
                                        <td scope="row" class="d-flex align-items-center ustify-content-center">
                                            @if ($data->status == 'To Do')
                                                <p class="fw-bolder text-todo m-0">To Do</p> 
                                            @elseif ($data->status == 'inprogress')
                                                <p class="fw-bolder text-inprogress m-0">In Progress</p>
                                            @else
                                                <p class="fw-bolder text-closed m-0">Closed</p>
                                            @endif
                                            <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots m-3"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Ubah Status</h6>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#">To Do</a></li>
                                                    <li><a class="dropdown-item" href="#">In Progress</a></li>
                                                    <li><a class="dropdown-item" href="#">Closed</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div>
                                                <i class="bi bi-whatsapp icon-background"></i>
                                                <i class="bi bi-envelope-open icon-background"></i>
                                            </div>
                                        </td>
                                    </tr>
                           
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
