<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    protected $except = [
        '/price-plan-paytm-ipn',
        '/price-plan-payfast-ipn',
        '/price-plan-cashfree-ipn',
        '/price-plan-cinetpay-ipn',
        '/price-plan-paytabs-ipn',

        '/event-paytm-ipn',
        '/pevent-payfast-ipn',
        '/event-cashfree-ipn',
        '/event-cinetpay-ipn',
        '/event-paytabs-ipn',

        '/donation-paytm-ipn',
        '/donation-payfast-ipn',
        '/donation-cashfree-ipn',
        '/donation-cinetpay-ipn',
        '/donation-paytabs-ipn',

        '/product-paytm-ipn',
        '/product-payfast-ipn',
        '/product-cashfree-ipn',
        '/product-cinetpay-ipn',
        '/product-paytabs-ipn',

        '/appointment-paytm-ipn',
        '/appointment-payfast-ipn',
        '/appointment-cashfree-ipn',
        '/appointment-cinetpay-ipn',
        '/appointment-paytabs-ipn',

        '/course-paytm-ipn',
        '/course-payfast-ipn',
        '/course-cashfree-ipn',
        '/course-cinetpay-ipn',
        '/course-paytabs-ipn',

        '/job-paytm-ipn',
        '/job-payfast-ipn',
        '/job-cashfree-ipn',
        '/job-cinetpay-ipn',
        '/job-paytabs-ipn',

    ];
}
