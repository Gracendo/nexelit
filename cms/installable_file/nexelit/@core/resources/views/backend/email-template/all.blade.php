@extends('backend.admin-master')
@section('style')
    @include('backend.partials.datatable.style-enqueue')
@endsection
@section('site-title')
    {{__('All Email Templates')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Email Templates')}}</h4>
                         <div class="table-wrap table-responsive">
                            <table class="table table-default" >
                                <thead>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{__('Admin reset password')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.admin.password.reset')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('User reset password')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.user.password.reset')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('User Verify Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.user.email.verify')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Newsletter Verify Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.newsletter.verify')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Course Enroll Admin Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.course.enroll.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Course Enroll User Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.course.enroll.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Course Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.course.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Course Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.course.reminder.mail')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Appointment Booking Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.appointment.booking.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Appointment Booking User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.appointment.booking.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Appointment Booking Update Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.appointment.booking.update')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Appointment Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.appointment.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Appointment Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.appointment.reminder.mail')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Quote Submission Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.quote.admin.mail')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Package Order Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.package.order.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Package Order Mail To User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.package.order.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Package Order Status Change Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.package.order.status.change')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Package Order Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.package.order.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Package Order Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.package.order.reminder.mail')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Job Application Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.job.application.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Job Application Mail To User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.job.application.user')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Event Booking Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.event.attendance.mail.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Event Booking Mail To User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.event.attendance.mail.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Event Booking Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.event.attendance.mail.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Event Booking Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.event.attendance.mail.reminder.mail')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Product Order Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.product.order.mail.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Product Order Mail To User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.product.order.mail.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Product Order Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.product.order.mail.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Product Order Status Change Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.product.order.status.change.mail')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Product Order Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.product.order.mail.reminder.mail')"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Donation Mail To Admin')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.donation.mail.admin')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Donation Mail To User')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.donation.mail.user')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Donation Payment Accept Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.donation.mail.payment.accept')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Donation Reminder Mail')}}</td>
                                        <td>
                                            <x-edit-icon :url="route('admin.email.template.donation.mail.reminder.mail')"/>
                                        </td>
                                    </tr>


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
    @include('backend.partials.datatable.script-enqueue')
@endsection
