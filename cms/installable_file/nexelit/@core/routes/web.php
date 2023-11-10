<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//rss feed route
Route::feeds();

//courses module
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode']], function () {

    Route::post('/poplar-item-by-category-ajax', 'FrontendController@popular_item_by_category')->name('frontend.popular.item.by.category');
    Route::post('/product-story-item-by-category-ajax', 'FrontendController@product_story_item_by_category')->name('frontend.story.product.item.by.category');

    Route::get('home/advertisement/click/store','FrontendController@home_advertisement_click_store')->name('frontend.home.advertisement.click.store');
    Route::get('home/advertisement/impression/store','FrontendController@home_advertisement_impression_store')->name('frontend.home.advertisement.impression.store');
    Route::get('order/cancel','FrontendController@static_payment_cancel_page')->name('frontend.static.order.cancel');

    /*------------------------------
        SOCIAL LOGIN CALLBACK
    ------------------------------*/
    Route::group(['prefix' => 'facebook'],function (){
        Route::get('callback','SocialLoginController@facebook_callback')->name('facebook.callback');
        Route::get('redirect','SocialLoginController@facebook_redirect')->name('login.facebook.redirect');
    });
    Route::group(['prefix' => 'google'],function (){
        Route::get('callback','SocialLoginController@google_callback')->name('google.callback');
        Route::get('redirect','SocialLoginController@google_redirect')->name('login.google.redirect');
    });

    /*----------------------------------------
      FRONTEND: CUSTOM FORM BUILDER ROUTES
    -----------------------------------------*/
    Route::post('submit-custom-form', 'FrontendFormController@custom_form_builder_message')->name('frontend.form.builder.custom.submit');

    /*----------------------------------
        FRONTEND: SUPPORT TICKET ROUTES
    ----------------------------------*/
    Route::group(['namespace' => 'Frontend','middleware' => 'moduleCheck:support_ticket_module_status'],function () {
        $support_ticket_page_slug =  get_static_option('support_ticket_page_slug') ?? 'course';
        Route::get($support_ticket_page_slug, 'SupportTicketController@page')->name('frontend.support.ticket');
        Route::post($support_ticket_page_slug.'/new', 'SupportTicketController@store')->name('frontend.support.ticket.store');
    });

    /*==============================================
        FRONTEND ROUTES: COURSE MODULE
    ==============================================*/
    Route::group(['namespace' => 'Frontend','moduleCheck:course_module_status'],function (){
         $course_page_slug =  get_static_option('courses_page_slug') ?? 'course';

        //courses
        Route::get($course_page_slug, 'CourseController@page')->name('frontend.course');
        Route::get( $course_page_slug.'/{slug?}/{id}', 'CourseController@single')->name('frontend.course.single');
        Route::get( $course_page_slug.'-category/{id}/{slug?}', 'CourseController@category')->name('frontend.course.category');
        Route::get( $course_page_slug.'-enroll/{id}', 'CourseController@enroll')->name('frontend.course.enroll');
        Route::post($course_page_slug.'/course-enroll', 'CourseEnrollController@enroll_now')->name('frontend.course.enroll.submit');
        Route::get( $course_page_slug.'-{course_id}-lesson/{id}', 'CourseController@lesson_preview')->name('frontend.course.lesson');
        Route::get( $course_page_slug.'-{course_id}-lesson', 'CourseController@lesson_start')->name('frontend.course.lesson.start');
        Route::get( $course_page_slug.'-instructor/{slug?}/{id}', 'CourseController@instructor')->name('frontend.course.instructor');
        Route::post( $course_page_slug.'-coupon', 'CourseController@apply_coupon')->name('frontend.course.apply.coupon');
        Route::post( $course_page_slug.'-review', 'CourseController@review')->name('frontend.course.review');

        Route::get($course_page_slug.'-success/{id}', 'CourseController@payment_success')->name('frontend.course.payment.success');
        Route::get($course_page_slug.'-cancel/{id}', 'CourseController@payment_cancel')->name('frontend.course.payment.cancel');

        //courses payment ipn
        Route::get('/course-paypal-ipn','CourseEnrollController@paypal_ipn')->name('frontend.course.paypal.ipn');
        Route::post('/course-paytm-ipn','CourseEnrollController@paytm_ipn')->name('frontend.course.paytm.ipn');
        Route::get('/course-stripe-ipn','CourseEnrollController@stripe_ipn')->name('frontend.course.stripe.ipn');
        Route::post('/course-razorpay-ipn','CourseEnrollController@razorpay_ipn')->name('frontend.course.razorpay.ipn');
        Route::get('/course-mollie-ipn','CourseEnrollController@mollie_ipn')->name('frontend.course.mollie.ipn');
        Route::get('/course-flutterwave-ipn','CourseEnrollController@flutterwave_ipn')->name('frontend.course.flutterwave.ipn');
        Route::get('/course-midtrans-ipn','CourseEnrollController@midtrans_ipn')->name('frontend.course.midtrans.ipn');
        Route::post('/course-payfast-ipn','CourseEnrollController@payfast_ipn')->name('frontend.course.payfast.ipn');
        Route::post('/course-cashfree-ipn','CourseEnrollController@cashfree_ipn')->name('frontend.course.cashfree.ipn');
        Route::get('/course-instamojo-ipn','CourseEnrollController@instamojo_ipn')->name('frontend.course.instamojo.ipn');
        Route::get('/course-marcadopago-ipn','CourseEnrollController@marcadopago_ipn')->name('frontend.course.marcadopago.ipn');
        Route::get('/course-squreup-ipn','CourseEnrollController@squreup_ipn')->name('frontend.course.squreup.ipn');
        Route::post('/course-cinetpay-ipn','CourseEnrollController@cinetpay_ipn')->name('frontend.course.cinetpay.ipn');
        Route::post('/course-paytabs-ipn','CourseEnrollController@paytabs_ipn')->name('frontend.course.paytabs.ipn');
        Route::post('/course-billplz-ipn','CourseEnrollController@billplz_ipn')->name('frontend.course.billplz.ipn');
        Route::post('/course-zitopay-ipn','CourseEnrollController@zitopay_ipn')->name('frontend.course.zitopay.ipn');
        Route::post('/course-toyyibpay-ipn','CourseEnrollController@toyyibpay_ipn')->name('frontend.course.toyyibpay.ipn');
        Route::post('/course-pagalipay-ipn','CourseEnrollController@pagalipay_ipn')->name('frontend.course.pagalipay.ipn');
        Route::get('/course-authorizenet-ipn','CourseEnrollController@authorizenet_ipn')->name('frontend.course.authorizenet.ipn');
    });

});




/*==============================================
    FRONTEND ROUTES: APPOINTMENT MODULE
==============================================*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode','moduleCheck:appointment_module_status']], function () {

    $appointment_page_slug = !empty(get_static_option('appointment_page_slug')) ? get_static_option('appointment_page_slug') : 'appointment';
    //appointment
    Route::get($appointment_page_slug , 'Frontend\AppointmentController@page')->name('frontend.appointment');
    Route::get($appointment_page_slug.'/{slug?}/{id}', 'Frontend\AppointmentController@single')->name('frontend.appointment.single');
    Route::get($appointment_page_slug.'-category/{id}/{any?}', 'Frontend\AppointmentController@category')->name('frontend.appointment.category');
    Route::get($appointment_page_slug.'-search', 'Frontend\AppointmentController@search')->name('frontend.appointment.search');
    Route::post($appointment_page_slug.'-booking', 'Frontend\AppointmentBookingController@booking')->name('frontend.appointment.booking');
    Route::post($appointment_page_slug.'-review', 'Frontend\AppointmentController@review')->name('frontend.appointment.review');
    //appointment
    Route::get($appointment_page_slug.'-success/{id}', 'Frontend\AppointmentController@payment_success')->name('frontend.appointment.payment.success');
    Route::get($appointment_page_slug.'-cancel/{id}', 'Frontend\AppointmentController@payment_cancel')->name('frontend.appointment.payment.cancel');

    //appointment payment ipn
    Route::get('/appointment-paypal-ipn','Frontend\AppointmentBookingController@paypal_ipn')->name('frontend.appointment.paypal.ipn');
    Route::post('/appointment-paytm-ipn','Frontend\AppointmentBookingController@paytm_ipn')->name('frontend.appointment.paytm.ipn');
    Route::get('/appointment-stripe-ipn','Frontend\AppointmentBookingController@stripe_ipn')->name('frontend.appointment.stripe.ipn');
    Route::post('/appointment-razorpay-ipn','Frontend\AppointmentBookingController@razorpay_ipn')->name('frontend.appointment.razorpay.ipn');
    Route::get('/appointment-mollie-ipn','Frontend\AppointmentBookingController@mollie_ipn')->name('frontend.appointment.mollie.ipn');
    Route::get('/appointment-flutterwave-ipn','Frontend\AppointmentBookingController@flutterwave_ipn')->name('frontend.appointment.flutterwave.ipn');
    Route::get('/appointment-midtrans-ipn','Frontend\AppointmentBookingController@midtrans_ipn')->name('frontend.appointment.midtrans.ipn');
    Route::post('/appointment-payfast-ipn','Frontend\AppointmentBookingController@payfast_ipn')->name('frontend.appointment.payfast.ipn');
    Route::post('/appointment-cashfree-ipn','Frontend\AppointmentBookingController@cashfree_ipn')->name('frontend.appointment.cashfree.ipn');
    Route::get('/appointment-instamojo-ipn','Frontend\AppointmentBookingController@instamojo_ipn')->name('frontend.appointment.instamojo.ipn');
    Route::get('/appointment-marcadopago-ipn','Frontend\AppointmentBookingController@marcadopago_ipn')->name('frontend.appointment.marcadopago.ipn');
    Route::get('/appointment-squreup-ipn','Frontend\AppointmentBookingController@squreup_ipn')->name('frontend.appointment.squreup.ipn');
    Route::post('/appointment-cinetpay-ipn','Frontend\AppointmentBookingController@cinetpay_ipn')->name('frontend.appointment.cinetpay.ipn');
    Route::post('/appointment-paytabs-ipn','Frontend\AppointmentBookingController@paytabs_ipn')->name('frontend.appointment.paytabs.ipn');
    Route::post('/appointment-billplz-ipn','Frontend\AppointmentBookingController@billplz_ipn')->name('frontend.appointment.billplz.ipn');
    Route::post('/appointment-zitopay-ipn','Frontend\AppointmentBookingController@zitopay_ipn')->name('frontend.appointment.zitopay.ipn');
    Route::post('/appointment-toyyibpay-ipn','Frontend\AppointmentBookingController@toyyibpay_ipn')->name('frontend.appointment.toyyibpay.ipn');
    Route::post('/appointment-pagalipay-ipn','Frontend\AppointmentBookingController@pagalipay_ipn')->name('frontend.appointment.pagalipay.ipn');
    Route::get('/appointment-authorizenet-ipn','Frontend\AppointmentBookingController@authorizenet_ipn')->name('frontend.appointment.authorizenet.ipn');

    /* appointment booking time check available for booking or not.. */
    Route::post('/appointment-booking-check', 'Frontend\AppointmentController@appointment_booking_time_check')->name('frontend.appointment.booking.time.check');
});


/*==============================================
    FRONTEND ROUTES: KNOWLEDGEBASE MODULE
==============================================*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode', 'moduleCheck:knowledgebase_module_status']], function () {

    $knowledgebase_page_slug = !empty(get_static_option('knowledgebase_page_slug')) ? get_static_option('knowledgebase_page_slug') : 'knowledgebase';

    Route::get($knowledgebase_page_slug , 'FrontendController@knowledgebase')->name('frontend.knowledgebase');
    Route::get($knowledgebase_page_slug.'/{slug}', 'FrontendController@knowledgebase_single')->name('frontend.knowledgebase.single');
    Route::get($knowledgebase_page_slug.'-category/{id}/{any?}', 'FrontendController@knowledgebase_category')->name('frontend.knowledgebase.category');
    Route::get($knowledgebase_page_slug.'-search', 'FrontendController@knowledgebase_search')->name('frontend.knowledgebase.search');
});

/*==============================================
    FRONTEND ROUTES: DONATIONS MODULE
==============================================*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode','moduleCheck:donations_module_status']], function () {

    $donation_page_slug = !empty(get_static_option('donation_page_slug')) ? get_static_option('donation_page_slug') : 'donations';

    Route::get( $donation_page_slug, 'FrontendController@donations')->name('frontend.donations');
    Route::get($donation_page_slug . '/{slug}', 'FrontendController@donations_single')->name('frontend.donations.single');
    Route::post( $donation_page_slug . '/donation', 'DonationLogController@store_donation_logs')->name('frontend.donations.log.store');

    //donation
    Route::get('/donation-success/{id}', 'FrontendController@donation_payment_success')->name('frontend.donation.payment.success');
    Route::get('/donation-cancel/{id}', 'FrontendController@donation_payment_cancel')->name('frontend.donation.payment.cancel');

    //donation payment ipn
    Route::get('/donation-paypal-ipn','DonationLogController@paypal_ipn')->name('frontend.donation.paypal.ipn');
    Route::post('/donation-paytm-ipn','DonationLogController@paytm_ipn')->name('frontend.donation.paytm.ipn');
    Route::get('/donation-stripe-ipn','DonationLogController@stripe_ipn')->name('frontend.donation.stripe.ipn');
    Route::post('/donation-razorpay-ipn','DonationLogController@razorpay_ipn')->name('frontend.donation.razorpay.ipn');
    Route::get('/donation-mollie-ipn','DonationLogController@mollie_ipn')->name('frontend.donation.mollie.ipn');
    Route::get('/donation-flutterwave-ipn','DonationLogController@flutterwave_ipn')->name('frontend.donation.flutterwave.ipn');
    Route::get('/donation-midtrans-ipn','DonationLogController@midtrans_ipn')->name('frontend.donation.midtrans.ipn');
    Route::post('/donation-payfast-ipn','DonationLogController@payfast_ipn')->name('frontend.donation.payfast.ipn');
    Route::post('/donation-cashfree-ipn','DonationLogController@cashfree_ipn')->name('frontend.donation.cashfree.ipn');
    Route::get('/donation-instamojo-ipn','DonationLogController@instamojo_ipn')->name('frontend.donation.instamojo.ipn');
    Route::get('/donation-marcadopago-ipn','DonationLogController@marcadopago_ipn')->name('frontend.donation.marcadopago.ipn');
    Route::get('/donation-squreup-ipn','DonationLogController@squreup_ipn')->name('frontend.donation.squreup.ipn');
    Route::post('/donation-cinetpay-ipn','DonationLogController@cinetpay_ipn')->name('frontend.donation.cinetpay.ipn');
    Route::post('/donation-paytabs-ipn','DonationLogController@paytabs_ipn')->name('frontend.donation.paytabs.ipn');
    Route::post('/donation-billplz-ipn','DonationLogController@billplz_ipn')->name('frontend.donation.billplz.ipn');
    Route::post('/donation-zitopay-ipn','DonationLogController@zitopay_ipn')->name('frontend.donation.zitopay.ipn');
    Route::post('/donation-toyyibpay-ipn','DonationLogController@toyyibpay_ipn')->name('frontend.donation.toyyibpay.ipn');
    Route::post('/donation-pagalipay-ipn','DonationLogController@pagalipay_ipn')->name('frontend.donation.pagalipay.ipn');
    Route::get('/donation-authorizenet-ipn','DonationLogController@authorizenet_ipn')->name('frontend.donation.authorizenet.ipn');
});

/*==============================================
    FRONTEND ROUTES: PRODUCT MODULE
==============================================*/

Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode','moduleCheck:product_module_status']], function () {

    $product_page_slug = !empty(get_static_option('product_page_slug')) ? get_static_option('product_page_slug') : 'product';
    //product
    Route::get($product_page_slug , 'FrontendController@products')->name('frontend.products');
    Route::get( $product_page_slug.'/{slug}', 'FrontendController@product_single')->name('frontend.products.single');
    Route::get( $product_page_slug.'-category/{id}/{any?}', 'FrontendController@products_category')->name('frontend.products.category');
    Route::get( $product_page_slug.'-subcategory/{id}/{any?}', 'FrontendController@products_subcategory')->name('frontend.products.subcategory');
    Route::get( $product_page_slug.'-cart', 'FrontendController@products_cart')->name('frontend.products.cart');
    Route::get( $product_page_slug.'-wishlist', 'FrontendController@products_wishlist')->name('frontend.products.wishlist');
    Route::post( $product_page_slug.'-cart/remove', 'ProductCartController@remove_cart_item')->name('frontend.products.cart.ajax.remove');
    Route::post( $product_page_slug.'-wishlist/remove', 'ProductCartController@remove_wishlist_item')->name('frontend.products.wishlist.ajax.remove');
    Route::post( $product_page_slug.'-item/add-to-cart', 'ProductCartController@add_to_cart')->name('frontend.products.add.to.cart');
    Route::post( $product_page_slug.'-item/ajax/add-to-cart', 'ProductCartController@ajax_add_to_cart')->name('frontend.products.add.to.cart.ajax');
    Route::post( $product_page_slug.'-item/ajax/add-to-wishlist', 'ProductCartController@ajax_add_to_wishlist')->name('frontend.products.add.to.wishlist.ajax');
    Route::post( $product_page_slug.'-item/ajax/coupon', 'ProductCartController@ajax_coupon_code')->name('frontend.products.coupon.code');
    Route::post( $product_page_slug.'-item/ajax/shipping', 'ProductCartController@ajax_shipping_apply')->name('frontend.products.shipping.apply');
    Route::post( $product_page_slug.'-item/ajax/cart-update', 'ProductCartController@ajax_cart_update')->name('frontend.products.ajax.cart.update');
    Route::get( $product_page_slug.'-checkout', 'FrontendController@product_checkout')->name('frontend.products.checkout');
    Route::post( $product_page_slug.'-checkout', 'ProductOrderController@product_checkout');
    Route::post( $product_page_slug.'-ratings', 'FrontendController@product_ratings')->name('product.ratings.store');

    //product order
    Route::get( $product_page_slug.'-success/{id}', 'FrontendController@product_payment_success')->name('frontend.product.payment.success');
    Route::get($product_page_slug.'-cancel/{id}', 'FrontendController@product_payment_cancel')->name('frontend.product.payment.cancel');
    Route::post($product_page_slug.'-download/{id}', 'FrontendController@product_download')->name('frontend.product.download');

    //product payment ipn
    Route::get('/product-paypal-ipn','ProductOrderController@paypal_ipn')->name('frontend.product.paypal.ipn');
    Route::post('/product-paytm-ipn','ProductOrderController@paytm_ipn')->name('frontend.product.paytm.ipn');
    Route::get('/product-stripe-ipn','ProductOrderController@stripe_ipn')->name('frontend.product.stripe.ipn');
    Route::post('/product-razorpay-ipn','ProductOrderController@razorpay_ipn')->name('frontend.product.razorpay.ipn');
    Route::get('/product-mollie-ipn','ProductOrderController@mollie_ipn')->name('frontend.product.mollie.ipn');
    Route::get('/product-flutterwave-ipn','ProductOrderController@flutterwave_ipn')->name('frontend.product.flutterwave.ipn');
    Route::get('/product-midtrans-ipn','ProductOrderController@midtrans_ipn')->name('frontend.product.midtrans.ipn');
    Route::post('/product-payfast-ipn','ProductOrderController@payfast_ipn')->name('frontend.product.payfast.ipn');
    Route::post('/product-cashfree-ipn','ProductOrderController@cashfree_ipn')->name('frontend.product.cashfree.ipn');
    Route::get('/product-instamojo-ipn','ProductOrderController@instamojo_ipn')->name('frontend.product.instamojo.ipn');
    Route::get('/product-marcadopago-ipn','ProductOrderController@marcadopago_ipn')->name('frontend.product.marcadopago.ipn');
    Route::get('/product-squreup-ipn','ProductOrderController@squreup_ipn')->name('frontend.product.squreup.ipn');
    Route::post('/product-cinetpay-ipn','ProductOrderController@cinetpay_ipn')->name('frontend.product.cinetpay.ipn');
    Route::post('/product-paytabs-ipn','ProductOrderController@paytabs_ipn')->name('frontend.product.paytabs.ipn');
    Route::post('/product-billplz-ipn','ProductOrderController@billplz_ipn')->name('frontend.product.billplz.ipn');
    Route::post('/product-zitopay-ipn','ProductOrderController@zitopay_ipn')->name('frontend.product.zitopay.ipn');
    Route::post('/product-toyyibpay-ipn','ProductOrderController@toyyibpay_ipn')->name('frontend.product.toyyibpay.ipn');
    Route::post('/product-pagalipay-ipn','ProductOrderController@pagalipay_ipn')->name('frontend.product.pagalipay.ipn');
    Route::get('/product-authorizenet-ipn','ProductOrderController@authorizenet_ipn')->name('frontend.product.authorizenet.ipn');
    Route::post('/paystack-ipn', 'ProductOrderController@paystack_pay')->name('frontend.paystack.ipn');

});

/*==============================================
    FRONTEND ROUTES: EVENTS MODULE
==============================================*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode', 'moduleCheck:events_module_status']], function () {

    $events_page_slug = !empty(get_static_option('events_page_slug')) ? get_static_option('events_page_slug') : 'events';
    //events
    Route::get($events_page_slug , 'FrontendController@events')->name('frontend.events');
    Route::get($events_page_slug.'/{slug}', 'FrontendController@events_single')->name('frontend.events.single');
    Route::get($events_page_slug.'-category/{id}/{any?}', 'FrontendController@events_category')->name('frontend.events.category');
    Route::get($events_page_slug.'-search', 'FrontendController@events_search')->name('frontend.events.search');
    Route::get($events_page_slug.'-booking/{id}', 'FrontendController@event_booking')->name('frontend.event.booking');
    Route::post($events_page_slug.'-booking', 'FrontendFormController@store_event_booking_data')->name('frontend.event.booking.store');

    //event payment ipn
    Route::get('/event-paypal-ipn','EventPaymentLogsController@paypal_ipn')->name('frontend.event.paypal.ipn');
    Route::post('/event-paytm-ipn','EventPaymentLogsController@paytm_ipn')->name('frontend.event.paytm.ipn');
    Route::get('/event-stripe-ipn','EventPaymentLogsController@stripe_ipn')->name('frontend.event.stripe.ipn');
    Route::post('/event-razorpay-ipn','EventPaymentLogsController@razorpay_ipn')->name('frontend.event.razorpay.ipn');
    Route::get('/event-mollie-ipn','EventPaymentLogsController@mollie_ipn')->name('frontend.event.mollie.ipn');
    Route::get('/event-flutterwave-ipn','EventPaymentLogsController@flutterwave_ipn')->name('frontend.event.flutterwave.ipn');
    Route::get('/event-midtrans-ipn','EventPaymentLogsController@midtrans_ipn')->name('frontend.event.midtrans.ipn');
    Route::post('/event-payfast-ipn','EventPaymentLogsController@payfast_ipn')->name('frontend.event.payfast.ipn');
    Route::post('/event-cashfree-ipn','EventPaymentLogsController@cashfree_ipn')->name('frontend.event.cashfree.ipn');
    Route::get('/event-instamojo-ipn','EventPaymentLogsController@instamojo_ipn')->name('frontend.event.instamojo.ipn');
    Route::get('/event-marcadopago-ipn','EventPaymentLogsController@marcadopago_ipn')->name('frontend.event.marcadopago.ipn');
    Route::get('/event-squreup-ipn','EventPaymentLogsController@squreup_ipn')->name('frontend.event.squreup.ipn');
    Route::post('/event-cinetpay-ipn','EventPaymentLogsController@cinetpay_ipn')->name('frontend.event.cinetpay.ipn');
    Route::post('/event-paytabs-ipn','EventPaymentLogsController@paytabs_ipn')->name('frontend.event.paytabs.ipn');
    Route::post('/event-billplz-ipn','EventPaymentLogsController@billplz_ipn')->name('frontend.event.billplz.ipn');
    Route::post('/event-zitopay-ipn','EventPaymentLogsController@zitopay_ipn')->name('frontend.event.zitopay.ipn');
    Route::post('/event-toyyibpay-ipn','EventPaymentLogsController@toyyibpay_ipn')->name('frontend.event.toyyibpay.ipn');
    Route::post('/event-pagalipay-ipn','EventPaymentLogsController@pagalipay_ipn')->name('frontend.event.pagalipay.ipn');
    Route::get('/event-authorizenet-ipn','EventPaymentLogsController@authorizenet_ipn')->name('frontend.event.authorizenet.ipn');

    //event booking
    Route::get('/booking-confirm/{id}', 'FrontendController@booking_confirm')->name('frontend.event.booking.confirm');
    Route::post('/booking-confirm', 'EventPaymentLogsController@booking_payment_form')->name('frontend.event.payment.confirm');
    Route::get('/attendance-success/{id}', 'FrontendController@event_payment_success')->name('frontend.event.payment.success');
    Route::get('/attendance-cancel/{id}', 'FrontendController@event_payment_cancel')->name('frontend.event.payment.cancel');
});

/*==============================================
    FRONTEND ROUTES: JOB MODULE
==============================================*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode', 'moduleCheck:job_module_status']], function () {
    $career_with_us_page_slug = !empty(get_static_option('career_with_us_page_slug')) ? get_static_option('career_with_us_page_slug') : 'jobs';
    Route::get($career_with_us_page_slug, 'FrontendController@jobs')->name('frontend.jobs');
    Route::get( $career_with_us_page_slug.'/{slug}', 'FrontendController@jobs_single')->name('frontend.jobs.single');
    Route::get( $career_with_us_page_slug.'-category/{id}/{any}', 'FrontendController@jobs_category')->name('frontend.jobs.category');
    Route::get($career_with_us_page_slug.'-search', 'FrontendController@jobs_search')->name('frontend.jobs.search');

    Route::get('/apply/{id}', 'FrontendController@jobs_apply')->name('frontend.jobs.apply');
    Route::post('/apply', 'JobPaymentController@store_jobs_applicant_data')->name('frontend.jobs.apply.store');
    /*-----------------------------------------
        JOB MODULE: PAYMENT GATEWAY ROUTES
    -----------------------------------------*/
    Route::get('/course-paypal-ipn','JobPaymentController@paypal_ipn')->name('frontend.job.paypal.ipn');
    Route::post('/job-paytm-ipn','JobPaymentController@paytm_ipn')->name('frontend.job.paytm.ipn');
    Route::get('/job-stripe-ipn','JobPaymentController@stripe_ipn')->name('frontend.job.stripe.ipn');
    Route::post('/job-razorpay-ipn','JobPaymentController@razorpay_ipn')->name('frontend.job.razorpay.ipn');
    Route::get('/job-mollie-ipn','JobPaymentController@mollie_ipn')->name('frontend.job.mollie.ipn');
    Route::get('/job-flutterwave-ipn','JobPaymentController@flutterwave_ipn')->name('frontend.job.flutterwave.ipn');
    Route::get('/job-midtrans-ipn','JobPaymentController@midtrans_ipn')->name('frontend.job.midtrans.ipn');
    Route::post('/job-payfast-ipn','JobPaymentController@payfast_ipn')->name('frontend.job.payfast.ipn');
    Route::post('/job-cashfree-ipn','JobPaymentController@cashfree_ipn')->name('frontend.job.cashfree.ipn');
    Route::get('/job-instamojo-ipn','JobPaymentController@instamojo_ipn')->name('frontend.job.instamojo.ipn');
    Route::get('/job-marcadopago-ipn','JobPaymentController@marcadopago_ipn')->name('frontend.job.marcadopago.ipn');
    Route::get('/job-squreup-ipn','JobPaymentController@squreup_ipn')->name('frontend.job.squreup.ipn');
    Route::post('/job-cinetpay-ipn','JobPaymentController@cinetpay_ipn')->name('frontend.job.cinetpay.ipn');
    Route::post('/job-paytabs-ipn','JobPaymentController@paytabs_ipn')->name('frontend.job.paytabs.ipn');
    Route::post('/job-billplz-ipn','JobPaymentController@billplz_ipn')->name('frontend.job.billplz.ipn');
    Route::post('/job-zitopay-ipn','JobPaymentController@zitopay_ipn')->name('frontend.job.zitopay.ipn');
    Route::post('/job-toyyibpay-ipn','JobPaymentController@toyyibpay_ipn')->name('frontend.job.toyyibpay.ipn');
    Route::post('/job-pagalipay-ipn','JobPaymentController@pagalipay_ipn')->name('frontend.job.pagalipay.ipn');
    Route::get('/job-authorizenet-ipn','JobPaymentController@authorizenet_ipn')->name('frontend.job.authorizenet.ipn');

    /*-------------------------------------------------
       JOB MODULE: PAYMENT SUCCESS/CANCEL ROUTES
   ----------------------------------------------------*/
    Route::get('/job-success/{id}', 'FrontendController@job_payment_success')->name('frontend.job.payment.success');
    Route::get('/job-cancel/{id}', 'FrontendController@job_payment_cancel')->name('frontend.job.payment.cancel');

});

Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode', 'HtmlMinifier']], function () {

    Route::get('/', 'FrontendController@index')->name('homepage');

    Route::post('/get-touch', 'FrontendFormController@get_touch')->name('frontend.get.touch');
    Route::post('/appointment-message', 'FrontendFormController@appointment_message')->name('frontend.appointment.message');
    Route::post('/service-quote', 'FrontendFormController@service_quote')->name('frontend.service.quote');
    Route::post('/case-study-quote', 'FrontendFormController@case_study_quote')->name('frontend.case.study.quote');
    /*-----------------------------
        SUBSCRIBER VERIFY
    -----------------------------*/
    Route::get('/subscriber/email-verify/{token}','FrontendController@subscriber_verify')->name('subscriber.verify');


    /*---------------------------------
        PAYMENT SUCCESS/CANCEL ROUTES
    ---------------------------------*/
    Route::get('/order-success/{id}', 'FrontendController@order_payment_success')->name('frontend.order.payment.success');
    Route::get('/order-cancel/{id}', 'FrontendController@order_payment_cancel')->name('frontend.order.payment.cancel');
    Route::get('/order-confirm/{id}', 'FrontendController@order_confirm')->name('frontend.order.confirm');
    Route::post('/order-confirm', 'PaymentLogController@order_payment_form')->name('frontend.order.payment.form');



    /*---------------------------------
     PRICE PLAN PAYMENT IPN  ROUTES
    ---------------------------------*/
    Route::get('/price-plan-paypal-ipn','PaymentLogController@paypal_ipn')->name('frontend.price.plan.paypal.ipn');
    Route::post('/price-plan-paytm-ipn','PaymentLogController@paytm_ipn')->name('frontend.price.plan.paytm.ipn');
    Route::get('/price-plan-stripe-ipn','PaymentLogController@stripe_ipn')->name('frontend.price.plan.stripe.ipn');
    Route::post('/price-plan-razorpay-ipn','PaymentLogController@razorpay_ipn')->name('frontend.price.plan.razorpay.ipn');
    Route::get('/price-plan-mollie-ipn','PaymentLogController@mollie_ipn')->name('frontend.price.plan.mollie.ipn');
    Route::get('/price-plan-flutterwave-ipn','PaymentLogController@flutterwave_ipn')->name('frontend.price.plan.flutterwave.ipn');
    Route::get('/price-plan-midtrans-ipn','PaymentLogController@midtrans_ipn')->name('frontend.price.plan.midtrans.ipn');
    Route::post('/price-plan-payfast-ipn','PaymentLogController@payfast_ipn')->name('frontend.price.plan.payfast.ipn');
    Route::get('/paystack-ipn','PaymentLogController@paystack_ipn')->name('frontend.price.plan.paystack.ipn');
    Route::post('/price-plan-cashfree-ipn','PaymentLogController@cashfree_ipn')->name('frontend.price.plan.cashfree.ipn');
    Route::get('/price-plan-instamojo-ipn','PaymentLogController@instamojo_ipn')->name('frontend.price.plan.instamojo.ipn');
    Route::get('/price-plan-marcadopago-ipn','PaymentLogController@marcadopago_ipn')->name('frontend.price.plan.marcadopago.ipn');
    Route::get('/price-plan-squreup-ipn','PaymentLogController@squreup_ipn')->name('frontend.price.plan.squreup.ipn');
    Route::post('/price-plan-cinetpay-ipn','PaymentLogController@cinetpay_ipn')->name('frontend.price.plan.cinetpay.ipn');
    Route::post('/price-plan-paytabs-ipn','PaymentLogController@paytabs_ipn')->name('frontend.price.plan.paytabs.ipn');
    Route::post('/price-plan-billplz-ipn','PaymentLogController@billplz_ipn')->name('frontend.price.plan.billplz.ipn');
    Route::post('/price-plan-zitopay-ipn','PaymentLogController@zitopay_ipn')->name('frontend.price.plan.zitopay.ipn');
    Route::post('/price-plan-toyyibpay-ipn','PaymentLogController@toyyibpay_ipn')->name('frontend.price.plan.toyyibpay.ipn');
    Route::post('/price-plan-pagalipay-ipn','PaymentLogController@pagalipay_ipn')->name('frontend.price.plan.pagalipay.ipn');
    Route::get('/price-plan-authorizenet-ipn','PaymentLogController@authorizenet_ipn')->name('frontend.price.plan.authorizenet.ipn');

    /*---------------------------------
      INVOICE ROUTES
     ---------------------------------*/
    Route::post('/products-user/generate-invoice', 'FrontendController@generate_invoice')->name('frontend.product.invoice.generate');
    Route::post('/donation-user/generate-invoice', 'FrontendController@generate_donation_invoice')->name('frontend.donation.invoice.generate');
    Route::post('/event-user/generate-invoice', 'FrontendController@generate_event_invoice')->name('frontend.event.invoice.generate');
    Route::post('/package-user/generate-invoice', 'FrontendController@generate_package_invoice')->name('frontend.package.invoice.generate');


    //static page
    $about_page_slug = get_static_option('about_page_slug') ?? 'about';
    $work_page_slug = get_static_option('work_page_slug') ?? 'work';
    $faq_page_slug = get_static_option('faq_page_slug') ?? 'faq';
    $team_page_slug = get_static_option('team_page_slug') ?? 'team';
    $price_plan_page_slug = get_static_option('price_plan_page_slug') ?? 'price-plan';
    $contact_page_slug = get_static_option('contact_page_slug') ?? 'contact';
    $blog_page_slug = get_static_option('blog_page_slug') ?? 'blog';
    $quote_page_slug = get_static_option('quote_page_slug') ?? 'request-quote';
    $testimonial_page_slug = get_static_option('testimonial_page_slug') ?? 'testimonials';
    $feedback_page_slug = get_static_option('feedback_page_slug') ?? 'feedback';
    $clients_feedback_page_slug = get_static_option('clients_feedback_page_slug') ?? 'clients-feedback';
    $image_gallery_page_slug = get_static_option('image_gallery_page_slug') ?? 'image-gallery';
    $video_gallery_page_slug = get_static_option('video_gallery_page_slug') ?? 'video-gallery';
    $donor_page_slug = get_static_option('donor_page_slug') ?? 'donor-list';

    /*--------------------------------------
        FRONTEND: SERVICES ROUTES
    ---------------------------------------*/
    $service_page_slug = get_static_option('service_page_slug') ?? 'service';
    Route::get($service_page_slug, 'FrontendController@service_page')->name('frontend.service');
    Route::get($service_page_slug.'/category/{id}/{any?}', 'FrontendController@category_wise_services_page')->name('frontend.services.category');
    Route::get( $service_page_slug.'/{slug}', 'FrontendController@services_single_page')->name('frontend.services.single');

    /*--------------------------------------
         FRONTEND: OTHERS ROUTES
     ---------------------------------------*/
    Route::get('/' . $donor_page_slug, 'FrontendController@donor_list')->name('frontend.donor.list');
    Route::get('/' . $about_page_slug, 'FrontendController@about_page')->name('frontend.about');
    Route::get('/' . $faq_page_slug, 'FrontendController@faq_page')->name('frontend.faq');
    Route::get('/' . $team_page_slug, 'FrontendController@team_page')->name('frontend.team');
    Route::get('/' . $price_plan_page_slug, 'FrontendController@price_plan_page')->name('frontend.price.plan');
    Route::get('/' . $contact_page_slug, 'FrontendController@contact_page')->name('frontend.contact');
    Route::get('/' . $quote_page_slug, 'FrontendController@request_quote')->name('frontend.request.quote');

    /*--------------------------------------
         FRONTEND: CASE STUDY/ WORKS ROUTES
     ---------------------------------------*/
        Route::get($work_page_slug, 'FrontendController@work_page')->name('frontend.work');
        Route::get( $work_page_slug.'/{slug}', 'FrontendController@work_single_page')->name('frontend.work.single');
        Route::get( $work_page_slug.'/category/{id}/{any?}', 'FrontendController@category_wise_works_page')->name('frontend.works.category');

    /*--------------------------------------
        FRONTEND: BLOGS ROUTES
    ---------------------------------------*/
        Route::get($blog_page_slug, 'FrontendController@blog_page')->name('frontend.blog');
        Route::get( $blog_page_slug.'/{slug}', 'FrontendController@blog_single_page')->name('frontend.blog.single');
        Route::get( $blog_page_slug.'-search', 'FrontendController@blog_search_page')->name('frontend.blog.search');
        Route::get( $blog_page_slug.'-category/{id}/{any}', 'FrontendController@category_wise_blog_page')->name('frontend.blog.category');
        Route::get( $blog_page_slug.'-tags/{name}', 'FrontendController@tags_wise_blog_page')->name('frontend.blog.tags.page');

    /*------------------------------------
        FRONTEND: ROUTES
    ------------------------------------*/
    Route::get('/' . $testimonial_page_slug, 'FrontendController@testimonials')->name('frontend.testimonials');
    Route::get('/' . $feedback_page_slug, 'FrontendController@feedback_page')->name('frontend.feedback');
    Route::get('/' . $clients_feedback_page_slug, 'FrontendController@clients_feedback_page')->name('frontend.clients.feedback');
    Route::post('/' . $clients_feedback_page_slug . '/submit', 'FrontendFormController@clients_feedback_store')->name('frontend.clients.feedback.store');
    Route::get('/' . $image_gallery_page_slug . '', 'FrontendController@image_gallery_page')->name('frontend.image.gallery');
    Route::get('/' . $price_plan_page_slug . '/{id}', 'FrontendController@plan_order')->name('frontend.plan.order');
    Route::get('/' . $video_gallery_page_slug . '', 'FrontendController@video_gallery_page')->name('frontend.video.gallery');

    //user login
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('/ajax-login', 'FrontendController@ajax_login')->name('user.ajax.login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/login/forget-password', 'FrontendController@showUserForgetPasswordForm')->name('user.forget.password');
    Route::get('/login/reset-password/{user}/{token}', 'FrontendController@showUserResetPasswordForm')->name('user.reset.password');
    Route::post('/login/reset-password', 'FrontendController@UserResetPassword')->name('user.reset.password.change');
    Route::post('/login/forget-password', 'FrontendController@sendUserForgetPasswordMail');
    Route::post('/logout', 'Auth\LoginController@logout')->name('user.logout');
    //user email verify
    Route::get('/user/email-verify', 'UserDashboardController@user_email_verify_index')->name('user.email.verify');
    Route::get('/user/resend-verify-code', 'UserDashboardController@reset_user_email_verify_code')->name('user.resend.verify.mail');
    Route::post('/user/email-verify', 'UserDashboardController@user_email_verify');

    Route::post('/request-quote', 'FrontendFormController@send_quote_message')->name('frontend.quote.message');
    Route::post('/request-estimate', 'FrontendFormController@send_estimate_message')->name('frontend.estimate.message');
    Route::get('/home/{id}', 'FrontendController@home_page_change')->name('frontend.homepage.demo');

});


/*----------------------------------
    USER DASHBOARD
-----------------------------------*/
Route::prefix('user-home')->middleware(['userEmailVerify', 'setlang:frontend', 'globalVariable', 'maintains_mode'])->group(function () {
    Route::get('/', 'UserDashboardController@user_index')->name('user.home');
    Route::get('/download/file/{id}', 'UserDashboardController@download_file')->name('user.dashboard.download.file');
    Route::get('/package-orders', 'UserDashboardController@package_orders')->name('user.home.package.order');
    Route::get('/product-orders', 'UserDashboardController@product_orders')->name('user.home.product.order');
    Route::get('/product-download', 'UserDashboardController@product_downloads')->name('user.home.product.download');
    Route::get('/events-booking', 'UserDashboardController@event_booking')->name('user.home.event.booking');
    Route::get('/donations', 'UserDashboardController@donations')->name('user.home.donations');
    Route::get('/appointment-booking', 'UserDashboardController@appointment_booking')->name('user.home.appointment.booking');
    Route::get('/course-enroll', 'UserDashboardController@course_enroll')->name('user.home.course.enroll');
    Route::get('/support-tickets', 'UserDashboardController@support_tickets')->name('user.home.support.tickets');

    Route::get('/change-password', 'UserDashboardController@change_password')->name('user.home.change.password');
    Route::get('/edit-profile', 'UserDashboardController@edit_profile')->name('user.home.edit.profile');
    Route::post('/profile-update', 'UserDashboardController@user_profile_update')->name('user.profile.update');
    Route::post('/password-change', 'UserDashboardController@user_password_change')->name('user.password.change');
    Route::post('/package-order/cancel', 'UserDashboardController@package_order_cancel')->name('user.dashboard.package.order.cancel');
    Route::post('/product-order/cancel', 'UserDashboardController@product_order_cancel')->name('user.dashboard.product.order.cancel');
    Route::post('/event-order/cancel', 'UserDashboardController@event_order_cancel')->name('user.dashboard.event.order.cancel');
    Route::post('/donation-order/cancel', 'UserDashboardController@donation_order_cancel')->name('user.dashboard.donation.order.cancel');
    Route::post('/appointment-order/cancel', 'UserDashboardController@appointment_order_cancel')->name('user.dashboard.appointment.order.cancel');
    Route::post('/course-order/cancel', 'UserDashboardController@course_order_cancel')->name('user.dashboard.course.order.cancel');
    Route::get('/product-order/view/{id}', 'UserDashboardController@product_order_view')->name('user.dashboard.product.order.view');

    Route::post('/course-certificate', 'UserDashboardController@course_certificate')->name('user.dashboard.course.certificate');
    Route::get('/course-certificate/download/{id}', 'UserDashboardController@course_certificate_download')->name('user.dashboard.course.certificate.download');
    Route::get('support-ticket/view/{id}', 'UserDashboardController@support_ticket_view')->name('user.dashboard.support.ticket.view');
    Route::post('support-ticket/priority-change', 'UserDashboardController@support_ticket_priority_change')->name('user.dashboard.support.ticket.priority.change');
    Route::post('support-ticket/status-change', 'UserDashboardController@support_ticket_status_change')->name('user.dashboard.support.ticket.status.change');
    Route::post('support-ticket/message', 'UserDashboardController@support_ticket_message')->name('user.dashboard.support.ticket.message');

    /* EVENT TICKET QR CODE GENERATOR */
    Route::post('/event-user/generate-ticket', 'UserDashboardController@generate_event_ticket')->name('user.dashboard.event.ticket.generate');
});



/*------------------------------------
  ADMIN LOGIN ROUTE
-------------------------------------*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'HtmlMinifier']], function () {

    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
    Route::get('/login/admin/forget-password', 'FrontendController@showAdminForgetPasswordForm')->name('admin.forget.password');
    Route::get('/login/admin/reset-password/{user}/{token}', 'FrontendController@showAdminResetPasswordForm')->name('admin.reset.password');
    Route::post('/login/admin/reset-password', 'FrontendController@AdminResetPassword')->name('admin.reset.password.change');
    Route::post('/login/admin/forget-password', 'FrontendController@sendAdminForgetPasswordMail');
    Route::post('/logout/admin', 'AdminDashboardController@adminLogout')->name('admin.logout');
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::get('/lang', 'FrontendController@lang_change')->name('frontend.langchange');
    Route::post('/subscribe-newsletter', 'FrontendController@subscribe_newsletter')->name('frontend.subscribe.newsletter');
    Route::post('/contact-message', 'FrontendFormController@send_contact_message')->name('frontend.contact.message');
    Route::post('/place-order', 'FrontendFormController@send_order_message')->name('frontend.order.message');
});


require_once __DIR__.'/admin.php';

/*------------------------------------
    DYNAMIC PAGE ROUTE
-------------------------------------*/
Route::group(['middleware' => ['setlang:frontend', 'globalVariable', 'HtmlMinifier']], function () {
    Route::get('/{slug}', 'FrontendController@dynamic_single_page')->name('frontend.dynamic.page');
});

