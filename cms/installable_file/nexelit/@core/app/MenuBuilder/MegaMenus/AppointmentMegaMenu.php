<?php


namespace App\MenuBuilder\MegaMenus;


use App\Appointment;
use App\AppointmentCategoryLang;
use App\MenuBuilder\MegaMenuBase;

class AppointmentMegaMenu extends MegaMenuBase
{

    function model(){
        return 'App\Appointment';
    }
    function render($ids,$lang,$settings)
    {
        //it will have all html markup for the mega menu
        //it will have all html markup for the mega menu
        $ids = explode(',',$ids);
        $output = '';
        if (empty($ids)){
            return $output;
        }
        $output .= $this->body_start();
        // TODO:what you want you can write,inside this,
        // TODO:it's recommended to have a column inside it
        $mega_menu_items = Appointment::with(['lang_query' => function($query) use ($lang){
            $query->where('lang', $lang);
        }])->whereIn('id',$ids)->get()->groupBy('categories_id');
        if ($settings['sort_by'] === 'asc'){
            $mega_menu_items->sortBy($settings['sort']);
        }else {
            $mega_menu_items ->sortByDesc($settings['sort']);
        }

        foreach ($mega_menu_items as $cat => $posts) {
            $output .= '<div class="col-lg-3 col-md-6">' ."\n";
            $output .= '<div class="xg-mega-menu-single-column-wrap">'."\n";
            if (!empty($settings['category_status'])){
                $output .= '<h4 class="mega-menu-title">' . $this->category($cat). '</h4>'."\n";
            }
            $output .= '<ul>'."\n";
            foreach ($posts as $post) {
                $title = $post->lang_query->title ?? '';
                $slug = $post->lang_query->slug ?? '';
                $output .= '<li><a href="'.route('frontend.appointment.single',[$slug,$post->id]).'">' . $title . '</a></li>'."\n";
            }
            $output .= '</ul>'."\n";
            $output .= '</div>'."\n";
            $output .= '</div>'."\n";
        }

        $output .= $this->body_end();

        return $output;
    }
    function slug()
    {
        return 'appointment_page_slug';
    }


    function name()
    {
        return 'appointment_page_[lang]_name';
    }

    function enable()
    {
        return (boolean) get_static_option('appointment_module_status');
    }

    function category($id)
    {
        $category = AppointmentCategoryLang::where(['cat_id' => $id])->first();
        return $category->title ?? __('Uncategorized');
    }
    function query_type()
    {
        return 'new_lang'; // old_lang|new_lang
    }
    function title_param()
    {
        // TODO: Implement title_param() method.
        return 'title';
    }
}