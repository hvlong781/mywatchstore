@extends('main')

@section('content')
    <!-- Product -->
    <section class="bg0 p-t-30 p-b-140">
        <div class="container">
{{--            <div id="wrapper">--}}
{{--                @include('sidebar')--}}

{{--                <div id="page-content-wrapper">--}}
{{--                    <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">--}}
{{--                        <span class="hamb-top"></span>--}}
{{--                        <span class="hamb-middle"></span>--}}
{{--                        <span class="hamb-bottom"></span>--}}
{{--                    </button>--}}
                    <div class="flex-w flex-sb-m h-full p-t-100 p-b-30 respon5">
                        <div class="flex-w flex-l-m filter-tope-group">
                            <h1>{{ $title }}</h1>
                        </div>

                        <div class="flex-w flex-c-m m-tb-10">
                            <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                                <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                                <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                                Filter
                            </div>

                            <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                                <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                                <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                                Search
                            </div>
                        </div>

                        <!-- Search product -->
                        <div class="dis-none panel-search w-full p-t-10 p-b-15">
                            <div class="bor8 dis-flex p-l-15">
                                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                    <i class="zmdi zmdi-search"></i>
                                </button>

                                <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                            </div>
                        </div>

                        <!-- Filter -->
                        <div class="dis-none panel-filter w-full p-t-10">
                            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                                <div class="filter-col1 p-r-15 p-b-27">
                                    <div class="mtext-102 cl2 p-b-15">
                                        Sắp xếp theo
                                    </div>

                                    <ul>
                                        <li class="p-b-6">
                                            <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                                Mặc định
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}" class="filter-link stext-106 trans-04">
                                                Giá thấp đến cao
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}" class="filter-link stext-106 trans-04">
                                                Giá cao đến thấp
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Hàng mới về
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Bán chạy
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="filter-col2 p-r-15 p-b-27">
                                    <div class="mtext-102 cl2 p-b-15">
                                        Giá
                                    </div>

                                    <ul>
                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                                Tất cả
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Dưới 1.000.000 VND
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Từ 1 - 3 triệu
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Từ 3 - 5 triệu
                                            </a>
                                        </li>

                                        <li class="p-b-6">
                                            <a href="#" class="filter-link stext-106 trans-04">
                                                Trên 5 triệu
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div id="loadProduct">
                        @include('products.list')
                    </div>

                    <!-- Load more -->
                    <div class="flex-c-m flex-w w-full p-t-45" id="btn-loadMore">
                        <input type="hidden" value="1" id="page">
                        <a onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                            Xem Thêm
                        </a>
                    </div>
                </div>
{{--            </div>--}}
{{--        </div>--}}
    </section>
@endsection
