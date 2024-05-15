@extends('admin-layout')

@section('title', 'User Management')

@section('content')

<style>
    .main {
        padding: 20px;
        background-color: #f4f7fa;
    }

    .pagetitle h1 {
        color: #333;
        font-size: 24px;
    }

    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-bar input[type="text"], .search-bar select {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary, .btn-sort {
        background-color: #0d6efd;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
        cursor: pointer; /* Make headers clickable */
    }

    .table th {
        background-color: #f8f9fa;
        color: #212529;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-edit, .btn-delete {
        padding: 5px 10px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #0d6efd;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #0d6efd;
        text-decoration: none;
        padding: 8px 12px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Management</h1>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search" aria-label="Search">
        <button type="button" class="btn btn-primary">Add user +</button>
    </div>

    <div class="user-list">
        <table id="user-table" class="table">
            <thead>
                <tr>
                    <th onclick="sortTable('name')">Name</th>
                    <th onclick="sortTable('role')">Role</th>
                    <th onclick="sortTable('create_date')">Create Date</th>
                    <th onclick="sortTable('point')">Point</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td style="@if ($user->role_id == 2) background-color: lightgreen; @endif">
                        @if ($user->role_id == 1)
                            User
                        @elseif ($user->role_id == 2)
                            Admin
                        @else
                            {{ $user->role }}
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                    <td>{{ $user->total_points }}</td>
                    <td>
                        <a href="{{ route('admin.edit', ['user' => $user->user_id]) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                        <button class="btn btn-delete">Delete <i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                @endforeach
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


<script>
    function sortTable(columnName) {
    console.log("Sorting table by column:", columnName);
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("user-table");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = getValue(rows[i], columnName);
            y = getValue(rows[i + 1], columnName);
            if (x && y) {
                if (x > y) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function getValue(row, columnName) {
    var index;
    switch (columnName) {
        case 'name':
            index = 0; // Index of the "Name" column
            break;
        case 'role':
            index = 1; // Index of the "Role" column
            break;
        case 'create_date':
            index = 2; // Index of the "Create Date" column
            break;
        case 'point':
            index = 3; // Index of the "Point" column
            break;
        default:
            return null;
    }
    return row.getElementsByTagName("td")[index].innerText.toLowerCase();
}
</script>
@endsection
