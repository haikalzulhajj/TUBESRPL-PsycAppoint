@extends('admin-layout')

@section('title', 'WhizCycle')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Redeem Point</h1>
        </div>

        <section class="section" id="main-reedem">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Voucher</th>
                                                <th>Point</th>
                                                <th>DateTime</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no =1; ?>
                                            @foreach($history as $v)
                                            <tr>
                                                <td>{{ $no }}<?php $no++ ?></td>
                                                <td>{{ $v->name }}</td>
                                                <td>{{ $v->voucher }}</td>
                                                <td>-{{ $v->point }}</td>
                                                <td>{{ $v->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>


@endsection
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

</script>
@endsection