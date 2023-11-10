@if(request()->routeIs('homepage') || request()->routeIs('frontend.homepage.demo'))
    <meta property="og:title"  content="{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}" />
    {!! render_og_meta_image_by_attachment_id(filter_static_option_value('og_meta_image_for_site',$global_static_field_data)) !!}
    <title>{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}} - {{filter_static_option_value('site_'.$user_select_lang_slug.'_tag_line',$global_static_field_data)}}</title>
    <meta name="description" content="{{filter_static_option_value('site_meta_'.$user_select_lang_slug.'_description',$global_static_field_data)}}">
    <meta name="tags" content="{{filter_static_option_value('site_meta_'.$user_select_lang_slug.'_tags',$global_static_field_data)}}">
@else
    @yield('page-meta-data')
    <title>
        @yield('site-title')
        @hasSection('site-title') - @else @yield('page-title') -  @endif
        {{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}
    </title>
    @yield('og-meta')
@endif
