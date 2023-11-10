@extends('backend.admin-master')
@section('site-title')
    {{__('Breadcrumb Settings')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/spectrum.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Breadcrumb  Settings')}}</h4>
                        <form action="{{route('admin.breadcrumb.settings')}}" method="post">
                            @csrf
                            <x-media-upload :name="'site_breadcrumb_bg'" :dimentions="'1920x600'" :title="__('Breadcrumb Image')"/>
                            <div class="row">
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="#" class="d-block">{{__('Breadcrumb Background Overlay Color')}}</label>
                                       <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('breadcrumb_background_overlay_color')}} "></div>
                                       <input type="hidden" value="{{get_static_option('breadcrumb_background_overlay_color')}}" name="breadcrumb_background_overlay_color"  />
                                   </div>
                               </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Breadcrumb Title Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('breadcrumb_title_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('breadcrumb_title_color')}}" name="breadcrumb_title_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Breadcrumb Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('breadcrumb_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('breadcrumb_text_color')}}" name="breadcrumb_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Breadcrumb Text Active Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('breadcrumb_text_active_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('breadcrumb_text_active_color')}}" name="breadcrumb_text_active_color"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-range-wrap">
                                <div class="left-wrap">
                                    <label for="breadcrumb_padding_top" class="form-label">{{__('Padding Top')}}</label>
                                    <input type="range" class="form-range" name="breadcrumb_padding_top" value="{{get_static_option('breadcrumb_padding_top',120)}}" min="1" max="500" id="breadcrumb_padding_top">
                                    <div class="number-wrap">
                                        <span class="nuumber">{{get_static_option('breadcrumb_padding_top',120)}}</span>px
                                    </div>
                                </div>
                            </div>
                            <div class="form-range-wrap">
                                <div class="left-wrap">
                                    <label for="breadcrumb_padding_bottom" class="form-label">{{__('Padding Bottom')}}</label>
                                    <input type="range" class="form-range" value="{{get_static_option('breadcrumb_padding_bottom',120)}}" min="1" max="500" id="breadcrumb_padding_bottom" name="breadcrumb_padding_bottom">
                                    <div class="number-wrap">
                                        <span class="nuumber">{{get_static_option('breadcrumb_padding_bottom',120)}}</span>px
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script src="{{asset('assets/backend/js/spectrum.min.js')}}"></script>
    <script>
        (function($){
            "use strict";

            /* range slider input value */

            $(document).on('change','.form-range-wrap input[type="range"]',function (e){
                $(this).next().find('.nuumber').text($(this).val());
            });

            var colorPickerNode = $('.color_picker');
            colorPickerInit(colorPickerNode);
            function colorPickerInit(selector){

                $.each(selector,function (index,value){
                    var el = $(this);
                    el.spectrum({
                        showAlpha: true,
                        showPalette: true,
                        cancelText : '',
                        chooseText : '',
                        maxSelectionSize: 2,
                        showInput: true,
                        allowEmpty:true,
                        color: el.next('input').val(),
                        change: function(color) {
                            el.next('input').val( color ? color.toRgbString() : '');
                            el.css({
                                'background-color' : color ? color.toRgbString() : ''
                            });
                        },
                        move: function(color) {
                            el.next('input').val( color ? color.toRgbString() : '');
                            el.css({
                                'background-color' : color ? color.toRgbString() : ''
                            });
                        },
                        palette: [
                            [
                                "{{get_static_option('site_color')}}",
                                "{{get_static_option('site_main_color_two')}}",
                                "{{get_static_option('site_secondary_color')}}",
                                "{{get_static_option('site_heading_color')}}",
                                "{{get_static_option('site_paragraph_color')}}",
                                "{{get_static_option('portfolio_home_color')}}",
                                "{{get_static_option('logistics_home_color')}}",
                                "{{get_static_option('industry_home_color')}}",
                                "{{get_static_option('construction_home_color')}}",
                                "{{get_static_option('lawyer_home_color')}}",
                                "{{get_static_option('political_home_color')}}",
                                "{{get_static_option('medical_home_color')}}",
                                "{{get_static_option('medical_home_color_two')}}",
                                "{{get_static_option('fruits_home_color')}}",
                                "{{get_static_option('fruits_home_heading_color')}}",
                                "{{get_static_option('portfolio_home_dark_color')}}",
                                "{{get_static_option('portfolio_home_dark_two_color')}}",
                                "{{get_static_option('charity_home_color')}}",
                                "{{get_static_option('dagency_home_color')}}",
                                "{{get_static_option('cleaning_home_color')}}",
                                "{{get_static_option('cleaning_home_two_color')}}",
                                "{{get_static_option('course_home_color')}}",
                                "{{get_static_option('grocery_home_two_color')}}",
                                "{{get_static_option('grocery_home_color')}}"
                            ]
                        ]
                    });

                    el.on("dragstop.spectrum", function(e, color) {
                        el.next('input').val( color.toRgbString());
                        el.css({
                            'background-color' : color.toHexString()
                        });
                    });
                });
            }

            $(document).ready(function () {
                var imgSelect = $('.img-select');
                var id = $('#navbar_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-navid="'+id+'"]').parent().parent().addClass('selected');

                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#navbar_variant').val($(this).data('navid'));
                })
            });

        })(jQuery);
    </script>
@endsection
