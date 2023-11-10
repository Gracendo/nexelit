@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('All Popups')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Popups')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_popup as $key => $popup)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_popup as $key => $popup)
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default" id="all_blog_table">
                                            <thead>
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Type')}}</th>
                                            <th>{{__('Created At')}}</th>
                                            <th>{{__('Action')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($popup as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{ucwords(str_replace('_',' ',$data->type))}}</td>
                                                    <td>{{date("d - M - Y", strtotime($data->created_at))}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.popup.builder.delete',$data->id)"/>
                                                        <a class="btn btn-primary btn-xs mb-3 mr-1" href="{{route('admin.popup.builder.edit',$data->id)}}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        <a class="btn btn-info btn-xs mb-3 mr-1 show_modal_demo"
                                                           href="#"
                                                           data-type="{{$data->type}}"
                                                           data-title="{{$data->title}}"
                                                           data-description="{{$data->description}}"
                                                           data-only_image="{{$data->only_image}}"
                                                           @php
                                                               $image_url = get_attachment_image_by_id($data->only_image,'full',false);
                                                               $image_url = !empty($image_url) ? $image_url['img_url'] : '';
                                                           @endphp
                                                           data-imageurl="{{$image_url}}"
                                                           @php
                                                               $bg_image_url = get_attachment_image_by_id($data->background_image,'full',false);
                                                               $bg_image_url = !empty($bg_image_url) ? $bg_image_url['img_url'] : '';
                                                           @endphp
                                                           data-background_image="{{$bg_image_url}}"
                                                           data-button_text="{{$data->button_text}}"
                                                           data-button_link="{{$data->button_link}}"
                                                           data-btn_status="{{$data->btn_status}}"
                                                           data-offer_time_end="{{$data->offer_time_end}}"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <form action="{{route('admin.popup.builder.clone',$data->id)}}" method="post" style="display: inline-block">
                                                            @csrf
                                                            <button type="submit" title="clone this to new draft" class="btn btn-xs btn-secondary btn-sm mb-3 mr-1"><i class="far fa-copy"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @php $b++; @endphp
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nx-popup-backdrop"></div>
    <div class="nx-popup-wrapper ">
        <div class="nx-modal-content-wrapper">
            <div class="nx-modal-inner-content-wrapper">
                <div class="nx-popup-close">&times;</div>
                <div class="nx-modal-content">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="{{asset('assets/common/js/countdown.jquery.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.popup.builder.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.show_modal_demo',function (e) {
                e.preventDefault();
                var el = $(this);
                var type = el.data('type');
                setTimeout(function () {
                    $('.nx-popup-backdrop').addClass('show');
                    $('.nx-popup-wrapper').addClass('show');
                });
                showPopupDemo(type,el);

            });


            function showPopupDemo(type,el){
                if(type == 'notice'){
                    $('.nx-popup-wrapper').addClass('notice-modal');
                    $('.nx-modal-content').html(' <div class="notice-modal-content-wrapper">\n' +
                        '<div class="right-side-content">\n' +
                        '<h4 class="title">'+el.data('title')+'</h4>\n' +
                        '<p>'+el.data('description')+'</p>\n' +
                        '</div>\n' +
                        '</div>');
                }else if(type == 'only_image'){
                    $('.nx-popup-wrapper').addClass('only-image-modal');
                    $('.nx-popup-wrapper.only-image-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('imageurl')+')'
                    });
                }else if(type == 'promotion'){

                    $('.nx-popup-wrapper').addClass('promotion-modal');
                    $('.nx-popup-wrapper.promotion-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('background_image')+')'
                    })
                    $('.nx-modal-content').html('<div class="promotional-modal-content-wrapper">\n' +
                        '<div class="left-content-warp">\n' +
                        '<img src="'+el.data('imageurl')+'" alt="">\n' +
                        '</div>\n' +
                        '<div class="right-content-warp">\n' +
                        '<div class="right-content-inner-wrap">\n' +
                        '<h4 class="title">'+el.data('title')+'</h4>\n' +
                        '<p>'+el.data('description')+'</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>');

                    if(el.data('btn_status') == 'on'){
                        $('.promotional-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="btn-wrapper"><a href="'+el.data('button_link')+'" class="btn-boxed">'+el.data('button_text')+'</a></div>');
                    }

                }else{
                    $('.nx-popup-wrapper').addClass('discount-modal');
                    $('.nx-popup-wrapper.discount-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('background_image')+')'
                    })
                    $('.nx-modal-content').html('<div class="discount-modal-content-wrapper">\n' +
                        '<div class="left-content-warp">\n' +
                        '<img src="'+el.data('imageurl')+'" alt="">\n' +
                        '</div>\n' +
                        '<div class="right-content-warp">\n' +
                        '<div class="right-content-inner-wrap">\n' +
                        '<h4 class="title">'+el.data('title')+'</h4>\n' +
                        '<p>'+el.data('description')+'</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>');
                    if(el.data('offer_time_end')){
                        $('.discount-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="countdown-wrapper"><div id="countdown"></div></div>');
                    }
                    if(el.data('btn_status') == 'on'){
                        $('.discount-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="btn-wrapper"><a href="'+el.data('button_link')+'" class="btn-boxed">'+el.data('button_text')+'</a></div>');
                    }

                    var offerTime = el.data('offer_time_end');
                    var year = offerTime.substr(0,4);
                    var month = offerTime.substr(5,2);
                    var day = offerTime.substr(8,2);

                    $('#countdown').countdown({
                        year: year,
                        month: month,
                        day: day,
                        labels: true,
                        labelText: {
                            'days': "{{__('days')}}",
                            'hours': "{{__('hours')}}",
                            'minutes': "{{__('min')}}",
                            'seconds': "{{__('sec')}}",
                        }
                    });

                }
            }

            $(document).on('click','.nx-popup-close,.nx-popup-backdrop',function (e) {
                e.preventDefault();
                $('.nx-modal-inner-content-wrapper').removeAttr('style');
                $('.nx-modal-content').html('');
                $('.nx-popup-wrapper').removeClass('only-image-modal');
                $('.nx-popup-wrapper').removeClass('notice-modal');
                $('.nx-popup-backdrop').removeClass('show');
                $('.nx-popup-wrapper').removeClass('show');

            });

            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script>
@endsection
