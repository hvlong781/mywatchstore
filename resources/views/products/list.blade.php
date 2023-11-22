<style>
    .border-list-product{
        border-top: #f1f1f1 solid 1px;
        border-left: #f1f1f1 solid 1px;
    }
    .border-list-product-child{
        position: relative;
        width: 100%;
        border-bottom: #f3f3f3 solid 2px;
        border-right: #f3f3f3 solid 1px;
        padding-right: 15px;
        padding-left: 15px;
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
</style>
<div class="row isotope-grid border-list-product">
    @if(!empty($message))
        <p>{{ $message }}</p>
    @elseif($products->isEmpty())
        <p>Không có sản phẩm nào.</p>
    @else

    @foreach($products as $key => $product)
    <div class="col-sm-6 col-md-3 col-lg-3 p-t-10 p-b-35 isotope-item women border-list-product-child">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </a>

{{--                <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">--}}
{{--                    Quick View--}}
{{--                </a>--}}
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        {{ $product->name }}
                    </a>

                    <span class="stext-105 cl3">
                        {!! \App\Helpers\Helper::price($product->price) !!}
                    </span>
                </div>

{{--                    <div class="block2-txt-child2 flex-r p-t-3">--}}
{{--                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">--}}
{{--                            <img class="icon-heart1 dis-block trans-04" src="/template/images/icons/icon-heart-01.png" alt="ICON">--}}
{{--                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/template/images/icons/icon-heart-02.png" alt="ICON">--}}
{{--                        </a>--}}
{{--                    </div>--}}
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
