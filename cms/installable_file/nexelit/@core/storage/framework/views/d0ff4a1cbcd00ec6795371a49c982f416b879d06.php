<script>
    $(document).on('click','.addon_product_slider_quick_view',function(){
        let el = $(this);
        quick_view_data(el);
    });

    function quick_view_data(el)
    {
        let modal = $('.quick_view_modal');

        modal.find('.add_cart_from_quick_view').attr('data-product_id',el.data('id'));
        modal.find('.add_cart_from_quick_view').attr('data-product_title',el.data('title'));

        modal.find('.product-title').text(el.data('title'));
        modal.find('.title').text(el.data('title'));
        modal.find('.availability').text(el.data('in_stock'));
        modal.find('.image_category').text(el.data('category'));
        modal.find('.sale_price').text(el.data('sale_price'));
        modal.find('.regular_price').text(el.data('regular_price'));
        modal.find('.short_description').text(el.data('short_description'));
        modal.find('.product_category').text(el.data('category'));
        modal.find('.product_subcategory').text(el.data('subcategory'));
        modal.find('.img_con').attr('src',el.data('image'));
        modal.find('.ajax_add_to_cart_with_icon').data('src',el.data('image'));
    }

    $(document).on('keyup change','#quantity_single_quick_view_btn',function(){
        let modal = $('.quick_view_modal');
        let el = $(this).val();
        modal.find('.add_cart_from_quick_view').attr('data-product_quantity',el);
    });
</script><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/partials/custom-js-for-page-builder-addon/product-slider/quick-view-js.blade.php ENDPATH**/ ?>