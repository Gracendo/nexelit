<div class="navbar-variant-05">
<div class="construction-support-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="support-inner">
                    <div class="left-content-wrap">
                        @php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$global_static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$global_static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$global_static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        @endphp
                        <ul class="construction-info-list">
                            @foreach($all_icon_fields as $icon)
                                <li class="construction-single-info-list-item">
                                    <div class="icon">
                                        <i class="{{$icon}}"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle">{{$all_title_fields[$loop->index] ?? ''}}</span>
                                        <h5 class="title">{{$all_details_fields[$loop->index] ?? ''}}</h5>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-content-wrap">
                        <ul>
                            @if(auth()->check())
                                @php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                @endphp
                                <li><a href="{{$route}}">{{__('Dashboard')}}</a> <span>/</span>
                                    <a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a
                                            href="{{route('user.register')}}">{{__('Register')}}</a></li>
                            @endif
                            @if(!empty(filter_static_option_value('language_select_option',$global_static_field_data)))
                                <li>
                                    <select id="langchange">
                                        @foreach($all_language as $lang)
                                            <option @if($user_select_lang_slug == $lang->slug) selected
                                                    @endif value="{{$lang->slug}}"
                                                    class="lang-option">{{explode('(',$lang->name)[0] ?? $lang->name}}</option>
                                        @endforeach
                                    </select>
                                </li>
                            @endif
                            @if(!empty(filter_static_option_value('navbar_button',$global_static_field_data)))
                                <li>
                                    @php
                                        $custom_url = filter_static_option_value('navbar_button_custom_url_status',$global_static_field_data) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote');
                                    @endphp
                                    <div class="btn-wrapper">
                                        <a href="{{$custom_url}}" rel="canonical"
                                           @if(!empty(filter_static_option_value('navbar_button_custom_url_status',$global_static_field_data))) target="_blank"
                                           @endif class="boxed-btn reverse-color">{{filter_static_option_value('navbar_'.$user_select_lang_slug.'_button_text',$global_static_field_data)}}</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-style-03  header-variant-09 ">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}" class="logo">
                        @if(!empty(filter_static_option_value('site_white_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_white_logo',$global_static_field_data)) !!}
                        @else
                            <h2 class="site-title">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</h2>
                        @endif
                    </a>
                </div>
                <x-product-cart-mobile/>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <x-navbar-search/>
                        <x-product-cart/>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
</div>
