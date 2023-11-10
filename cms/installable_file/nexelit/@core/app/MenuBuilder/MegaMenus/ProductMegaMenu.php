<?php


namespace App\MenuBuilder\MegaMenus;


use App\MenuBuilder\MegaMenuBase;
use App\ProductCategory;
use App\Products;

class ProductMegaMenu extends MegaMenuBase
{

    function model(){
        return 'App\Products';
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

        $mega_menu_items = Products::whereIn('id',$ids)->get()->groupBy('category_id');
        if ($settings['sort_by'] === 'asc'){
            $mega_menu_items->sortBy($settings['sort']);
        }else {
            $mega_menu_items ->sortByDesc($settings['sort']);
        }
        foreach ($mega_menu_items as $cat => $posts) {
            $output .= '<div class="col-lg-3 col-md-6">' ."\n";
            $output .= '<div class="xg-mega-menu-single-column-wrap">'."\n";
            if (!empty($settings['category_status'])){
                $output .= '<h4 class="mega-menu-title"> <a href="'.route('frontend.products.category',['id' => $cat, 'any' => $this->category($cat)]).'">' . $this->category($cat). '</a></h4>'."\n";
            }

            $output .= '<ul>'."\n";
            foreach ($posts as $post) {

                $output .= '<li class="single-mega-menu-product-item">';
                $output .= '<div class="thumbnail"><a href="'.route($this->route(),$post->slug).'">'.render_image_markup_by_attachment_id($post->image,'','thumb').'</a></div>';
                $output .= '<div class="content">';
                $output .= '<a href="'.route($this->route(),$post->slug).'"><h4 class="title">'.$post->title.'</h4></a>';
                $sale_price = $post->sale_price == 0 ? __("Free") : amount_with_currency_symbol($post->sale_price);
                $output .= '<div class="price-wrap"><span class="price">'.$sale_price.'</span>';
                if(!empty($post->regular_price)){
                    $output .= '<del class="del-price">'.amount_with_currency_symbol($post->regular_price).'</del>';
                }
                $output .= '</div></div>';
                $output .= '</li>';
            }
            $output .= '</ul>'."\n";
            $output .= '</div>'."\n";
            $output .= '</div>'."\n";
        }

        $output .= $this->body_end();
        // TODO: return all makrup data for render it to frontend
        return $output;
    }
    function slug()
    {
        // TODO: Implement name() method.
        return 'product_page_slug';
    }

    function category($id)
    {
        $category = ProductCategory::where(['id' => $id])->first();
        return $category->title ?? __('Uncategorized');
    }

    function route()
    {
        // TODO: Implement route() method.
        return 'frontend.products.single';
    }

    function routeParams()
    {
        // TODO: Implement routeParams() method.
        return ['slug'];
    }

    function name()
    {
        // TODO: Implement name() method.
        return 'product_page_[lang]_name';
    }
    function enable()
    {
        // TODO: Implement enable() method.
        return get_static_option('product_module_status');
    }
    function query_type()
    {
        // TODO: Implement query_type() method.
        return 'old_lang'; // old_lang|new_lang
    }
    function title_param()
    {
        // TODO: Implement title_param() method.
        return 'title';
    }
}