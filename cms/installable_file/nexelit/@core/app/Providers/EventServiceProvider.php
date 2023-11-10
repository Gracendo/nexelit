<?php

namespace App\Providers;

use App\Events\AppointmentBooking;
use App\Events\CourseEnrollSuccess;
use App\Listeners\AppointmentBookingDatabaseUpdate;
use App\Listeners\AppointmentBookingSuccessMailSend;
use App\Listeners\CourseEnrollDatabaseUpdate;
use App\Listeners\CourseEnrollSuccessMailSend;
use App\Listeners\PakcagesOrderSuccessMailSendUser;
use App\Listeners\PakcagesOrderDatabaseUpdate;
use App\Listeners\PakcagesOrderSuccessMailSendAdmin;
use App\Listeners\JobApplicationSuccessMailSendUser;
use App\Listeners\JobApplicationSuccessMailSendAdmin;
use App\Listeners\JobApplicationDatabaseUpdate;
use App\Listeners\AttendanceBookingSuccessMailSendAdmin;
use App\Listeners\AttendanceBookingSuccessMailSendUser;
use App\Listeners\AttendanceBookingDatabaseUpdate;
use App\Listeners\ProductOrderSuccessMailSend;
use App\Listeners\ProductOrderDatabaseUpdate;
use App\Listeners\DonationSuccessMailSend;
use App\Listeners\DonationDatabaseUpdate;
use App\Listeners\SupportSendMailToAdmin;
use App\Listeners\SupportSendMailToUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SupportMessage;
use App\Events\DonationSuccess;
use App\Events\ProductOrders;
use App\Events\AttendanceBooking;
use App\Events\JobApplication;
use App\Events\PackagesOrderSuccess;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SupportMessage::class => [
            SupportSendMailToAdmin::class,
            SupportSendMailToUser::class
        ],
        DonationSuccess::class => [
            DonationDatabaseUpdate::class,
            DonationSuccessMailSend::class
        ],
        ProductOrders::class => [
            ProductOrderDatabaseUpdate::class,
            ProductOrderSuccessMailSend::class
        ],
        AttendanceBooking::class => [
            AttendanceBookingDatabaseUpdate::class,
            AttendanceBookingSuccessMailSendAdmin::class,
            AttendanceBookingSuccessMailSendUser::class
        ],
        JobApplication::class => [
            JobApplicationDatabaseUpdate::class,
            JobApplicationSuccessMailSendAdmin::class,
            JobApplicationSuccessMailSendUser::class
        ],
        PackagesOrderSuccess::class => [
            PakcagesOrderDatabaseUpdate::class,
            PakcagesOrderSuccessMailSendAdmin::class,
            PakcagesOrderSuccessMailSendUser::class
        ],

        AppointmentBooking::class => [
            AppointmentBookingDatabaseUpdate::class,
            AppointmentBookingSuccessMailSend::class,
        ],
        CourseEnrollSuccess::class => [
            CourseEnrollDatabaseUpdate::class,
            CourseEnrollSuccessMailSend::class,
        ]
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
