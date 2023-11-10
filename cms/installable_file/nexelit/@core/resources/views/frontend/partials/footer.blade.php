@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
    $home_page19_color_con = $home_page_variant == '19' ? '' :  'footer-top';
@endphp
@if(!in_array(Route::currentRouteName(),['frontend.course.lesson','frontend.course.lesson.start']))
<footer class="footer-area home-variant-{{$home_page_variant}}
@if((request()->routeIs('homepage')  || request()->routeIs('frontend.homepage.demo') ) && $home_page_variant == '17' &&
filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))
   has-top-padding
@endif
@if($home_page_variant === '21')
 home-21 home-21-section-bg footer-color-five
 @elseif($home_page_variant == '19')
 footer-bg footer-color-three
@endif
">
@if(App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('footer',['column' => true]))
<div class="{{$home_page19_color_con}} padding-top-90 padding-bottom-65">
    <div class="container">
        <div class="row">
            {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('footer',['column' => true]) !!}
        </div>
    </div>
</div>
@endif
<div class="copyright-area copyright-bg">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="copyright-item">
                <div class="copyright-area-inner">
                    {!! get_footer_copyright_text() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</footer>
@if(preg_match('/(xgenious)/',url('/')))
<div class="buy-now-wrap">
<ul class="buy-list">
    <li><a target="_blank"href="https://xgenious.com/laravel/nexelit/doc/" data-container="body" data-toggle="popover" data-placement="left" data-content="{{__('Documentation')}}"><i class="far fa-file-alt"></i></a></li>
    <li><a target="_blank"href="https://1.envato.market/OXNPP"><i class="fas fa-shopping-cart"></i></a></li>
    <li><a target="_blank"href="https://xgenious51.freshdesk.com/"><i class="fas fa-headset"></i></a></li>
</ul>
</div>
@endif
<div class="back-to-top">
<span class="back-top">
<i class="fas fa-angle-up"></i>
</span>
</div>

@include('frontend.partials.popup-structure')
@endif
<!-- load all script -->
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/dynamic-script.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.mb.YTPlayer.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/slick.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
@if(\Route::currentRouteName() === 'frontend.products')
<script src="{{asset('assets/frontend/js/jquery-ui.js')}}"></script>
@endif
<script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>

<x-frontend.others.advertisement-script/>
@if(request()->routeIs('homepage') || request()->routeIs('frontend.homepage.demo'))
@include('frontend.partials.popup-jspart')
@include('frontend.partials.gdpr-cookie')
@endif

@include('frontend.partials.twakto')
@include('frontend.partials.google-captcha')
@include('frontend.partials.inline-script')
@include('frontend.partials.product-ajax-js')
@yield('scripts')



</body>
</html>
