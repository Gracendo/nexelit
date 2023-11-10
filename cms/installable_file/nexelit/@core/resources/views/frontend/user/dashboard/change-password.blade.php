@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="dashboard-form-wrapper">
        <h2 class="title">{{__('Change Password')}}</h2>
        <form action="{{route('user.password.change')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="old_password">{{__('Old Password')}}</label>
                <input type="password" class="form-control" id="old_password" name="old_password"
                       placeholder="{{__('Old Password')}}">
            </div>
            <div class="form-group">
                <label for="password">{{__('New Password')}}</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="{{__('New Password')}}">
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{__('Confirm Password')}}</label>
                <input type="password" class="form-control" id="password_confirmation"
                       name="password_confirmation" placeholder="{{__('Confirm Password')}}">
            </div>
            <button type="submit" class="submit-btn dash-btn width-200">{{__('Save changes')}}</button>
        </form>
    </div>
@endsection