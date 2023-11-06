<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Giỏ hàng
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            @php
                $sumPriceCart = 0;

                $carts = \Illuminate\Support\Facades\Session::get('carts') ?? [];

                $productId = array_keys($carts);

                // Kiểm tra nếu $productId không rỗng
                if (!empty($productId)) {
                    $orderingString = "FIELD(id, " . implode(',', $productId) . ")";

                    $products = \App\Models\Product::select('id', 'name', 'price', 'quantity', 'image')
                        ->where('active', 1)
                        ->whereIn('id', $productId)
                        ->orderByRaw($orderingString)
                        ->get();
                } else {
                    // Nếu không có sản phẩm nào trong giỏ hàng
                    $products = collect([]);
                }
            @endphp
            <ul class="header-cart-wrapitem w-full">
                @if(count($products) > 0)
                    @foreach($products as $key => $product)
                        @php
//                            $carts = \Illuminate\Support\Facades\Session::get('carts');
//                            $price = \App\Helpers\Helper::price($product->price, $product->price_sale);
                            $priceN = $product->price;
                            $priceE = 0;
                            if (isset($carts[$product->id])) {
                                $priceE = $priceN * $carts[$product->id];
                            }
                            $sumPriceCart += $priceE;
                        @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $product->image }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $product->name }}
                                </a>

                                <span class="header-cart-item-info">
                                    {!! $priceN !!} * {{ isset($carts[$product->id]) ? $carts[$product->id] : 0 }}
                                </span>

                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: {{ number_format($sumPriceCart, '0', '', '.') }}
                </div>

                <div class="header-cart-buttons flex-c w-full">
                    <a href="/carts"
                       class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem giỏ hàng
                    </a>

                    {{--                    <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">--}}
                    {{--                        Check Out--}}
                    {{--                    </a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
