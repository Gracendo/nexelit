@extends('backend.admin-master')
@section('site-title')
    {{__('Product Coupon')}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
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
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
               <x-flash-msg/>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Product Coupon')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                          <div class="table-wrap table-responsive">
                                <table class="table table-default">
                                    <thead>
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Code')}}</th>
                                    <th>{{__('Discount')}}</th>
                                    <th>{{__('Expire Date')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($all_product_coupon as $data)
                                        <tr>
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                </div>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->code}}</td>
                                            <td>@if($data->discount_type == 'percentage') {{$data->discount}}% @else {{amount_with_currency_symbol($data->discount)}} @endif</td>
                                            <td>{{date('d M Y',strtotime($data->expire_date))}}</td>
                                            <td>
                                                @if('publish' == $data->status)
                                                    <span class="btn btn-success btn-xs">{{ucfirst($data->status)}}</span>
                                                @else
                                                    <span class="btn btn-warning btn-xs">{{ucfirst($data->status)}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <x-delete-popover :url="route('admin.products.coupon.delete',$data->id)"/>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#category_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 category_edit_btn"
                                                   data-id="{{$data->id}}"
                                                   data-code="{{$data->code}}"
                                                   data-discount="{{$data->discount}}"
                                                   data-discount_type="{{$data->discount_type}}"
                                                   data-expire_date="{{$data->expire_date}}"
                                                   data-status="{{$data->status}}"
                                                >
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Coupon')}}</h4>
                        <form action="{{route('admin.products.coupon.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{__('Coupon Code')}}</label>
                                <input type="text" class="form-control"  id="code" name="code" placeholder="{{__('Code')}}">
                            </div>
                            <div class="form-group">
                                <label for="discount">{{__('Discount')}}</label>
                                <input type="text" class="form-control"  id="discount" name="discount" placeholder="{{__('Discount')}}">
                            </div>
                            <div class="form-group">
                                <label for="discount_type">{{__('Coupon Type')}}</label>
                                <select name="discount_type" class="form-control" id="discount_type">
                                    <option value="percentage">{{__("Percentage")}}</option>
                                    <option value="amount">{{__("Amount")}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expire_date">{{__('Expire Date')}}</label>
                                <input type="date" class="form-control datepicker"  id="expire_date" name="expire_date" placeholder="{{__('Expire Date')}}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish">{{__("Publish")}}</option>
                                    <option value="draft">{{__("Draft")}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Coupon')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Coupon')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.products.coupon.update')}}"  method="post">
                    <input type="hidden" name="id" id="coupon_id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_code">{{__('Coupon Code')}}</label>
                            <input type="text" class="form-control"  id="edit_code" name="code" placeholder="{{__('Code')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount">{{__('Discount')}}</label>
                            <input type="text" class="form-control"  id="edit_discount" name="discount" placeholder="{{__('Discount')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type">{{__('Coupon Type')}}</label>
                            <select name="discount_type" class="form-control" id="edit_discount_type">
                                <option value="percentage">{{__("Percentage")}}</option>
                                <option value="amount">{{__("Amount")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date">{{__('Expire Date')}}</label>
                            <input type="date" class="form-control datepicker"  id="edit_expire_date" name="expire_date" placeholder="{{__('Expire Date')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="draft">{{__("Draft")}}</option>
                                <option value="publish">{{__("Publish")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {

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
                        'url' : "{{route('admin.products.coupon.bulk.action')}}",
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

            $(document).on('click','.category_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('#coupon_id').val(id);
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_code').val(el.data('code'));
                modal.find('#edit_discount').val(el.data('discount'));
                modal.find('#edit_discount_type').val(el.data('discount_type'));
                modal.find('#edit_expire_date').val(el.data('expire_date'));
                modal.find('#edit_discount_type[value="'+el.data('discount_type')+'"]').attr('selected',true);
            });
        });
    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

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
