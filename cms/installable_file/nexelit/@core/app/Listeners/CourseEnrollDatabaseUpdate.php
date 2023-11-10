<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\Course;
use App\CourseEnroll;
use App\EventPaymentLogs;
use App\Events\CourseEnrollSuccess;


class CourseEnrollDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(CourseEnrollSuccess $event)
    {
        $data = $event->data;

        if (empty($data) && !isset($data['transaction_id'])) {
            return;
        }

        $enroll_details = CourseEnroll::findOrFail($data['enroll_id']);
        $enroll_details->transaction_id = $data['transaction_id'];
        $enroll_details->payment_status = 'complete';
        $enroll_details->status = 'complete';
        $enroll_details->save();

        //increase enrolled strudent number in course table
        $course = Course::findOrFail($enroll_details->course_id);
        $course->enrolled_student = $course->enrolled_student + 1;
        $course->save();

    }
}
