@if(!empty(get_static_option('product_module_status')))

    <li class=" wishlist_global">
        <a href="{{route('frontend.products.wishlist')}}">
            <i class="fas fa-heart"></i>
{{--            <span class="pcount">{{\App\Facades\Wishlist::count()}}</span>--}}
        </a>
    </li>

    <li class="cart cart_global ml-3">
        <a href="{{route('frontend.products.cart')}}">
            <i class="flaticon-shopping-cart"></i>
            <span class="pcount">{{\App\Facades\Cart::count()}}</span>
        </a>
    </li>
@endif
