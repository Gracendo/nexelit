@extends('backend.admin-master')
@section('site-title')
    {{__('Update Script')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Update Script")}}</h4>
                        <p class="info-text">{{__('you can check script update from here and able update the script from here.')}}</p>
                        <div class="progress-msg-show"></div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="check_update_status">{{__('Check Update')}}</button>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="run_the_update_now">{{__('Run Update')}}</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                //check update status

                $(document).on('click','#check_update_status',function (e) {
                    e.preventDefault();
                    alert('update checking');
                });

                $(document).on('click','#run_the_update_now',function (e) {
                    e.preventDefault();
                    alert('run the update now');
                });


            });
        }(jQuery));
    </script>
@endsection
