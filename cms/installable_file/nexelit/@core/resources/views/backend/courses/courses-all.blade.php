@extends('backend.admin-master')
@section('site-title')
    {{__('Courses')}}
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
                                <h4 class="header-title">{{__('All Courses')}}</h4>
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
                            <div class="btn-wrapper"><a href="{{route('admin.courses.new')}}" class="btn btn-primary">{{__('New Course')}}</a></div>
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
                                <th>{{__('Image')}}</th>
                                <th>{{__('Instructor')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_courses as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional($data->lang)->title ?? __('Untitled')}}</td>
                                        <td>
                                            <div class="img-wrap">
                                                @php
                                                    $event_img = get_attachment_image_by_id($data->image,'thumbnail',true);
                                                @endphp
                                                @if (!empty($event_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                     src="{{$event_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{optional($data->instructor)->name}}</td>
                                        <td>{{optional(optional($data->category)->lang)->title ?? __('Uncategorized')}}</td>
                                        <td>
                                           <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.courses.delete',$data->id)"/>
                                            <x-edit-icon :url="route('admin.courses.edit',$data->id)"/>
                                            <x-view-icon :url="route('frontend.course.single',['slug'=> optional($data->lang)->slug,'id' => $data->id])"/>
                                            <x-backend.clone-icon :url="route('admin.courses.clone')" :id="$data->id"/>
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
