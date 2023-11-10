@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
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
    {{__('All Applicant')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    @include('backend/partials/message')
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <h4 class="header-title">{{__('All Applicant')}}</h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value="">{{{__('Bulk Action')}}}</option>
                                                <option value="delete">{{{__('Delete')}}}</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Job Title')}}</th>
                                                <th>{{__('Job Position')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_applicant as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{!empty($data->job) ? optional($data->job)->title : __('This job is not available or delete')}}</td>
                                                    <td>{{!empty($data->job) ? optional($data->job)->position : __('This job is not available or delete')}}</td>
                                                    <td>{{date_format($data->created_at,'d M Y h:i:sA')}}</td>
                                                    @php
                                                        $all_data = [
                                                                'job_title' => !empty($data->job) ? $data->job->title : __('This job is not available or delete'),
                                                                'applicant_name' => $data->name,
                                                                'applicant_email' => $data->email,
                                                            ];
                                                        $all_data['form_content'] = unserialize($data->form_content);
                                                        //if application fee applicable
                                                        if($data->application_fee > 0){
                                                            $all_data['application_fee'] = amount_with_currency_symbol($data->application_fee);
                                                            $all_data['payment_gateway'] = $data->payment_gateway;
                                                            $all_data['payment_status'] = $data->payment_status;
                                                            $all_data['transaction_id'] = $data->transaction_id;
                                                        }
                                                        $all_data['attachment'] = unserialize($data->attachment);
                                                    @endphp

                                                    <td>
                                                         <x-delete-popover :url="route('admin.jobs.applicant.delete',$data->id)"/>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#view_order_details_modal"
                                                           data-alldata="{{json_encode($all_data)}}"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 view_order_details_btn"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#send_mail_modal"
                                                           data-id="{{$data->id}}"
                                                           data-name="{{$data->email}}"
                                                           data-email="{{$data->name}}"
                                                           class="btn btn-xs btn-info btn-sm mb-3 mr-1 send_mail_btn"
                                                        >
                                                            <i class="ti-email"></i>
                                                        </a>

                                                        @if(!empty($data->manual_payment_attachment))
                                                            <a class="btn btn-success btn-xs mb-3" href="{{url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''}}" target="_blank">
                                                                {{__('View Attachment')}}
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_order_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="view-order-details-info">
                   <h4 class="title">{{__('View Applicant Information')}}</h4>
                   <div class="view-order-top-wrap">
                       <div class="data-wrap">
                           {{__('Apply Date')}}: <span class="order-date-span"></span>
                       </div>
                   </div>
                   <div class="table-responsive">
                       <table class="order-all-custom-fields table-striped table-bordered"></table>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send_mail_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Send Mail To Applicant')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>

                <form action="{{route('admin.jobs.applicant.mail')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="applicant_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" readonly name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control" readonly name="email">
                        </div>
                        <div class="form-group">
                            <label for="Subject">{{__('Subject')}}</label>
                            <input type="text" class="form-control" name="subject" >
                        </div>
                        <div class="form-group">
                            <label>{{__('Message')}}</label>
                            <input type="hidden" name="message">
                            <div class="summernote"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Send Mail')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>


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
                        'url' : "{{route('admin.jobs.applicant.bulk.delete')}}",
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

            $(document).on('click','.view_order_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data('alldata');
                var parent = $('#view_order_details_modal');

                    console.log(allData);

                parent.find('.order-date-span').text(allData.date);
                parent.find('.order-all-custom-fields').html('');
                $.each(allData,function (index,value) {
                    if (index != 'form_content' && index != 'attachment'){
                    parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('_',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                    }
                });
                if(allData.form_content){
                    $.each(allData.form_content,function (index,value) {
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('-',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                    });
                }
                if(allData.attachment){
                    $.each(allData.attachment,function (index,value) {
                        var attname = value.substr(36);
                        parent.find('.order-all-custom-fields').append('<tr class="attachment_list"><td class="fname">'+index.replace('-',' ')+'</td><td class="fvalue"><a href="{{url('/')}}'+'/'+value+'" download>'+attname+'</a></td></tr>');
                    });
                }
            })

            $('#all_user_table').DataTable( {
                "order": [[1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            $(document).on('click','.send_mail_btn',function(){
                var el = $(this);
                var email = el.data('email');
                var name = el.data('name');
                var id = el.data('id');
                var modalContainerId = $('#send_mail_modal form');

                modalContainerId.find('input[name="name"]').val(name);
                modalContainerId.find('input[name="email"]').val(email);
                modalContainerId.find('input[name="applicant_id"]').val(id);
            });

        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection

