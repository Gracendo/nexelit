    @if(!empty($product->variant))
        @foreach(json_decode($product->variant) as $id => $terms)
            @php
                $variant = get_product_variant_list_by_id($id);
            @endphp
            @if(!empty($variant))
                <div class="product-variant-list-wrapper">
                    <h5 class="title">{{$variant->title}}</h5>
                    <ul class="product-variant-list">
                        @php
                            $prices = json_decode($variant->price);
                        @endphp
                        @foreach($terms as $term)
                            @php
                                $v_term_index  = array_search($term,json_decode($variant->terms,true));
                            @endphp
                            <li
                                    data-variantid="{{$id}}"
                                    data-variantname="{{$variant->title}}"
                                    data-term="{{$term}}"
                                    @if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index]))
                                        data-price="{{$prices[$v_term_index]}}"
                                        data-termprice="{{amount_with_currency_symbol($prices[$v_term_index] + $product->sale_price )}}"
                                    @else
                                        data-termprice="{{amount_with_currency_symbol($product->sale_price)}}"
                                    @endif
                            >
                                {{$term}}
                                @if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index]))
                                    <small>+ {{amount_with_currency_symbol($prices[$v_term_index])}} </small>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    @endif