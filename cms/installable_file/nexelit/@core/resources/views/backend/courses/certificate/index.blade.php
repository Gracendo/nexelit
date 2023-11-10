@extends('backend.admin-master')
@section('site-title')
    {{__('Courses Certificates')}}
@endsection
@section('style')
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="top-wrapp d-flex justify-content-between">
                            <div class="left-part">
                                <h4 class="header-title">{{__('All Certificates')}}</h4>
                                <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">{{{__('Bulk Action')}}}</option>
                                            <option value="delete">{{{__('Delete')}}}</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                    </div>
                                </div>
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
                                <th>{{__('Course Title')}}</th>
                                <th>{{__('Student Name')}}</th>
                                <th>{{__('Student Email')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_certificates as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional(optional($data->course)->lang)->title ?? __('Untitled')}}</td>
                                        <td>{{optional($data->user)->name}} ({{optional($data->user)->username}})</td>
                                        <td>{{optional($data->user)->email}}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.courses.certificate.delete',$data->id)"/>
                                            @if($data->status === 0)
                                                <form method="post" action="{{route('admin.course.certificate.approve')}}">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{$data->course_id}}"/>
                                                    <input type="hidden" name="user_id" value="{{$data->user_id}}" />
                                                    <button type="submit" class="btn btn-warning">{{__('Approve')}}</button>
                                                </form>
                                            @else
                                                <a href="{{route('admin.courses.certificate.download',$data->id)}}" class="btn btn-success">{{__('Download Certificate')}}</a>
                                            @endif
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
    @include('backend.partials.bulk-action',['action' => route('admin.course.certificate.bulk.action')])
    @include('backend.partials.datatable.script-enqueue')
@endsection
