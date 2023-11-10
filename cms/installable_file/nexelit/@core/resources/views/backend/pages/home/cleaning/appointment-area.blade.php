@extends('backend.admin-master')
@section('site-title')
    {{__('Appointment Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Appointment Area Settings')}}</h4>
                        <form action="{{route('admin.home16.appointment')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                @foreach($all_languages as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link language_tab_btn @if(get_default_language() == $lang->slug) active @endif" data-toggle="tab" href="#nav-home-{{$lang->slug}}" data-lang="{{$lang->slug}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if(get_default_language() == $lang->slug) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="home_page_16_{{$lang->slug}}_appointment_section_subtitle">{{__('Subtitle')}}</label>
                                            <input type="text" name="home_page_16_{{$lang->slug}}_appointment_section_subtitle" class="form-control" value="{{get_static_option('home_page_16_'.$lang->slug.'_appointment_section_subtitle')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_16_{{$lang->slug}}_appointment_section_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_16_{{$lang->slug}}_appointment_section_title" class="form-control" value="{{get_static_option('home_page_16_'.$lang->slug.'_appointment_section_title')}}" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_16_appointment_section_category">{{__('Categories')}}</label>
                                @php
                                    $selected_donation = unserialize(get_static_option('home_page_16_appointment_section_category'),['class' => false]);
                                    $selected_cause = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
                                @endphp
                                <select  name="home_page_16_appointment_section_category[]" class="form-control nice-select wide" multiple>
                                    @foreach($all_categories as $cat)
                                        <option value="{{$cat->id}}" @if(in_array($cat->id,$selected_cause)) selected @endif>{{$cat->lang->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="home_page_16_appointment_items">{{__('Appointment Items')}}</label>
                                <input type="text" name="home_page_16_appointment_items" class="form-control"  value="{{get_static_option('home_page_16_appointment_items')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        (function (){
            "use strict";


            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

            $(document).on('click','.language_tab_btn',function (){

                var lang = $(this).data('lang');
                var container = $('#nav-home-'+lang).find('.nice-select');
                if( container.has('option').length > 1 ) {
                    return;
                }
                //ajax call
                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.home12.appointment.category.by.slug')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        lang: lang
                    },
                    success: function (data){
                        var container = $('#nav-home-'+lang).find('.nice-select');
                        container.html('');
                        var output = '<option value="">'+"{{__('Select category')}}"+'</option>';
                        $.each(data.categories,function (index,value){
                            var selected = data.selected_items.includes(value.id.toString()) ? 'selected' : '';
                            output += '<option value="'+value.id+'" '+selected+'>'+value.title+'</option>'
                        });
                        container.html(output);
                        $('.nice-select').niceSelect('update');
                    }
                });

            });

        })(jQuery)
    </script>
@endsection

