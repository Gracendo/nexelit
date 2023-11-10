@if(empty(get_static_option('navbar_variant')))
@include('frontend.partials.supportbar',['home_page_variant' => $home_page_variant])
@endif