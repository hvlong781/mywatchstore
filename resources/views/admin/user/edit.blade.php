@extends('admin.master')

@section('content')
    <div class="container">
        <form action="/admin/users/edit/{{ $user->id }}" method="POST">
            @csrf

            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <div class="form-group">
                <label for="active">Trạng thái kích hoạt:</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="active" id="active1" value="1" @if($user->active == 1) checked @endif>
                    <label class="custom-control-label" for="active1">
                        Active
                    </label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="active" id="active0" value="0" @if($user->active == 0) checked @endif>
                    <label class="custom-control-label" for="active0">
                        InActive
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
        </form>
    </div>
@endsection
