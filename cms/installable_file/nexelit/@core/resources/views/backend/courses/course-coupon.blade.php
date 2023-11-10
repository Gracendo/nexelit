@extends('backend.admin-master')
@section('site-title')
    {{__('Courses Coupon')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
    @include('backend.partials.datatable.style-enqueue')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Courses Coupon')}}</h4>
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
                                    @foreach($all_coupon as $data)
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
                                            <!-- -->
                                            <td>
                                               <x-delete-popover :url="route('admin.courses.coupon.delete',$data->id)"/>
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
                        <form action="{{route('admin.courses.coupon.store')}}" method="post" enctype="multipart/form-data">
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
                <form action="{{route('admin.courses.coupon.update')}}"  method="post">
                    <input type="hidden" name="id" >
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_code">{{__('Coupon Code')}}</label>
                            <input type="text" class="form-control"   name="code" placeholder="{{__('Code')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount">{{__('Discount')}}</label>
                            <input type="text" class="form-control"   name="discount" placeholder="{{__('Discount')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type">{{__('Coupon Type')}}</label>
                            <select name="discount_type" class="form-control" >
                                <option value="percentage">{{__("Percentage")}}</option>
                                <option value="amount">{{__("Amount")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date">{{__('Expire Date')}}</label>
                            <input type="date" class="form-control datepicker" name="expire_date" placeholder="{{__('Expire Date')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" >
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
    @include('backend.partials.bulk-action',['action' => route('admin.courses.coupon.bulk.action')])
    @include('backend.partials.datatable.script-enqueue')
    <script>
        $(document).ready(function () {

            $(document).on('click','.category_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('input[name="id"]').val(id);
                modal.find('select[name="status"] option[value="'+status+'"]').prop('selected',true);
                modal.find('input[name="code"]').val(el.data('code'));
                modal.find('input[name="discount"]').val(el.data('discount'));
                modal.find('input[name="expire_date"]').val(el.data('expire_date'));
                modal.find('select[name="discount_type"] option[value="'+el.data('discount_type')+'"]').prop('selected',true);
            });
        });
    </script>

@endsection
