@if(!empty(get_static_option('preloader_status')))
    @php
        $preloader = 'preloader-default';
        if (!empty(get_static_option('preloader_custom'))){
            $preloader = 'preloader-custom';
        }elseif(empty(get_static_option('preloader_custom')) && !empty(get_static_option('preloader_default'))){
            $preloader = 'preloader-dynamic';
        }
    @endphp
    @include('frontend.partials.preloader.'.$preloader)
@endif