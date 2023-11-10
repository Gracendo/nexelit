<script>
    $(document).on('click','#store_area_category_item_section_by_ajax li',function (e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        fetchPopularCategoryItemById($(this).data('catid'));
    });

    fetchPopularCategoryItemById($('#store_area_category_item_section_by_ajax li.active').data('catid'));
    function fetchPopularCategoryItemById(catid){
        let preloaderContainer = $('#store-area-append-container').find('.popular-category-preloader-wrap');
        $.ajax({
            url: "{{route('frontend.story.product.item.by.category')}}",
            type: 'POST',
            beforeSend:function(){
                let markup = ` <div class="col-lg-12 popular-category-preloader-wrap">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                $('#store-area-append-container').html(markup);
            },
            data: {
                _token: "{{csrf_token()}}",
                catid: catid
            },
            success: function (data){
                //append data
                let markup = ` <div class="col-lg-12 popular-category-preloader-wrap d-none">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                markup += data;
                //
                $('#store-area-append-container').html(markup);
                preloaderContainer.addClass('d-none');
            }
        });
    }
</script>