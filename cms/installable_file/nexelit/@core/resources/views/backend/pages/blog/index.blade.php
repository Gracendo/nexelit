@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
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
@endsection
@section('site-title')
    {{__('Blog Page')}}
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
                       <div class="header-wrap d-flex align-content-center justify-content-between">
                           <div class="left-wrap">
                               <h4 class="header-title">{{__('All Blog Items')}}</h4>
                               <div class="bulk-delete-wrapper">
                                   <div class="select-box-wrap">
                                       <select name="bulk_option" id="bulk_option">
                                           <option value="">{{{__('Bulk Action')}}}</option>
                                           <option value="delete">{{{__('Delete')}}}</option>
                                       </select>
                                       <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                   </div>
                               </div>
                           </div>
                           <div class="right-wrap">
                               <a href="{{route('admin.blog.new')}}" class="btn btn-primary">{{__('Create New Blog')}}</a>
                           </div>
                       </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_blog as $key => $blog)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_blog as $key => $blog)
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
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Author')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($blog as $data)
                                            <tr>
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                    </div>
                                                </td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}} @if(!empty($data->breaking_news === 1))<small class="breaking-news">{{__('Breaking News')}}</small>@endif @if(!empty($data->video_url))<small class="video">{{__('Video')}}</small>@endif</td>
                                                <td>
                                                    @php
                                                        $blog_img = get_attachment_image_by_id($data->image,null,true);
                                                    @endphp
                                                    @if (!empty($blog_img))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="{{$blog_img['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$data->author}}</td>
                                                <td>
                                                @if(!empty($data->blog_categories_id))
                                                        {{get_blog_category_by_id($data->blog_categories_id)}}
                                                @endif
                                                </td>
                                                <td>
                                                    @if($data->status == 'draft')
                                                        <span class="alert alert-warning" style="margin-top: 20px;display: inline-block;">{{__('Draft')}}</span>
                                                    @else
                                                        <span class="alert alert-success" style="margin-top: 20px;display: inline-block;">{{__('Publish')}}</span>
                                                    @endif
                                                </td>
                                                <td>{{date_format($data->created_at,'d M Y')}}</td>
                                                <td>
                                                    <x-delete-popover :url="route('admin.blog.delete',$data->id)"/>
                                                   
                                                    <a class="btn btn-xs btn-primary btn-xs mb-3 mr-1" href="{{route('admin.blog.edit',$data->id)}}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-xs btn-primary btn-xs mb-3 mr-1" target="_blank" href="{{route('frontend.blog.single', $data->slug)}}">
                                                        <i class="ti-eye"></i>
                                                    </a>
                                                    <form action="{{route('admin.blog.clone')}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        <input type="hidden" name="item_id" value="{{$data->id}}">
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
@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
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
                        'url' : "{{route('admin.blog.bulk.action')}}",
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
