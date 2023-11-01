@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Confirm Deletion</h1>
        <p>Are you sure you want to delete this user: {{ $user->name }}?</p>
        <form method="POST" action="/admin/users/destroy/{{ $user->id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
