@extends('layouts.master-mini')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="/admin/images/logo.svg" alt="logo">
                    </div>
                    <h4>New here?</h4>
                    <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                    <form class="pt-3" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input type="text" id="name" placeholder="Username"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   id="email" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input id="password-confirm" type="password" placeholder="Vui lòng nhập lại mật khẩu"
                                       class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    I agree to all Terms & Conditions
                                </label>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary submit-btn btn-block btn-lg font-weight-medium auth-form-btn">Đăng ký</button>
                        </div>
                        <div class="text-block text-center my-3 mt-4 font-weight-light">
                            <span class="font-weight-semibold">Bạn đã có tài khoản ?</span>
                            <a href="{{ route('login') }}" class="text-primary">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
