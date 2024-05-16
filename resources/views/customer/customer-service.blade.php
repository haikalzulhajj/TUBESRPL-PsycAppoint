@extends('layout')

@section('title', 'WhizCycle | Customer Service')

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
                    <h5 class="card-title">Submit A Ticket</h5>
                    <hr>

                @if(Session::has('status'))
                    <div class="alert alert-success"> {{ Session::get('status') }}</div>
                @endif

                        <!-- Biodata Form Elements -->
                        <form method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Name <span style="color: red;">*</label>
                                <div class="col-sm-10">
                                    <input id="inputName" class="form-control" style="background-color: #F3F2F2;" type="text" name="name" value="<?php echo Auth::user()->name; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">No.Hp <span style="color: red;">*</label>
                                <div class="col-sm-10">
                                    <input id="inputNumber" class="form-control" style="background-color: #F3F2F2;" type="number" name="phoneNo" value="<?php echo Auth::user()->phoneNo; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email <span style="color: red;">*</label>
                                <div class="col-sm-10">
                                    <input id="inputEmail" class="form-control" type="email" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputSubjek" class="col-sm-2 col-form-label">Subjek <span style="color: red;">*</label>
                                <div class="col-sm-10">
                                    <input id="inputSubjek" class="form-control" type="text" name="subjek" required>
                                </div>
                            </div>                       
                            <div class="row mb-3">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Description <span style="color: red;">*</label>
                                <div class="col-sm-10">
                                    <textarea id="inputDescription" class="form-control" name="description" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-custom px-5"> SUBMIT </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
