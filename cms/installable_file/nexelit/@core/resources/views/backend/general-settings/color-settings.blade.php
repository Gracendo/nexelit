@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/colorpicker.css')}}">
@endsection
@section('site-title')
    {{__('Color Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Color Settings")}}</h4>
                        <form action="{{route('admin.general.color.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_color">{{__('Site Main Color Settings')}}</label>
                                <input type="text" name="site_color" style="background-color: {{get_static_option('site_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_color')}}" id="site_color">
                                <small>{{__('you change site main color from here, it will replace website main color')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_three">{{__('Site Main Color Three Settings')}}</label>
                                <input type="text" name="main_color_three" style="background-color: {{get_static_option('main_color_three')}};color: #ff805d;" class="form-control" value="{{get_static_option('main_color_three')}}" >
                                <small>{{__('you change site main color three from here, it will replace website main color three')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_three_rgb">{{__('Site Main Color Three RGB Settings')}}</label>
                                <input type="text" name="main_color_three_rgb" style="background-color: {{get_static_option('main_color_three_rgb')}};color: #FF805D;" class="form-control" value="{{get_static_option('main_color_three_rgb')}}" >
                                <small>{{__('you change site main color three rgb from here, it will replace website main color three rgb')}}</small>
                            </div>
                             <div class="form-group">
                                <label for="main_color_four">{{__('Site Main Color Four Settings')}}</label>
                                <input type="text" name="main_color_four" style="background-color: {{get_static_option('main_color_four')}};color: #ff1747;" class="form-control" value="{{get_static_option('main_color_four')}}" >
                                <small>{{__('you change site main color four from here, it will replace website main color four')}}</small>
                            </div>
                             <div class="form-group">
                                <label for="main_color_four_rgb">{{__('Site Main Color Four RGB Settings')}}</label>
                                <input type="text" name="main_color_four_rgb" style="background-color: {{get_static_option('main_color_four_rgb')}};color: #FF1747;" class="form-control" value="{{get_static_option('main_color_four_rgb')}}" >
                                <small>{{__('you change site main color four from here, it will replace website main color four rgb')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_five">{{__('Site Main Color Five Settings')}}</label>
                                <input type="text" name="main_color_five" style="background-color: {{get_static_option('main_color_five')}};color: #fcda69;" class="form-control" value="{{get_static_option('main_color_five')}}">
                                <small>{{__('you change site main color five from here, it will replace website main color five')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_five_rgb">{{__('Site Main Color Five RGB Settings')}}</label>
                                <input type="text" name="main_color_five_rgb" style="background-color: {{get_static_option('main_color_five_rgb')}};color: #FFDA69;" class="form-control" value="{{get_static_option('main_color_five_rgb')}}">
                                <small>{{__('you change site main color five from here, it will replace website main color five')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_color">{{__('Site Base Color Two Settings')}}</label>
                                <input type="text" name="site_main_color_two" style="background-color: {{get_static_option('site_main_color_two')}};color: #fff;" class="form-control" value="{{get_static_option('site_main_color_two')}}" id="site_main_color_two">
                                <small>{{__('you change site base color two color from here, it will replace website site base color two color')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_secondary_color">{{__('Site Secondary Color Settings')}}</label>
                                <input type="text" name="site_secondary_color" style="background-color: {{get_static_option('site_secondary_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_secondary_color')}}" id="site_secondary_color">
                                <small>{{__('you change site secondary color from here, it will replace website secondary color')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_heading_color">{{__('Site Heading Color')}}</label>
                                <input type="text" name="site_heading_color" style="background-color: {{get_static_option('site_heading_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_heading_color')}}" id="site_heading_color">
                                <small>{{__('you can change site heading color from there , when you chnage this color it will reflect the color in all the heading like (h1,h2,h3,h4.h5.h6)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_paragraph_color">{{__('Site Paragraph Color')}}</label>
                                <input type="text" name="site_paragraph_color" style="background-color: {{get_static_option('site_paragraph_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_paragraph_color')}}" id="site_paragraph_color">
                                <small>{{__('you can change site paragraph color from there')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_color">{{__('Portfolio Home Color')}}</label>
                                <input type="text" name="portfolio_home_color" style="background-color: {{get_static_option('portfolio_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('portfolio_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="logistics_home_color">{{__('Logistics Home Color')}}</label>
                                <input type="text" name="logistics_home_color" style="background-color: {{get_static_option('logistics_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('logistics_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="industry_home_color">{{__('Industry Home Color')}}</label>
                                <input type="text" name="industry_home_color" style="background-color: {{get_static_option('industry_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('industry_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="construction_home_color">{{__('Construction Home Color')}}</label>
                                <input type="text" name="construction_home_color" style="background-color: {{get_static_option('construction_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('construction_home_color')}}" >
                            </div>

                            <div class="form-group">
                                <label for="lawyer_home_color">{{__('Lawyer Home Color')}}</label>
                                <input type="text" name="lawyer_home_color" style="background-color: {{get_static_option('lawyer_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('lawyer_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="political_home_color">{{__('Political Home Color')}}</label>
                                <input type="text" name="political_home_color" style="background-color: {{get_static_option('political_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('political_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="medical_home_color">{{__('Medical Home Color One')}}</label>
                                <input type="text" name="medical_home_color" style="background-color: {{get_static_option('medical_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('medical_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="medical_home_color_two">{{__('Medical Home Color Two')}}</label>
                                <input type="text" name="medical_home_color_two" style="background-color: {{get_static_option('medical_home_color_two')}};color: #fff;" class="form-control" value="{{get_static_option('medical_home_color_two')}}" >
                            </div>
                            <div class="form-group">
                                <label for="fruits_home_color">{{__('Fruits Home Color')}}</label>
                                <input type="text" name="fruits_home_color" style="background-color: {{get_static_option('fruits_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('fruits_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="fruits_home_heading_color">{{__('Fruits Home Heading Color')}}</label>
                                <input type="text" name="fruits_home_heading_color" style="background-color: {{get_static_option('fruits_home_heading_color')}};color: #fff;" class="form-control" value="{{get_static_option('fruits_home_heading_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_dark_color">{{__('Portfolio Home Dark One Color')}}</label>
                                <input type="text" name="portfolio_home_dark_color" style="background-color: {{get_static_option('portfolio_home_dark_color')}};color: #fff;" class="form-control" value="{{get_static_option('portfolio_home_dark_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_dark_two_color">{{__('Portfolio Home Dark Two Color')}}</label>
                                <input type="text" name="portfolio_home_dark_two_color" style="background-color: {{get_static_option('portfolio_home_dark_two_color')}};color: #fff;" class="form-control" value="{{get_static_option('portfolio_home_dark_two_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="charity_home_color">{{__('Charity Home Color')}}</label>
                                <input type="text" name="charity_home_color" style="background-color: {{get_static_option('charity_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('charity_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="dagency_home_color">{{__('Design Agency Home Color')}}</label>
                                <input type="text" name="dagency_home_color" style="background-color: {{get_static_option('dagency_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('dagency_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="cleaning_home_color">{{__('Cleaning Home Color')}}</label>
                                <input type="text" name="cleaning_home_color" style="background-color: {{get_static_option('cleaning_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('cleaning_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="cleaning_home_two_color">{{__('Cleaning Home Two Color')}}</label>
                                <input type="text" name="cleaning_home_two_color" style="background-color: {{get_static_option('cleaning_home_two_color')}};color: #fff;" class="form-control" value="{{get_static_option('cleaning_home_two_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="course_home_color">{{__('Course Home Color')}}</label>
                                <input type="text" name="course_home_color" style="background-color: {{get_static_option('course_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('course_home_color')}}" >
                            </div>

                            <div class="form-group">
                                <label for="course_home_two_color">{{__('Course Home Two Color')}}</label>
                                <input type="text" name="course_home_two_color" style="background-color: {{get_static_option('course_home_two_color')}};color: #fff;" class="form-control" value="{{get_static_option('course_home_two_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="grocery_home_color">{{__('Grocery Home Color')}}</label>
                                <input type="text" name="grocery_home_color" style="background-color: {{get_static_option('grocery_home_color')}};color: #fff;" class="form-control" value="{{get_static_option('grocery_home_color')}}" >
                            </div>
                            <div class="form-group">
                                <label for="grocery_home_two_color">{{__('Grocery Home Two Color')}}</label>
                                <input type="text" name="grocery_home_two_color" style="background-color: {{get_static_option('grocery_home_two_color')}};color: #fff;" class="form-control" value="{{get_static_option('grocery_home_two_color')}}" >
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/colorpicker.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                initColorPicker('#site_color');
                initColorPicker('#site_secondary_color');
                initColorPicker('#site_main_color_two');
                initColorPicker('#site_heading_color');
                initColorPicker('#site_paragraph_color');
                initColorPicker('input[name="portfolio_home_color"');
                initColorPicker('input[name="logistics_home_color"');
                initColorPicker('input[name="industry_home_color"');
                initColorPicker('input[name="construction_home_color"');
                initColorPicker('input[name="lawyer_home_color"');
                initColorPicker('input[name="political_home_color"');
                initColorPicker('input[name="medical_home_color"');
                initColorPicker('input[name="medical_home_color_two"');
                initColorPicker('input[name="fruits_home_color"');
                initColorPicker('input[name="fruits_home_heading_color"');
                initColorPicker('input[name="portfolio_home_dark_two_color"');
                initColorPicker('input[name="portfolio_home_dark_color"');
                initColorPicker('input[name="dagency_home_color"');
                initColorPicker('input[name="cleaning_home_color"');
                initColorPicker('input[name="cleaning_home_two_color"');
                initColorPicker('input[name="course_home_color"');
                initColorPicker('input[name="charity_home_color"');
                initColorPicker('input[name="course_home_two_color"');
                initColorPicker('input[name="grocery_home_color"');
                initColorPicker('input[name="grocery_home_two_color"');
                
                initColorPicker('input[name="main_color_three"');
                initColorPicker('input[name="main_color_three_rgb"');
                initColorPicker('input[name="main_color_four"');
                initColorPicker('input[name="main_color_four_rgb"');
                initColorPicker('input[name="main_color_five"');
                initColorPicker('input[name="main_color_five_rgb"');

                function initColorPicker(selector){
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
@endsection
