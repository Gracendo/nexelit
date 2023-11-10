@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('site-title')
    {{__('All Admin Role')}}
@endsection
@section('content')

@php
    $all_permission_list = array(
        "Video Gallery",
        "Admin Manage",
        "About Page Manage",
        "Users Manage",
        "Quote Manage",
        "Newsletter Manage",
        "Package Orders Manage",
        "All Payment Logs",
        "Pages Manage",
        "Menus Manage",
        "Widgets Manage",
        "Popup Builder",
        "Form Builder",
        "Blogs Manage",
        "Job Post Manage",
        "Events Manage",
        "Products Manage",
        "Donations Manage",
        "Knowledgebase",
        "Home Variant",
        "Topbar Settings",
        "Home Page Manage",
        "Contact Page Manage",
        "Feedback Page Manage",
        "Services",
        "Case Study",
        "Gallery Page",
        "404 Page Manage",
        "Faq",
        "Brand Logos",
        "Price Plan",
        "Team Members",
        "Testimonial",
        "Counterup",
        "General Settings",
        "Languages",
        "Courses Manage",
        "Appointment Manage",
        "Support Tickets",
        "Email Templates",
    );
@endphp

    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend/partials/message')
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Admin Role')}}</h4>
                        <div class="data-tables datatable-primary">
                            <table id="all_user_table" class="table table-default">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th>{{__('Permissions')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_role as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>
                                               <div class="permission-show">
                                                   @php $all_per = json_decode($data->permission); @endphp
                                                   @foreach($all_per as $per)
                                                       <span class="text text-success">{{ucwords(str_replace('_',' ',$per))}}</span>
                                                   @endforeach
                                               </div>
                                            </td>
                                            <td>
                                                <x-delete-popover :url="route('admin.user.role.delete',$data->id)"/>
                                                <a href="#"
                                                   data-id="{{$data->id}}"
                                                   data-name="{{$data->name}}"
                                                   data-permission="{{$data->permission}}"
                                                   data-toggle="modal"
                                                   data-target="#user_edit_modal"
                                                   class="btn btn-xs btn-primary btn-sm mb-3 mr-1 user_edit_btn"
                                                >
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6  mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Admin Role')}}</h4>

                       <x-error-msg/>
                        <form action="{{route('admin.all.user.role')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Role Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter Role name')}}">
                            </div>
                            <div class="form-group">
                                <label for="permission">{{__('Permissions')}}</label>
                                <select name="permission[]" multiple id="permission" class="form-control nice-select wide">
                                    @foreach($all_permission_list as $per)
                                    <option value="{{strtolower(str_replace(' ','_',$per))}}">{{$per}}</option>
                                    @endforeach
                                </select>
                                <div class="info-text">{{__('assign permission to role, which page can seen by the this role')}}</div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Role')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Admin Role Edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.user.role.edit')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="admin_role_id" id="admin_role_id">
                        @csrf
                        <div class="form-group">
                            <label for="edit_name">{{__('Role Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name" name="name" placeholder="{{__('Enter Role name')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_permission">{{__('Permissions')}}</label>
                            <select name="permission[]" multiple id="edit_permission" class="form-control nice-select wide">
                                @foreach($all_permission_list as $per)
                                    <option value="{{strtolower(str_replace(' ','_',$per))}}">{{$per}}</option>
                                @endforeach
                            </select>
                            <div class="info-text">{{__('assign permission to role, which page can seen by the this role')}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $(document).on('click','.user_edit_btn',function(){
                var el = $(this);
                var form = $('#user_edit_modal_form');
                var permission = el.data('permission');
                form.find('#admin_role_id').val(el.data('id'));
                form.find('#edit_name').val(el.data('name'));
                $.each(permission,function (index,value) {
                form.find('#edit_permission option[value="'+value+'"]').attr('selected',true);
                });
                $('#edit_permission').niceSelect('update');
            });

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
        });
    </script>
@endsection
