<div class="navbar-variant-03">
<div class="industry-support-wrap">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-9">
                <div class="industry-support-inner-wrap">
                    <div class="left-content">
                        @php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$global_static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$global_static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$global_static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        @endphp
                        <ul class="industry-info-items">
                            @foreach($all_icon_fields as $icon)
                                <li class="industry-single-info-item">
                                    <div class="icon">
                                        <i class="{{$icon}}"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{$all_title_fields[$loop->index] ?? ''}}</h4>
                                        <span class="details">{{$all_details_fields[$loop->index] ?? ''}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-content">
                        <ul class="industry-top-right-list">
                            @if(auth()->check())
                                @php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                @endphp
                                <li><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>
                                    <a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a href="{{route('user.register')}}">{{__('Register')}}</a></li>
                            @endif
                            @if(!empty(get_static_option('language_select_option')))
                                <li>
                                    <select id="langchange">
                                        @foreach($all_language as $lang)
                                            <option @if($user_select_lang_slug == $lang->slug) selected @endif value="{{$lang->slug}}" class="lang-option">{{explode('(',$lang->name)[0] ?? $lang->name}}</option>
                                        @endforeach
                                    </select>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-style-03  header-variant-07">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}" class="logo">
                        @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
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