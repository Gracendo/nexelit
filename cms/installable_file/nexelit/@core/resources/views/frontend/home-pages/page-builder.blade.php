@include('frontend.partials.navbar-variant.navbar-'.get_static_option('navbar_variant'))
{!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_by_location('homepage') !!}