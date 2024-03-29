<style>
    .nav-profile .nav-link::after {
        content: none; /* This will remove the caret */
    }
</style>
<header>
    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="/">Trang Chủ</a>
                        </li>

                        <li>
                            <a href="/products">Sản phẩm</a>
                        </li>



                        <li>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Danh Mục
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {!! $menusHtml !!}
                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="/orders">Đơn hàng</a>
                        </li>

                        <li>
                            <a href="/news">Tin tức</a>
                        </li>

                        <li>
                            <a href="/contacts">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>


                    @if (Route::has('login'))
                        <div class="nav-item nav-profile dropdown">
                            @auth
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                    @php
                                        $user = auth()->user();
                                        $avatarPath = $user ? $user->avatar : null;
                                    @endphp

                                    <img src="{{ $avatarPath ? asset($avatarPath) : asset('storage/avatar.jpg') }}"
                                        style="width: 40px; height: 40px; border-radius: 100%"
                                        alt="profile"/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="/profile">
                                        <i class="ti-settings text-primary"></i>
                                        Trang Cá Nhân
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="ti-power-off text-primary"></i>
                                        {{ __('Đăng Xuất') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @else
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                        <img src="storage/avatar.jpg"
                                             style="width: 40px; height: 40px; border-radius: 100%"
                                             alt="profile"/>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                        <a class="dropdown-item" href="/">
                                            <i class="ti-settings text-primary"></i>
                                            Trang Chủ
                                        </a>

                                        <a class="dropdown-item" href="/products">
                                            <i class="ti-settings text-primary"></i>
                                            Sản Phẩm
                                        </a>

                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            <i class="ti-power-off text-primary"></i>
                                            {{ __('Đăng Nhập') }}
                                        </a>
                                    </div>
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="/"><img src="/template/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="{{ count(\Session::get('carts') ?? []) }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu">
                <a href="/">Trang Chủ</a>
            </li>
            {!! $menusHtml !!}

            <li>
                <a href="/orders">Đơn hàng</a>
            </li>

            <li>
                <a href="/news">Tin tức</a>
            </li>

            <li>
                <a href="contact.html">Liên hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
