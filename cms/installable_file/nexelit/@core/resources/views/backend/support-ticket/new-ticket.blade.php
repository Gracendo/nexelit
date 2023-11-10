@extends('backend.admin-master')
@section('site-title')
    {{__('New Ticket')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <x-error-msg/>
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__("New Ticket")}}</h4>
                            <a href="{{route('admin.support.ticket.all')}}" class="btn btn-primary">{{__('All Support Tickets')}}</a>
                        </div>

                        <form action="{{route('admin.support.ticket.new')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Title')}}</label>
                                <input type="text" class="form-control" name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('Subject')}}</label>
                                <input type="text" class="form-control" name="subject" placeholder="{{__('Subject')}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('Priority')}}</label>
                                <select name="priority" class="form-control">
                                    <option value="low">{{__('Low')}}</option>
                                    <option value="medium">{{__('Medium')}}</option>
                                    <option value="high">{{__('High')}}</option>
                                    <option value="urgent">{{__('Urgent')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('Departments')}}</label>
                                <select name="departments" class="form-control">
                                    @foreach($departments as $dep)
                                    <option value="{{$dep->id}}">{{$dep->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('User')}}</label>
                                <select name="user_id" class="form-control nice-select wide">
                                    @foreach($all_users as $user)
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea name="description"class="form-control" cols="30" rows="10" placeholder="{{__('Description')}}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit Ticket')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var $selector = $('.nice-select');
            if($selector.length > 0){
                $selector.niceSelect();
            }
        });
    </script>
@endsection
