@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Login')}}
@endsection
@section('content')
<section class="login-page-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form-wrapper">
                    <h2>{{__('Login To Your Account')}}</h2>
                    <x-error-msg/>
                    <x-flash-msg/>
                    <form action="{{route('user.login')}}" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
                        @csrf
                        <div class="error-wrap"></div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                        </div>
                        <div class="form-group btn-wrapper">
                            <button type="submit" id="login_btn" class="submit-btn">{{__('Login')}}</button>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a class="d-block" href="{{route('user.register')}}">{{__('Create New account?')}}</a>
                                <a href="{{route('user.forget.password')}}">{{__('Forgot Password?')}}</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="social-login-wrap">
                                @if(get_static_option('enable_facebook_login'))
                                    <a href="{{route('login.facebook.redirect')}}" class="facebook"><i class="fab fa-facebook-f"></i> {{__('Login With Facebook')}}</a>
                                @endif
                                @if(get_static_option('enable_google_login'))
                                    <a href="{{route('login.google.redirect')}}" class="google"><i class="fab fa-google"></i> {{__('Login With Google')}}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#login_btn', function (e) {
            e.preventDefault();
            var formContainer = $('#login_form_order_page');
            var el = $(this);
            var username = formContainer.find('input[name="username"]').val();
            var password = formContainer.find('input[name="password"]').val();
            var remember = formContainer.find('input[name="remember"]').val();

            el.text('{{__("Please Wait")}}');

            $.ajax({
                type: 'post',
                url: "{{route('user.ajax.login')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    username : username,
                    password : password,
                    remember : remember,
                },
                success: function (data){
                    if(data.status == 'invalid'){
                        el.text('{{__("Login")}}')
                        formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                    }else{
                        formContainer.find('.error-wrap').html('');
                        el.text('{{__("Login Success.. Redirecting ..")}}');
                        location.reload();
                    }
                },
                error: function (data){
                    var response = data.responseJSON.errors;
                    console.log(response)
                    formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                    $.each(response,function (value,index){
                        formContainer.find('.error-wrap ul').append('<li>'+index+'</li>');
                    });
                    el.text('{{__("Login")}}');
                }
            });
        });
    </script>
@endsection
