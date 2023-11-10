@if(!empty(get_static_option('product_module_status')))
    <div class="mobile-cart">
        <a href="{{route('frontend.products.cart')}}">
            <i class="flaticon-shopping-cart"></i>
            <span class="pcount">{{\App\Facades\Cart::count()}}</span>
        </a>
    </div>

@endif