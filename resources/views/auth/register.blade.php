@extends('layouts.master-mini')

@section('content')
    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/register.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <h2 class="text-center mb-4">Đăng ký</h2>
                <div class="auto-form-wrapper">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                                <input id="name" type="text" placeholder="Vui lòng nhập tên của bạn" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                      <i class="mdi mdi-check-circle-outline"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div  class="input-group">
                                <input id="email" type="email" placeholder="Vui lòng nhập email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                      <i class="mdi mdi-check-circle-outline"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input id="password" type="password" placeholder="Vui lòng nhập mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                      <i class="mdi mdi-check-circle-outline"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input id="password-confirm" type="password" placeholder="Vui lòng nhập lại mật khẩu" class="form-control" name="password_confirmation" required autocomplete="new-password">
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                      <i class="mdi mdi-check-circle-outline"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                        </div>
{{--                        <div class="form-group d-flex justify-content-center">--}}
{{--                            <div class="form-check form-check-flat mt-0">--}}
{{--                                <label class="form-check-label">--}}
{{--                                    <input type="checkbox" class="form-check-input" checked> I agree to the terms </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Đăng ký</button>
                        </div>
                        <div class="text-block text-center my-3">
                            <span class="text-small font-weight-semibold">Bạn đã có tài khoản ?</span>
                            <a href="{{ route('login') }}" class="text-black text-small">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
