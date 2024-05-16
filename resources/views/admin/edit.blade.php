<!-- resources/views/admin/edit.blade.php -->

@extends('admin.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('user.update', $user->user_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role_id" value="{{ $user->role_id }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
            </div>
            <div class="mb-3">
                <label for="phoneNo" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNo" name="phoneNo" value="{{ $user->phoneNo }}">
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Created Date</label>
                <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $user->created_at }}">
            </div>
            <div class="mb-3">
                <label for="total_points" class="form-label">Total Points</label>
                <input type="text" class="form-control" id="total_points" name="total_points" value="{{ $user->total_points }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
