@extends('backend.admin-master')
@section('site-title')
    {{__('Knowledgebase Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Knowledgebase Page Settings")}}</h4>
                        <form action="{{route('admin.knowledge.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_knoeledgebase_post_items">{{__('Knowledgebase Topics')}}</label>
                                <input type="text" class="form-control" name="site_knoeledgebase_post_items" id="site_knoeledgebase_post_items" value="{{get_static_option('site_knoeledgebase_post_items')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
