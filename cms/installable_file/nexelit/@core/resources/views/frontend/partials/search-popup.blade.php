<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <div class="search-popup-inner-wrapper">
        <form action="{{route('frontend.blog.search')}}" method="get" class="search-form-warp">
            <span class="search-popup-close-btn">×</span>
            <div class="form-group">
                <input type="text" class="form-control search-field" name="search" placeholder="{{__('Search...')}}">
            </div>
            <div class="form-group">
                <select name="search_type" id="search_popup_search_type" class="form-control">
                    @if(!empty(get_static_option('product_module_status')) && $home_page_variant == '19')
                            <option value="product">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}}</option>
                            <option value="blog">{{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}</option>
                    @elseif( $home_page_variant == '20')
                        <option value="blog">{{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}</option>
                        <option value="product">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}}</option>
                    @endif

                    @if(!empty(get_static_option('events_module_status')))
                    <option value="event">{{get_static_option('events_page_'.$user_select_lang_slug.'_name')}}</option>
                     @endif


                    @if(!empty(get_static_option('knowledgebase_module_status')))
                    <option value="knowledgebase">{{get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')}}</option>
                     @endif
                </select>
            </div>
            <button class="close-btn border-none" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
