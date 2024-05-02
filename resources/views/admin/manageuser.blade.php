@extends('layout')

@section('title', 'User Management')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Manage</h1>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search" aria-label="Search">
        <button type="button" class="btn btn-primary">Add user +</button>
    </div>

    <div class="user-list">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Create Date</th>
                    <th>Point</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Row -->
                <tr>
                    <td>David Wagner</td>
                    <td>david.wagner@example.com</td>
                    <td>Admin</td>
                    <td>24 Oct, 2015</td>
                    <td>200</td>
                    <td>
                        <button class="btn btn-success">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <!-- More rows can be dynamically generated here -->
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>

</main>

@endsection