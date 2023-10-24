@extends('layouts.master-mini')
@section('content')

    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
         style="
         background-color: #f1f1f1;
         {{--background-image: url({{ url('assets/images/auth/login_1.jpg') }}); --}}
         background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <h2 class="text-center mb-4">Đăng nhập</h2>
                <div class="auto-form-wrapper">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="label">Email</label>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="Vui lòng nhập email">

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
                            <label for="password" class="label">Mật khẩu</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control
                                @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password"
                                        placeholder="Vui lòng nhập mật khẩu">

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
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>

                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check form-check-flat mt-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-small forgot-password text-black" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block g-login">
                                <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
                        </div>
                        <div class="text-block text-center my-3">
                            <span class="text-small font-weight-semibold">Not a member ?</span>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-black text-small">Create new account</a>
                            @endif
                        </div>
                    </form>
                </div>
                <ul class="auth-footer">
                    <li>
                        <a href="#">Conditions</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                    <li>
                        <a href="#">Terms</a>
                    </li>
                </ul>
                <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
            </div>
        </div>
    </div>

@endsection
