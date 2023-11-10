<?php


namespace App\PageBuilder;


use App\PageBuilder;

class PageBuilderSetup
{
    private static function registerd_widgets(): array
    {
        //check module wise widget by set condition
        return [
            PageBuilder\Addons\Header\HeaderAreaStyleOne::class,
            PageBuilder\Addons\Header\HeaderAreaStyleTwo::class,
            PageBuilder\Addons\Header\HeaderAreaStyleThree::class,
            PageBuilder\Addons\Header\HeaderAreaStyleFour::class,
            PageBuilder\Addons\Header\HeaderAreaStyleFive::class,
            PageBuilder\Addons\Header\HeaderAreaStyleSix::class,
            PageBuilder\Addons\Header\HeaderAreaStyleSeven::class,
            PageBuilder\Addons\Header\HeaderAreaStyleEight::class,
            PageBuilder\Addons\Header\HeaderAreaStyleNine::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleTen::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleEleven::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleTwelve::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleThirteen::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleFourteen::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleFifteen::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleSixteen::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleSeventeen::class,
            PageBuilder\Addons\Product\ProductCategoryStyleOne::class,
            PageBuilder\Addons\Product\BannerStyleOne::class,
            PageBuilder\Addons\Product\ProductSliderStyleOne::class,
            PageBuilder\Addons\Process\ProcessAreaStyleOne::class,
            PageBuilder\Addons\Product\ProductGridStyleOne::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleOne::class,
            PageBuilder\Addons\Common\BrandLogoStyleOne::class,
            PageBuilder\Addons\Course\CourseCategoryStyleOne::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleOne::class,
            PageBuilder\Addons\Course\CourseSliderStyleOne::class,
            PageBuilder\Addons\Common\VideoAreaStyleOne::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleOne::class,
            PageBuilder\Addons\Course\CourseGridStyleOne::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleTwo::class,
            PageBuilder\Addons\Event\EventSliderStyleOne::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleOne::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleOne::class,
            PageBuilder\Addons\Service\ServiceGridStyleOne::class,
            PageBuilder\Addons\Appointment\AppointmentSliderStyleOne::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleTwo::class,
            PageBuilder\Addons\CaseStudy\CaseStudyMasornyOne::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleThree::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleFour::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleTwo::class,
            PageBuilder\Addons\Blog\BlogSliderStyleOne::class,
            PageBuilder\Addons\Common\OfferAreaOne::class,
            PageBuilder\Addons\Product\ProductSliderStyleTwo::class,
            PageBuilder\Addons\Product\ProductGridStyleTwo::class,
            PageBuilder\Addons\Product\ProductGridStyleThree::class,
            PageBuilder\Addons\Service\ServiceGridStyleTwo::class,
            PageBuilder\Addons\Service\ServiceCategoryGridStyleOne::class,
            PageBuilder\Addons\Service\ServiceCategoryGridStyleTwo::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleThree::class,
            PageBuilder\Addons\Process\ProcessAreaStyleTwo::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleThree::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleFive::class,
            PageBuilder\Addons\Blog\BlogSliderStyleTwo::class,
            PageBuilder\Addons\ContactArea\ContactAreaStyleOne::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleTwo::class,
            PageBuilder\Addons\Donation\DonationGridStyleOne::class,
            PageBuilder\Addons\Team\TeamSliderStyleOne::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleFour::class,
            PageBuilder\Addons\Event\EventSliderStyleTwo::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleSix::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleFive::class,
            PageBuilder\Addons\Blog\BlogSliderStyleThree::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleThree::class,
            PageBuilder\Addons\Service\ServiceGridStyleThree::class,
            PageBuilder\Addons\Appointment\AppointmentSliderStyleTwo::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleSix::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleFour::class,
            PageBuilder\Addons\CaseStudy\CaseStudySliderOne::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleSeven::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleTwo::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleFive::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleSeven::class,
            PageBuilder\Addons\Service\ServiceGridStyleFour::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleFive::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleEight::class,
            PageBuilder\Addons\Blog\BlogSliderStyleFour::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleSix::class,
            PageBuilder\Addons\Service\ServiceGridStyleFive::class,
            PageBuilder\Addons\CaseStudy\CaseStudySliderTwo::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleNine::class,
            PageBuilder\Addons\ContactArea\ContactAreaStyleTwo::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleSeven::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleSix::class,
            PageBuilder\Addons\Service\ServiceGridStyleSix::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleEight::class,
            PageBuilder\Addons\CaseStudy\CaseStudySliderThree::class,
            PageBuilder\Addons\Team\TeamSliderStyleTwo::class,
            PageBuilder\Addons\Service\ServiceGridStyleSeven::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleNine::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleEight::class,
            PageBuilder\Addons\Service\ServiceGridStyleEight::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleSeven::class,
            PageBuilder\Addons\CaseStudy\CaseStudySliderFour::class,
            PageBuilder\Addons\Team\TeamSliderStyleThree::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleTen::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleThree::class,
            PageBuilder\Addons\Service\ServiceGridStyleNine::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleEight::class,
            PageBuilder\Addons\Common\QuoteAndFaqStyleOne::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleNine::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleNine::class,
            PageBuilder\Addons\Common\ExperticeAreaStyleOne::class,
            PageBuilder\Addons\Service\ServiceGridStyleTen::class,
            PageBuilder\Addons\CaseStudy\CaseStudyMasornyTwo::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleTen::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleEleven::class,
            PageBuilder\Addons\Blog\BlogSliderStyleFive::class,
            PageBuilder\Addons\Common\ExperienceAreaStyleOne::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleTen::class,
            PageBuilder\Addons\Service\ServiceGridStyleEleven::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleTwelve::class,
            PageBuilder\Addons\PricePlan\PricePlanStyleOne::class,
            PageBuilder\Addons\Counterup\CounterupAreaStyleTen::class,
            PageBuilder\Addons\Blog\BlogSliderStyleSix::class,
            PageBuilder\Addons\ContactArea\ContactAreaStyleThree::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleEleven::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleFour::class,
            PageBuilder\Addons\Service\ServiceGridStyleTwelve::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleEleven::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleThirteen::class,
            PageBuilder\Addons\PricePlan\PricePlanStyleTwo::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleFive::class,
            PageBuilder\Addons\Service\ServiceGridStyleThirteen::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleTwelve::class,
            PageBuilder\Addons\CtaArea\CallToActionStyleThirteen::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleFourteen::class,
            PageBuilder\Addons\Team\TeamSliderStyleFour::class,
            PageBuilder\Addons\Iconbox\IconBoxStyleSix::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleTwelve::class,
            PageBuilder\Addons\Service\ServiceGridStyleFourteen::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleThirteen::class,
            PageBuilder\Addons\CaseStudy\CaseStudySliderFive::class,
            PageBuilder\Addons\Testimonial\TestimonialStyleFifteen::class,
            PageBuilder\Addons\Team\TeamGridStyleOne::class,
            PageBuilder\Addons\Team\TeamGridStyleTwo::class,
            PageBuilder\Addons\Team\TeamGridStyleThree::class,
            PageBuilder\Addons\Team\TeamGridStyleFour::class,
            PageBuilder\Addons\ClientsFeedback\ClientsFeedbackStyleOne::class,
            PageBuilder\Addons\ImageGallery\ImageGalleryMasonry::class,
            PageBuilder\Addons\Testimonial\TestimonialGridStyleOne::class,
            PageBuilder\Addons\Testimonial\TestimonialGridStyleTwo::class,
            PageBuilder\Addons\Testimonial\TestimonialGridStyleThree::class,
            PageBuilder\Addons\Testimonial\TestimonialGridStyleFour::class,
            PageBuilder\Addons\Testimonial\TestimonialGridStyleFive::class,
            PageBuilder\Addons\CaseStudy\CaseStudyGridOne::class,
            PageBuilder\Addons\CaseStudy\CaseStudyGridTwo::class,
            PageBuilder\Addons\PricePlan\PricePlanGridStyleOne::class,
            PageBuilder\Addons\Blog\BlogGridStyleOne::class,
            PageBuilder\Addons\Blog\BlogGridStyleTwo::class,
            PageBuilder\Addons\Blog\BlogGridStyleThree::class,
            PageBuilder\Addons\Blog\BlogGridStyleFour::class,
            PageBuilder\Addons\Faq\FaqStyleOne::class,
            PageBuilder\Addons\Event\EventGridStyleOne::class,
            PageBuilder\Addons\Jobs\JobGridStyleOne::class,
            PageBuilder\Addons\Appointment\AppointmentGridStyleOne::class,
            PageBuilder\Addons\Donation\DonationGridStyleTwo::class,
            PageBuilder\Addons\Product\ProductGridStyleFour::class,
            PageBuilder\Addons\Donation\DonorGridStyleOne::class,
            PageBuilder\Addons\InfoBox\InfoBoxStyleOne::class,
            PageBuilder\Addons\ContactArea\ContactAreaStyleFour::class,
            PageBuilder\Addons\Common\CustomFormStyleOne::class,
            PageBuilder\Addons\Common\GoogleMap::class,
            PageBuilder\Addons\ImgBox\ImageBoxSliderOne::class,
            PageBuilder\Addons\Iconbox\IconBoxSliderOne::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridOne::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridTwo::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridThree::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridFour::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridFive::class,
            PageBuilder\Addons\Iconbox\IconBoxGridOne::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridSix::class,
            PageBuilder\Addons\Iconbox\IconBoxGridTwo::class,
            PageBuilder\Addons\Iconbox\IconBoxGridThree::class,
            PageBuilder\Addons\Iconbox\IconBoxGridFour::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridSeven::class,
            PageBuilder\Addons\ImgBox\ImageBoxGridEight::class,
            PageBuilder\Addons\Common\TextEditor::class,
            PageBuilder\Addons\Common\RawHTML::class,
            PageBuilder\Addons\Header\HeaderVideoAreaStyleOne::class,
            PageBuilder\Addons\Header\HeaderVideoAreaStyleTwo::class,
            PageBuilder\Addons\Common\Advertise::class,
            PageBuilder\Addons\HeaderSlider\HeaderAreaStyleEighteen::class,
            PageBuilder\Addons\Product\ProductSliderStyleThree::class,
            PageBuilder\Addons\Product\BannerStyleTwo::class,
            PageBuilder\Addons\Product\ProductMasornyOne::class,
            PageBuilder\Addons\Product\BannerStyleThree::class,
            PageBuilder\Addons\Common\InstagramOne::class,
            PageBuilder\Addons\Common\PromoAreaOne::class
        ];
    }

    public static function get_admin_panel_widgets(): string
    {
        $widgets_markup = '';
        $widget_list = self::registerd_widgets();
        foreach ($widget_list as $widget){
            try {
                $widget_instance = new  $widget();
            }catch (\Exception $e){
                $msg = $e->getMessage();
                throw new \ErrorException($msg);
            }
            if ($widget_instance->enable()){
                $widgets_markup .= self::render_admin_addon_item([
                    'addon_name' => $widget_instance->addon_name(),
                    'addon_namespace' => $widget_instance->addon_namespace(), // new added
                    'addon_title' => $widget_instance->addon_title(),
                    'preview_image' => $widget_instance->get_preview_image($widget_instance->preview_image())
                ]);
            }

        }
        return $widgets_markup;
    }

    private static function render_admin_addon_item($args): string
    {
        return '<li class="ui-state-default widget-handler" data-name="'.$args['addon_name'].'" data-namespace="'.base64_encode($args['addon_namespace']).'" >
                    <h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$args['addon_title'].$args['preview_image'].'</h4>
                </li>';
    }
    public static function render_widgets_by_name_for_admin($args){
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);
        if ($instance->enable()){
            return $instance->admin_render();
        }
    }

    public static function render_widgets_by_name_for_frontend($args){
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);
        if ($instance->enable()){
            return $instance->frontend_render();
        }
    }

    public static function render_frontend_pagebuilder_content_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order', 'ASC')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'location' => $location,
                'id' => $widget->id,
                'column' => $args['column'] ?? false
            ]);
        }
        return $output;
    }

    public static function get_saved_addons_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order','asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id' => $widget->id,
                'type' => 'update',
                'order' => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id' => $widget->addon_page_id,
                'location' => $widget->addon_location
            ]);
        }

        return $output;
    }
    public static function get_saved_addons_for_dynamic_page($page_type,$page_id): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_page_type' => $page_type,'addon_page_id' => $page_id])->orderBy('addon_order','asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id' => $widget->id,
                'type' => 'update',
                'order' => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id' => $widget->addon_page_id,
                'location' => $widget->addon_location
            ]);
        }

        return $output;
    }
    public static function render_frontend_pagebuilder_content_for_dynamic_page($page_type,$page_id): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_page_type' => $page_type,'addon_page_id' => $page_id])->orderBy('addon_order','asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
//                'location' => $location,
                'id' => $widget->id,
                'column' => $args['column'] ?? false
            ]);
        }
        return $output;
    }
}