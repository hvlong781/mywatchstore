@extends('layouts.master-mini')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    @include('admin.alert')

                    <div class="brand-logo">
                        <img src="/template/admin/images/logo.svg" alt="logo">
                    </div>
                    <h4>Hello! let's get started</h4>
                    <h6 class="font-weight-light">Sign in to continue.</h6>
                    <form class="pt-3" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    autofocus placeholder="Email"
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   required autocomplete="current-password"
                                   placeholder="Mật khẩu">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mt-3 form-group">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Đăng Nhập</button>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Nhớ mật khẩu
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-small auth-link forgot-password text-black" href="{{ route('password.request') }}">
                                    {{ __('Quên mật khẩu?') }}
                                </a>
                            @endif
                        </div>

                        {{-- <div class="form-group mb-2">
                            <button type="button" class="btn btn-block btn-google auth-form-btn g-login">
                                <i class="ti-google mr-2"></i>Google
                            </button>
                        </div> --}}

                        {{-- <div class="mb-2">
                            <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                <i class="ti-facebook mr-2"></i>Facebook
                            </button>
                        </div> --}}

                        <div class="text-center mt-4 font-weight-light">
                            Bạn chưa có tài khoản?
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-primary">Đăng ký tài khoản</a>
                            @endif
                        </div>

                        <div class="text-center mt-1 font-weight-light">
                            Hoặc
                        </div>

                        <div class="mb-2 mt-3">
                            <a href="{{ url('/login/google') }}" class="btn btn-block btn-google auth-form-btn g-login">
                                <i class="ti-google mr-2"></i>Google
                            </a>
                        </div>

                        <div class="mb-2">
                            <a href="#" class="btn btn-block btn-facebook auth-form-btn">
                                <i class="ti-facebook mr-2"></i>Facebook
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
