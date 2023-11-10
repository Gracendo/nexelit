@php 
if(empty(get_static_option('home_page_page_builder_status')) && in_array($home_page_variant,['07','09','19']) || Route::currentRouteName() == 'frontend.course.lesson'){ return;} 
@endphp
@if(!empty(get_static_option('home_page_support_bar_section_status')))
    <div class="top-bar-area header-variant-{{get_static_option('home_page_variant')}}">
        <div class="container @if($home_page_variant == '20') container-two" @endif>
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-bar-inner">
                        <div class="left-content">
                            <ul class="social-icons">
                                @foreach($all_social_item as $data)
                                    <li><a href="{{$data->url}}" rel="canonical"><i class="{{$data->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="right-content">
                            <ul>
                                @if(auth()->check())
                                    @php
                                        $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                    @endphp
                                    <li class="login-register"><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>
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
                                    <li class="login-register"><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a href="{{route('user.register')}}">{{__('Register')}}</a></li>
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
                                @if(!empty(get_static_option('navbar_button')))
                                    <li>
                                        @php
                                            $custom_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote');
                                        @endphp
                                        <div class="btn-wrapper">
                                            <a href="{{$custom_url}}" rel="canonical"
                                               @if(!empty(get_static_option('navbar_button_custom_url_status'))) target="_blank"
                                               @endif class="boxed-btn reverse-color">{{get_static_option('navbar_'.$user_select_lang_slug.'_button_text')}}</a>
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
@endif