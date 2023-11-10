@extends('backend.admin-master')
@section('site-title')
    {{__('Product Tax Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Product Tax Settings")}}</h4>
                        <form action="{{route('admin.products.tax.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_tax"><strong>{{__('Enable Tax Option')}}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="product_tax"  @if(!empty(get_static_option('product_tax'))) checked @endif >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_system">{{__('Tax Type')}}</label>
                                <select name="product_tax_system" class="form-control">
                                    <option @if(get_static_option('product_tax_system') == 'inclusive') selected @endif value="inclusive">{{__('Inclusive')}}</option>
                                    <option @if(get_static_option('product_tax_system') == 'exclusive') selected @endif value="exclusive">{{__('Exclusive')}}</option>
                                </select>
                                <small class="help-info">{{__('if you select inclusive tax system, it will not show an in frontend. it just add a notice in order success mail.')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_type">{{__('Tax Calculate Type')}}</label>
                                <select name="product_tax_type" class="form-control">
                                    <option @if(get_static_option('product_tax_type') == 'individual') selected @endif value="individual">{{__('Individual')}}</option>
                                    <option @if(get_static_option('product_tax_type') == 'total') selected @endif value="total">{{__('On Total Amount')}}</option>
                                </select>
                                <small class="help-info">{{__('if you select individual, you have to set tax percentage in every product. if you select total, then it will add tax on total amount of cart after coupon ( if coupon applied )')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_percentage">{{__('Tax Rate')}}</label>
                                <input type="number" name="product_tax_percentage"  class="form-control" value="{{get_static_option('product_tax_percentage')}}" >
                                <small class="help-info">{{__('it will be counted as percentage')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
