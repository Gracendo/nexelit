<div class="single-product-item-3 @if(isset($margin)) margin-bottom-30 @endif">
    <div class="thumb">
        <a href="{{route('frontend.products.single',$product->slug)}}">
            <div class="img-wrapper">
                {!! render_image_markup_by_attachment_id($product->image,'','grid') !!}
            </div>
        </a>
        @if(!empty($product->badge))
            <span class="tag">{{$product->badge}}</span>
        @endif
    </div>
    <div class="content">
        <a href="{{route('frontend.products.single',$product->slug)}}">
            <h4 class="title">{{$product->title}}</h4>
        </a>
        @if(count($product->ratings) > 0)
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($product->id) / 5 * 100}}%"></span>
                </div>
                <p><span class="total-ratings">({{count($product->ratings)}})</span></p>
            </div>
        @endif
        @if(!get_static_option('display_price_only_for_logged_user'))
            <div class="price-wrap">
                <span class="price">{{$product->sale_price == 0 ? __('Free') : amount_with_currency_symbol($product->sale_price)}}</span>
                @if(!empty($product->regular_price))
                    <del class="del-price">{{amount_with_currency_symbol($product->regular_price)}}</del>
                @endif
            </div>
        @endif
        @if($product->stock_status == 'out_stock')
            <div class="out_of_stock">{{__('Out Of Stock')}}</div>
        @else
            @if(!empty($product->variant) && count(json_decode($product->variant,true)) > 0)
                <a href="{{route('frontend.products.single',$product->slug)}}" class="addtocart" data-product_id="{{$product->id}}" data-product_title="{{$product->title}}" data-product_quantity="1">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    {{get_static_option('product_view_option_button_'.$user_select_lang_slug.'_text',__('View Options'))}}</a>
            @elseif($product->is_downloadable === 'on' && $product->direct_download === 1)
                <a href="{{route('frontend.products.single',$product->slug)}}" class="addtocart" data-product_id="{{$product->id}}" data-product_title="{{$product->title}}" data-product_quantity="1">
                    <i class="fas fa-download"></i>
                    {{get_static_option('product_download_now_button_'.$user_select_lang_slug.'_text')}}</a>
            @else
                <a href="{{route('frontend.products.add.to.cart')}}" class="addtocart ajax_add_to_cart" data-product_id="{{$product->id}}" data-product_title="{{$product->title}}" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    {{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}</a>
            @endif
        @endif
    </div>
</div>