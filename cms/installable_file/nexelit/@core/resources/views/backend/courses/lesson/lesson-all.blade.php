@extends('backend.admin-master')
@section('site-title')
    {{__('All Lessons')}}
@endsection
@section('style')
    @include('backend.partials.datatable.style-enqueue')
    @include('backend.partials.media-upload.style')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="top-wrapp d-flex justify-content-between">
                            <div class="left-part">
                                <h4 class="header-title">{{__('All Lessons')}}</h4>
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
                                <th>{{__('Title')}}</th>
                                <th>{{__('Course Title')}}</th>
                                <th>{{__('Curriculum Title')}}</th>
                                <th>{{__('Preview')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_lesson as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional($data->lang)->title ?? __('Untitled')}}</td>
                                        <td>
                                            {{optional($data->course)->title}}
                                        </td>
                                        <td>{{optional($data->curriculum)->title}}</td>
                                        <td>
                                            @if($data->preview)
                                            <x-status-span :status="$data->preview"/>
                                            @else
                                                <span class="alert alert-warning">{{__('No')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                           <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.courses.lesson.delete',$data->id)"/>
                                            <x-edit-icon :url="route('admin.courses.lesson.edit',$data->id)"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.partials.bulk-action',['action' => route('admin.courses.bulk.action')])
    @include('backend.partials.datatable.script-enqueue')
@endsection
