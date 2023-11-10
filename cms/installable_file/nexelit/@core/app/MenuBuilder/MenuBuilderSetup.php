<?php


namespace App\MenuBuilder;


class MenuBuilderSetup extends MenuBuilderBase
{
     public static function Instance(){
        return new self();
    }

    public static function multilang(){
        return true;
    }
    

    public function  static_pages_list()
    {
        // TODO: Implement static_pages_list() method.
        return [
            'about',
            'service',
            'work',
            'team',
            'faq',
            'price_plan',
            'blog',
            'contact',
            'career_with_us',
            'events',
            'knowledgebase',
            'donation',
            'product',
            'testimonial',
            'feedback',
            'clients_feedback',
            'image_gallery',
            'donor',
            'appointment',
            'quote',
            'courses',
            'support_ticket',
            'video_gallery'
        ];
    }

    function register_dynamic_menus()
    {
        // TODO: Implement register_dynamic_menus() method.
        return [
            'service' => [
                'model' => 'App\Services',
                'name' => 'service_page_[lang]_name',
                'route' => 'frontend.services.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang' //old_lang|new_lang
            ],
            'pages' => [
                'model' => 'App\Page',
                'name' => 'pages_page_[lang]_name',
                'route' => 'frontend.dynamic.page',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang' //old_lang|new_lang
            ],
            'event' => [
                'model' => 'App\Events',
                'name' => 'events_page_[lang]_name',
                'route' => 'frontend.events.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang', //old_lang|new_lang,
                'enable_when'  => 'events_module_status'
            ],
            'case_study' => [
                'model' => 'App\Works',
                'name' => 'work_page_[lang]_name',
                'route' => 'frontend.work.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang' //old_lang|new_lang
            ],
            'blog' => [
                'model' => 'App\Blog',
                'name' => 'blog_page_[lang]_name',
                'route' => 'frontend.blog.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang' //old_lang|new_lang
            ],
            'career_with_us' => [
                'model' => 'App\Jobs',
                'name' => 'career_with_us_page_[lang]_name',
                'route' => 'frontend.jobs.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang', //old_lang|new_lang
                'enable_when'  => 'job_module_status'
            ],
            'knowledgebase' => [
                'model' => 'App\Knowledgebase',
                'name' => 'knowledgebase_page_[lang]_name',
                'route' => 'frontend.knowledgebase.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang', //old_lang|new_lang
                'enable_when'  => 'knowledgebase_module_status'
            ],
            'product' => [
                'model' => 'App\Products',
                'name' => 'product_page_[lang]_name',
                'route' => 'frontend.products.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'old_lang', //old_lang|new_lang
                'enable_when'  => 'product_module_status'
            ],
            'appointment' => [
                'model' => 'App\Appointment',
                'name' => 'appointment_page_[lang]_name',
                'route' => 'frontend.appointment.single',
                'route_params' => ['slug','appointment_id'],
                'title_param' => 'title',
                'query' => 'new_lang', //old_lang|new_lang
                'enable_when'  => 'appointment_module_status'
            ],
            'courses' => [
                'model' => 'App\Course',
                'name' => 'courses_page_[lang]_name',
                'route' => 'frontend.course.single',
                'route_params' => ['slug','course_id'],
                'title_param' => 'title',
                'query' => 'new_lang', //old_lang|new_lang
                'enable_when'  => 'course_module_status'
            ]
        ];
    }

}