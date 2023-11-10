@extends('backend.admin-master')
@section('site-title')
    {{__('Package Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <x-error-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Package Settings")}}</h4>
                        <form action="{{route('admin.package.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="disable_guest_mode_for_package_module"><strong>{{__('Enable/Disable Guest Checkout')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="disable_guest_mode_for_package_module"  @if(!empty(get_static_option('disable_guest_mode_for_package_module'))) checked @endif >
                                    <span class="slider onff"></span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
