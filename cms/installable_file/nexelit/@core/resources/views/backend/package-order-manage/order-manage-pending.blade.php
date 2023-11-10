@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
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
    {{__('All Pending Orders')}}
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
                                   <x-flash-msg/>
                                   <x-error-msg/>
                                    <h4 class="header-title">{{__('All Pending Orders')}}</h4>
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
                                                <th style="max-width: 50px;" class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Package Name')}}</th>
                                                <th>{{__('Package Price')}}</th>
                                                <th>{{__('Payment Status')}}</th>
                                                <th>{{__('Order Status')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_orders as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->package_name}}</td>
                                                    <td>{{amount_with_currency_symbol($data->package_price)}}</td>
                                                    <td>
                                                        @if($data->payment_status == 'pending')
                                                            <span class="alert alert-warning text-capitalize">{{__($data->payment_status)}}</span>
                                                        @else
                                                            <span class="alert alert-success text-capitalize">{{__($data->payment_status)}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->status === 'pending')
                                                            <span class="alert alert-warning text-capitalize">{{__($data->status)}}</span>
                                                        @elseif($data->status === 'cancel')
                                                            <span class="alert alert-danger text-capitalize">{{__($data->status)}}</span>
                                                        @elseif($data->status === 'in_progress')
                                                            <span class="alert alert-info text-capitalize">{{__($data->status)}}</span>
                                                        @else
                                                            <span class="alert alert-success text-capitalize">{{__($data->status)}}</span>
                                                        @endif
                                                    </td>
                                                    @php
                                                        $all_custom_fields = [];
                                                        $all_custom_fields_un = unserialize($data->custom_fields);
                                                        $all_custom_fields = json_encode($all_custom_fields_un);
                                                    @endphp
                                                    <td>{{date_format($data->created_at,'d M Y')}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.package.order.manage.delete',$data->id)"/>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#user_edit_modal"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 user_edit_btn"
                                                        >
                                                            <i class="ti-email"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#view_order_details_modal"
                                                           data-status="{{$data->status}}"
                                                           data-paystatus="{{$data->payment_status}}"
                                                           data-packageid="{{$data->package_id}}"
                                                           data-packageprice="{{$data->package_price}}"
                                                           data-packagename="{{$data->package_name}}"
                                                           data-customfield="{{$all_custom_fields}}"
                                                           data-date="{{date_format($data->created_at,'d M Y')}}"
                                                           data-attachment="{{json_encode(unserialize($data->attachment))}}"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 view_order_details_btn"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-id="{{$data->id}}"
                                                           data-status="{{$data->status}}"
                                                           data-toggle="modal"
                                                           data-target="#order_status_change_modal"
                                                           class="btn btn-xs btn-info btn-sm mb-3 mr-1 order_status_change_btn"
                                                        >
                                                            {{__("Update Status")}}
                                                        </a>

                                                        @if(!empty(optional($data->paymentlog)->manual_payment_attachment))
                                                            <a class="btn btn-success btn-xs my-2" href="{{url('assets/uploads/attachment/'.optional($data->paymentlog)->manual_payment_attachment) ?? ''}}" target="_blank">{{__('View Attachment')}}</a>
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
                    <h4 class="title">{{__('View Order Details Information')}}</h4>
                    <div class="view-order-top-wrap">
                        <div class="status-wrap">
                            {{__('Order Status:')}} <span class="order-status-span"></span>
                        </div>
                        <div class="data-wrap">
                           {{__(' Order Date:')}} <span class="order-date-span"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="order-all-custom-fields table-striped table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Send Mail To Order Sender')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>

                <form action="{{route('admin.package.order.manage.send.mail')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{__('Enter name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="form-group">
                            <label for="Subject">{{__('Subject')}}</label>
                            <input type="text" class="form-control" name="subject" value="{{__('Your order Replay From {site}')}}">
                            <small class="info-text">{{__('{site} will be replaced by site title')}}</small>
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

    <div class="modal fade" id="order_status_change_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('order Status Change')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('admin.package.order.manage.change.status')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="form-group">
                            <label for="order_status">{{__('order Status')}}</label>
                            <select name="order_status" class="form-control" id="order_status">
                                <option value="pending">{{__('Pending')}}</option>
                                <option value="in_progress">{{__('In Progress')}}</option>
                                <option value="cancel">{{__('Cancel')}}</option>
                                <option value="complete">{{__('Complete')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Status')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
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
                        'url' : "{{route('admin.package.order.bulk.action')}}",
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
                var allChek = $('.bulk-checkbox');
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });



            $(document).on('click','.view_order_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_order_details_modal');
                var statusClass = allData.status == 'pending' ? 'alert alert-warning' : 'alert alert-success';

                parent.find('.order-status-span').text(allData.status).addClass(statusClass);
                parent.find('.order-date-span').text(allData.date);
                parent.find('.order-all-custom-fields').html('');
                $.each(allData.customfield,function (index,value) {
                    if(index == 'package'){
                        var paymentStatusClass = allData.paystatus == 'pending' ? 'alert alert-warning' : 'alert alert-success';
                        var curSymbol = "{{site_currency_symbol()}}";
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Package ID</td> <td class="fvalue">'+value+'</td></tr>');
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Package Name</td> <td class="fvalue">'+allData.packagename+'</td></tr>');
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Package Price</td> <td class="fvalue">'+curSymbol+allData.packageprice+'</td></tr>');
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Payment Status</td> <td class="fvalue"><span class="'+paymentStatusClass+' text-capitalize">'+allData.paystatus+'</span></td></tr>');
                    }else if(index == 'selected_payment_gateway'){
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Payment Gateway</td> <td class="fvalue">'+value+'</td></tr>');
                    }
                    else if(index == 'checkout_type'){
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">Checkout Type</td> <td class="fvalue">Guest</td></tr>');
                    }
                    else{
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('-',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                    }
                });

                if(allData.attachment){
                    $.each(allData.attachment,function (index,value) {
                        parent.find('.order-all-custom-fields tbody').append('<tr class="attachment_list"><td class="fname">'+index.replace('-',' ')+'</td><td class="fvalue"><a href="'+value+'" download>'+value.substr(26)+'</a></td></tr>');
                    });
                }
            })
            $(document).on('click','.order_status_change_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#order_status_change_modal');
                form.find('#order_id').val(el.data('id'));
                form.find('#order_status option[value="'+el.data('status')+'"]').attr('selected',true);
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
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

        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection

