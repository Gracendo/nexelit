@extends('backend.admin-master')
@section('site-title')
    {{__('Navbar Settings')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/spectrum.min.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-8 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Navbar Settings')}}</h4>
                        <div class="alert alert-info">{{__('This navbar will show compelete website if you are using page builder for your home page, otherwise it will not show in home variant, but shown in all inner pages')}}</div>
                        <form action="{{route('admin.navbar.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="navbar_search_icon_status"><strong>{{__('Navbar Search Icon Show/Hide')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="navbar_search_icon_status"  @if(!empty(get_static_option('navbar_search_icon_status'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <input type="hidden" class="form-control"  id="navbar_variant" value="{{get_static_option('navbar_variant')}}" name="navbar_variant">
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-01.png')}}" data-navid="01" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-02.png')}}" data-navid="02" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-03.png')}}" data-navid="03" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-04.png')}}" data-navid="04" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-05.png')}}" data-navid="05" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/frontend/navbar-variant/navbar-06.png')}}" data-navid="06" alt="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Navbar Color Settings')}}</h4>
                        <form action="{{route('admin.navbar.color.settings')}}" method="post">
                            @csrf
                            <div class="row">
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label for="#" class="d-block">{{__('Navbar Background Color')}}</label>
                                       <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_background_color')}} "></div>
                                       <input type="hidden" value="{{get_static_option('navbar_background_color')}}" name="navbar_background_color"  />
                                   </div>
                               </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_text_color')}}" name="navbar_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Text Hover Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_text_hover_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_text_hover_color')}}" name="navbar_text_hover_color"  />
                                    </div>
                                </div>
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label for="#" class="d-block">{{__('Navbar Dropdown Background Color')}}</label>
                                       <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_dropdown_background_color')}} "></div>
                                       <input type="hidden" value="{{get_static_option('navbar_dropdown_background_color')}}" name="navbar_dropdown_background_color"  />
                                   </div>
                               </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Dropdown Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_dropdown_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_dropdown_text_color')}}" name="navbar_dropdown_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Dropdown Hover Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_dropdown_hover_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_dropdown_hover_text_color')}}" name="navbar_dropdown_hover_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Dropdown Hover Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_dropdown_hover_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_dropdown_hover_background_color')}}" name="navbar_dropdown_hover_background_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Dropdown Border Bottom Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_dropdown_border_bottom_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_dropdown_border_bottom_color')}}" name="navbar_dropdown_border_bottom_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Cart Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_cart_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_cart_text_color')}}" name="navbar_cart_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Navbar Cart Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_cart_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('navbar_cart_background_color')}}" name="navbar_cart_background_color"  />
                                    </div>
                                </div>
                                @if(in_array(get_static_option('navbar_variant'),['02']))
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="#" class="d-block">{{__('Navbar Logo Background Color')}}</label>
                                            <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('navbar_cart_background_color')}} "></div>
                                            <input type="hidden" value="{{get_static_option('navbar_cart_background_color')}}" name="navbar_cart_background_color"  />
                                        </div>
                                    </div>
                                @endif

                               <div class="col-lg-12">
                                   <h5 class="header-title">{{__('Top Bar Settings')}}</h5>
                               </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Topbar Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('topbar_background_color')}}" name="topbar_background_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Topbar Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('topbar_text_color')}}" name="topbar_text_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Topbar Text Hover Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_text_hover_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('topbar_text_hover_color')}}" name="topbar_text_hover_color"  />
                                    </div>
                                </div>
                                @if(in_array(get_static_option('navbar_variant'),['02','01','04','05']))
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Topbar Button Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_button_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('topbar_button_background_color')}}" name="topbar_button_background_color"  />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Topbar Button Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_button_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('topbar_button_text_color')}}" name="topbar_button_text_color"  />
                                    </div>
                                </div>
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label for="#" class="d-block">{{__('Topbar Button Background Hover Color')}}</label>
                                       <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_button_background_hover_color')}} "></div>
                                       <input type="hidden" value="{{get_static_option('topbar_button_background_hover_color')}}" name="topbar_button_background_hover_color"  />
                                   </div>
                               </div>
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label for="#" class="d-block">{{__('Topbar Button Text Hover Color')}}</label>
                                       <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_button_text_hover_color')}} "></div>
                                       <input type="hidden" value="{{get_static_option('topbar_button_text_hover_color')}}" name="topbar_button_text_hover_color" />
                                   </div>
                               </div>
                                @endif
                                @if(in_array(get_static_option('navbar_variant'),['03','05']))
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="#" class="d-block">{{__('Topbar Info Title Color')}}</label>
                                            <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_info_title_color')}} "></div>
                                            <input type="hidden" value="{{get_static_option('topbar_info_title_color')}}" name="topbar_info_title_color" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="#" class="d-block">{{__('Topbar Info Icon Color')}}</label>
                                            <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('topbar_info_icon_color')}} "></div>
                                            <input type="hidden" value="{{get_static_option('topbar_info_icon_color')}}" name="topbar_info_icon_color" />
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-12">
                                    <h5 class="header-title">{{__('Mega Menu Settings')}}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_background_color')}}" name="mega_menu_background_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_text_color')}}" name="mega_menu_text_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Title Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_title_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_title_color')}}" name="mega_menu_title_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Text Hover Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_text_hover_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_text_hover_color')}}" name="mega_menu_text_hover_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Button Background Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_button_background_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_button_background_color')}}" name="mega_menu_button_background_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Button Text Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_button_text_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_button_text_color')}}" name="mega_menu_button_text_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Button Text Hover Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_button_text_hover_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_button_text_hover_color')}}" name="mega_menu_button_text_hover_color" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#" class="d-block">{{__('Mega Menu Button Background Hover Color')}}</label>
                                        <div class="color_picker" title="{{__('Click to change color')}}" style="background-color: {{get_static_option('mega_menu_button_background_hover_color')}} "></div>
                                        <input type="hidden" value="{{get_static_option('mega_menu_button_background_hover_color')}}" name="mega_menu_button_background_hover_color" />
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
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/spectrum.min.js')}}"></script>
    <script>
        (function($){
            "use strict";
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
