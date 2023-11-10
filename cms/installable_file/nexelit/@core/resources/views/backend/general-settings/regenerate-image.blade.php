@extends('backend.admin-master')
@section('site-title')
    {{__('Regenerate Image Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Regenerate Image Settings")}}</h4>
                       <div class="message-wrap"></div>
                        <button type="button" class="btn btn-primary mt-4 pr-4 pl-4 regenarate_image">{{__('Regenerate Images')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click','.regenarate_image',function (){
            $(this).attr('disabled',true);
            $('.message-wrap').html('<p class="alert alert-warning">{{__('it may take few minutes to complete the process...')}}</p>');
            $(this).append('<i class="fas fa-spinner fa-spin"></i>')
           $.ajax({
               type : 'post',
               url: "{{route('admin.general.regenerate.thumbnail')}}",
               data :{
                   _token: "{{csrf_token()}}"
               },
               success: function (data){
                   $('.message-wrap').html('<p class="alert alert-'+data.type+'">'+data.msg+'</p>');
                   $('.regenarate_image i').remove();
                   $('.regenarate_image').attr('disabled',false);
               },
               error: function (res){

               }
           })
        });
    </script>
@endsection
