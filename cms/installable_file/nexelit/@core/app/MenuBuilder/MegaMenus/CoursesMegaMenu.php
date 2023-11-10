<?php


namespace App\MenuBuilder\MegaMenus;


use App\Course;
use App\CoursesCategoryLang;
use App\MenuBuilder\MegaMenuBase;

class CoursesMegaMenu extends MegaMenuBase
{

    function model(){
        return 'App\Course';
    }
    function render($ids,$lang,$settings)
    {
        //it will have all html markup for the mega menu
        $ids = explode(',',$ids);
        $output = '';
        if (empty($ids)){
            return $output;
        }
        $output .= $this->body_start();

        $mega_menu_items = Course::with(['lang_query' => function($query) use ($lang){
            $query->where('lang',$lang);
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
                $output .= '<li><a href="'.route($this->route(),[$slug,$post->id]).'">' . $title . '</a></li>'."\n";
            }
            $output .= '</ul>'."\n";
            $output .= '</div>'."\n";
            $output .= '</div>'."\n";
        }

        $output .= $this->body_end();
        // TODO: return all makrup data for render it to frontend
        return $output;
    }

    function category($id)
    {
        // TODO: Implement category() method.
        $category = CoursesCategoryLang::where(['cat_id' => $id])->first();
        return $category->title ?? __('Uncategorized');
    }

    function route()
    {
        // TODO: Implement route() method.
        return 'frontend.course.single';
    }

    function routeParams()
    {
        // TODO: Implement routeParams() method.
        return ['slug','id'];
    }

    function name()
    {
        // TODO: Implement name() method.
        return 'courses_page_[lang]_name';
    }

    function enable()
    {
        // TODO: Implement enable() method.
        return get_static_option('course_module_status');
    }

    function query_type()
    {
        // TODO: Implement query_type() method.
        return 'new_lang'; // old_lang|new_lang
    }
    function title_param()
    {
        // TODO: Implement title_param() method.
        return 'title';
    }
    function slug()
    {
        // TODO: Implement name() method.
        return 'courses_page_slug';
    }
}