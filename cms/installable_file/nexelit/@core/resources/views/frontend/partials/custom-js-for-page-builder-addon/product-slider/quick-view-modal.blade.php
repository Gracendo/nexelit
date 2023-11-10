<div class="modal fade home-variant-19 quick_view_modal" id="quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="quick-view-close-btn-wrapper">
                <button class="quick-view-close-btn close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-view-wrap product-img">
                                    <ul class="other-content">
                                        <li>
                                            <span class="badge-tag image_category"></span>
                                        </li>
                                    </ul>
                                    <img src="" alt="" class="img_con">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="product-summery">
                                    <!-- <span class="product-meta pricing">
                                         <span id="unit">1</span> <span id="uom">Piece</span>
                                    </span> -->
                                    <h3 class="product-title title"></h3>
                                    <div>
                                        <span class="availability is_available text-success"></span>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price sale_price font-weight-bold"></span>
                                        <del class="del-price del_price regular_price"></del>
                                    </div>
                                    <div class="rating-wrap ratings" style="display: none">
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                    </div>
                                    <div class="short-description">
                                        <p class="info short_description"></p>
                                    </div>
                                    <div class="cart-option"><div class="user-select-option">
                                        </div>
                                        <div class="d-flex">
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" min="1" max="10000000" value="1" id="quantity_single_quick_view_btn">
                                            </div>
                                            <div class="btn-wrapper">
                                                <a href="#" data-attributes="[]"
                                                   class="btn-default rounded-btn add-cart-style-02 add_cart_from_quick_view ajax_add_to_cart"
                                                   data-product_id=""
                                                   data-product_title=""
                                                   data-product_quantity=""
                                                >
                                                    {{__('Add to cart')}}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <p class="name">{{__('Category:')}} </p>
                                        <a href="" class="product_category"></a>
                                    </div>
                                    <div class="product-details-tag-and-social-link">
                                        <div class="tag d-flex">
                                            <p class="name">{{__('Subcategory:')}}  </p>
                                            <div class="subcategory_container">
                                                <a href="" class="tag-btn product_subcategory" rel="tag"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>