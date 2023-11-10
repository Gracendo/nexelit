<?php

use App\Widgets;
use App\Menu;
use App\Blog;
use App\Services;
use App\Works;


/**
 * all widget will be here
 * */

/**
 * about us widgets
 * it will be used for drag & drop Widget Builder
 * */
function about_us_widget($type = 'new', $id = null)
{
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'about_us_widget', 'render_about_us_widget', 'About Us', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $image_val = !empty($widget_saved_values) ? $widget_saved_values['site_logo'] : '';
    $image_preview = '';
    if (!empty($widget_saved_values)) {
        $image_markup = render_image_markup_by_attachment_id($widget_saved_values['site_logo']);
        $image_preview = '<div class="attachment-preview"><div class="thumbnail"><div class="centered">' . $image_markup . '</div></div></div>';
    }
    $output .= '<div class="form-group"><label for="site_logo"><strong>' . __('Logo') . '</strong></label>';
    $output .= '<div class="media-upload-btn-wrapper"><div class="img-wrap">' . $image_preview . '</div><input type="hidden" id="site_logo" name="site_logo" value="' . $image_val . '">';
    $output .= '<button type="button" class="btn btn-info btn-xs media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">';
    $output .= __('Logo') . '</button></div>';
    $output .= '<small class="form-text text-muted">' . __('allowed image format: jpg,jpeg,png. Recommended image size 160x50') . '</small></div>';
    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-home-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';
    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-home-' . $lang->slug . '" role="tabpanel">';
        $description = !empty($widget_saved_values) && isset($widget_saved_values['description_' . $lang->slug]) ? $widget_saved_values['description_' . $lang->slug] : '';
        $output .= '<div class="form-group"><textarea name="description_' . $lang->slug . '" id="description_' . $lang->slug . '" class="form-control" cols="30" rows="5" placeholder="' . __('Description') . '">' . $description . '</textarea></div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}

/**
 * about us widgets
 * it will be used for render content in frontend
 * */
function render_about_us_widget($id)
{
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $description = !empty($widget_saved_values) && isset($widget_saved_values['description_' .get_user_lang()]) ? $widget_saved_values['description_' . get_user_lang()] : '';
    $image_val = !empty($widget_saved_values) ? $widget_saved_values['site_logo'] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget"><div class="about_us_widget">';
    $output .= render_image_markup_by_attachment_id($image_val,'footer-logo');
    $output .= '<p>'.$description.'</p>';
    $output .= '</div></div></div>';

    return $output;
}

/**
 * default filed
 * */
function get_widget_default_fields($type, $admin_func, $front_func, $widget_name, $id, $widget_order = null)
{

    $output = '';
    $action = $type == 'new' ? route('admin.widgets.new') : route('admin.widgets.update');
    $id = !empty($id) ? '<input type="hidden" name="id" value="' . $id . '">' : '';
    $output .= '<form method="post" action="' . $action . '" enctype="multipart/form-data"><input type="hidden" value="' . csrf_token() . '" name="_token">' . $id;
    $output .= '<input type="hidden" value="' . $front_func . '" name="frontend_render_function">';
    $output .= '<input type="hidden" value="' . $admin_func . '" name="admin_render_function">';
    $output .= '<input type="hidden" value="' . $type . '" name="widget_type">';
    $output .= '<input type="hidden" value="' . $widget_name . '" name="widget_name">';
    $output .= '<input type="hidden" value="' . $widget_order . '" name="widget_order">';

    return $output;
}


/**
 * contact us widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function contact_info_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'contact_info_widget', 'render_contact_info_widget', 'Contact Info', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-contact-info-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';
    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-contact-info-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_' . $lang->slug]) ? $widget_saved_values['widget_title_' . $lang->slug] : '';
        $location = !empty($widget_saved_values) && isset($widget_saved_values['location_' . $lang->slug]) ? $widget_saved_values['location_' . $lang->slug] : '';
        $phone = !empty($widget_saved_values) && isset($widget_saved_values['phone_' . $lang->slug]) ? $widget_saved_values['phone_' . $lang->slug] : '';
        $email = !empty($widget_saved_values) && isset($widget_saved_values['email_' . $lang->slug]) ? $widget_saved_values['email_' . $lang->slug] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" id="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
        $output .= '<div class="form-group"><input type="text" name="location_' . $lang->slug . '" id="location_' . $lang->slug . '" class="form-control" placeholder="' . __('Location') . '" value="'. $location .'"></div>';
        $output .= '<div class="form-group"><input type="text" name="phone_' . $lang->slug . '" id="phone_' . $lang->slug . '" class="form-control" placeholder="' . __('Phone') . '" value="'. $phone .'"></div>';
        $output .= '<div class="form-group"><input type="email" name="email_' . $lang->slug . '" id="email_' . $lang->slug . '" class="form-control" placeholder="' . __('Email') . '" value="'. $email .'"></div>';

        $output .= '</div>';
    }
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}


/**
 * contact us widgets
 * it will be used for render content in frontend
 * */
function render_contact_info_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_' . get_user_lang()]) ? $widget_saved_values['widget_title_' . get_user_lang()] : '';
    $location = !empty($widget_saved_values) && isset($widget_saved_values['location_' .get_user_lang()]) ? $widget_saved_values['location_' . get_user_lang()] : '';
    $phone = !empty($widget_saved_values) && isset($widget_saved_values['phone_' . get_user_lang()]) ? $widget_saved_values['phone_' . get_user_lang()] : '';
    $email = !empty($widget_saved_values) && isset($widget_saved_values['email_' . get_user_lang()]) ? $widget_saved_values['email_' . get_user_lang()] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<ul class="contact_info_list">';
    if(!empty($location)){
    $output .= ' <li class="single-info-item">
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="details">
                        '.$location.'
                    </div>
                </li>';
    }
    if(!empty($phone)){
    $output .= '<li class="single-info-item">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="details">
                       '.$phone.'
                    </div>
                </li>';
    }            
     if(!empty($email)){
     $output .= '<li class="single-info-item">
                    <div class="icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="details">
                       '.$email.'
                    </div>
                </li>';
     }            
    $output .= '</ul>';
    $output .= '</div></div>';

    return $output;
}


/**
 * navigation widget widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function navigation_menu_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'navigation_menu_widget', 'render_navigation_menu_widget', 'Navigation Menu', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-recent-post-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';

    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-recent-post-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. $lang->slug]) ? $widget_saved_values['widget_title_'. $lang->slug] : '';
        $selected_menu_id = !empty($widget_saved_values) && isset($widget_saved_values['menu_id_'. $lang->slug]) ? $widget_saved_values['menu_id_'. $lang->slug] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_'. $lang->slug . '" id="widget_title_'. $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';

        $output .= '<div class="form-group">';
        $output .= '<select class="form-control" name="menu_id_'. $lang->slug.'">';

        $navigation_menus = Menu::where(['lang' => $lang->slug])->get();

        foreach($navigation_menus as $menu_item){
            $selected = $selected_menu_id == $menu_item->id ? 'selected' : '';
            $output .= '<option value="'.$menu_item->id.'" '.$selected.'>'.$menu_item->title.'</option>';
        }
        $output .= '</select>';
        $output .= '</div>';

        $output .= '</div>';
    }
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}
/**
 * navigation menu widgets
 * it will be used for render content in frontend
 * */
function render_navigation_menu_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $menu_id = !empty($widget_saved_values) && isset($widget_saved_values['menu_id_'.get_user_lang()]) ? $widget_saved_values['menu_id_'. get_user_lang()] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<div class="widget-ul-wrapper">';
    $output .= '<ul>';
    $output .= render_menu_by_id($menu_id);
    $output .= '</ul>';
    $output .= '</div>';
    $output .= '</div></div>';

    return $output;
}

/**
 * recent post widget widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function recent_post_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'recent_post_widget', 'render_recent_post_widget', 'Recent Post', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-recent-post-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';

    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-recent-post-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. $lang->slug]) ? $widget_saved_values['widget_title_'. $lang->slug] : '';
        $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_'. $lang->slug . '" id="widget_title_'. $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
        $output .= '</div>';
    }
    $output .= '<div class="form-group"><input type="text" name="post_items" id="post_items" class="form-control" placeholder="' . __('Post Items') . '" value="'. $post_items .'"></div>';
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}
/**
 * recent post widgets
 * it will be used for render content in frontend
 * */
function render_recent_post_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';
    $blog_posts = Blog::where(['lang' => get_user_lang(),'status' => 'publish'])->orderBy('id','DESC')->take($post_items)->get();
    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<ul class="recent_post_item">';

    foreach ($blog_posts as $post){
        $output .= '<li class="single-recent-post-item">
                    <div class="thumb">'.render_image_markup_by_attachment_id($post->image,'','thumb').'</div>
                    <div class="content">
                        <h4 class="title"><a href="'.route('frontend.blog.single',$post->slug).'">'.$post->title.'</a></h4>
                        <span class="time"> '.date_format($post->created_at,'D M Y').'</span>
                    </div>
                </li>';
    }
    $output .= '</ul>';
    $output .= '</div></div>';

    return $output;
}


/**
 * recent service widget widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function recent_service_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'recent_service_widget', 'render_recent_service_widget', 'Recent Services', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-recent-service-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';

    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-recent-service-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. $lang->slug]) ? $widget_saved_values['widget_title_'. $lang->slug] : '';
        $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_'. $lang->slug . '" id="widget_title_'. $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
        $output .= '</div>';
    }
    $output .= '<div class="form-group"><input type="text" name="post_items" id="post_items" class="form-control" placeholder="' . __('Post Items') . '" value="'. $post_items .'"></div>';
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}

/**
 * recent services widgets
 * it will be used for render content in frontend
 * */
function render_recent_service_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';
    $service_posts = Services::where(['lang' => get_user_lang(),'status' => 'publish'])->orderBy('id','DESC')->take($post_items)->get();
    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<ul class="recent_post_item">';

    foreach ($service_posts as $service){
        $output .= '<li class="single-recent-post-item">
                    <div class="thumb">'.render_image_markup_by_attachment_id($service->image,'','thumb').'</div>
                    <div class="content">
                        <h4 class="title"><a href="'.route('frontend.services.single',$service->slug).'">'.$service->title.'</a></h4>
                        <span class="time"> '.date_format($service->created_at,'D M Y').'</span>
                    </div>
                </li>';
    }
    $output .= '</ul>';
    $output .= '</div></div>';

    return $output;
}


/**
 * recent service widget widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function recent_case_study_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'recent_case_study_widget', 'render_recent_case_study_widget', 'Recent Case Study', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-recent-case-study-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';

    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-recent-case-study-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. $lang->slug]) ? $widget_saved_values['widget_title_'. $lang->slug] : '';
        $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_'. $lang->slug . '" id="widget_title_'. $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
        $output .= '</div>';
    }
    $output .= '<div class="form-group"><input type="text" name="post_items" id="post_items" class="form-control" placeholder="' . __('Post Items') . '" value="'. $post_items .'"></div>';
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}


/**
 * recent case study widgets
 * it will be used for render content in frontend
 * */
function render_recent_case_study_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $post_items = !empty($widget_saved_values) && isset($widget_saved_values['post_items']) ? $widget_saved_values['post_items'] : '';
    $service_posts = Works::where(['lang' => get_user_lang(),'status' => 'publish'])->orderBy('id','DESC')->take($post_items)->get();
    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<ul class="recent_post_item">';

    foreach ($service_posts as $service){
        $output .= '<li class="single-recent-post-item">
                    <div class="thumb">'.render_image_markup_by_attachment_id($service->image,'','thumb').'</div>
                    <div class="content">
                        <h4 class="title"><a href="'.route('frontend.work.single',$service->slug).'">'.$service->title.'</a></h4>
                        <span class="time"> '.date_format($service->created_at,'D M Y').'</span>
                    </div>
                </li>';
    }
    $output .= '</ul>';
    $output .= '</div></div>';

    return $output;
}



/**
 * newsletter widget widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function newsletter_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'newsletter_widget', 'render_newsletter_widget', 'Newsletter', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    //start multi langual tab option
    $all_languages = get_all_language();
    $output .= '<nav><div class="nav nav-tabs" role="tablist">';
    foreach ($all_languages as $key => $lang) {
        $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
        $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-newsletter-' . $lang->slug . '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
    }
    $output .= '</div></nav>';

    $output .= '<div class="tab-content margin-top-30" >';

    foreach ($all_languages as $key => $lang) {
        $active_tab_class = $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade';
        $output .= '<div class="' . $active_tab_class . '" id="nav-newsletter-' . $lang->slug . '" role="tabpanel">';
        $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. $lang->slug]) ? $widget_saved_values['widget_title_'. $lang->slug] : '';
        $description = !empty($widget_saved_values) && isset($widget_saved_values['description_'. $lang->slug]) ? $widget_saved_values['description_'. $lang->slug] : '';

        $output .= '<div class="form-group"><input type="text" name="widget_title_'. $lang->slug . '" id="widget_title_'. $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
        $output .= '<div class="form-group"><input type="text" name="description_'.$lang->slug.'" id="description_'.$lang->slug.'" class="form-control" placeholder="' . __('Description') . '" value="'. $description .'"></div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}

/**
 * newsletter widgets
 * it will be used for render content in frontend
 * */
function render_newsletter_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $description = !empty($widget_saved_values) && isset($widget_saved_values['description_'.get_user_lang()]) ? $widget_saved_values['description_'.get_user_lang()] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget newsletter-widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<p>'.$description.'</p>';
    $output .= '<div class="form-message-show"></div><div class="newsletter-form-wrap">';

    $output .= '<form action="'.route('frontend.subscribe.newsletter').'" method="post" enctype="multipart/form-data">';

    $output .= '<input type="hidden" name="_token" value="'.csrf_token().'">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="'.__('your email').'" class="form-control">
                    </div>
                    <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i></button>
                </form>';

    $output .= '</div></div></div>';

    return $output;
}

/**
 * raw HTML widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function raw_html_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'raw_html_widget', 'render_raw_html_widget', 'Raw HTML', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $raw_html = !empty($widget_saved_values) && isset($widget_saved_values['raw_html']) ? $widget_saved_values['raw_html'] : '';

    $output .= '<div class="form-group">';
    $output .= '<textarea name="raw_html" class="form-control custom_html_area" cols="30" rows="10">'.$raw_html.'</textarea>';
    $output .= '</div>';
    //end multi langual tab option
    $output .= '<button class="btn btn-info btn-xs widget_save_change_button">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}


/**
 * raw html  widgets
 * it will be used for render content in frontend
 * */
function render_raw_html_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $raw_html = !empty($widget_saved_values) && isset($widget_saved_values['raw_html']) ? $widget_saved_values['raw_html'] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget newsletter-widget">';
    $output .= '<div class="custom-html-widget">'.$raw_html.'</div>';

    $output .= '</div></div>';

    return $output;
}



/**
 * Image widget admin function
 * it will be used for drag & drop Widget Builder
 * **/

function single_image_widget($type = 'new', $id = null){
    $output = '';
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_order = !empty($widget_data) ? $widget_data->widget_order : '';
    $output .= get_widget_default_fields($type, 'single_image_widget', 'render_single_image_widget', 'Image', $id, $widget_order);

    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';

    $image_val = !empty($widget_saved_values) ? $widget_saved_values['single_image'] : '';
    $image_preview = '';
    if (!empty($widget_saved_values)) {
        $image_markup = render_image_markup_by_attachment_id($widget_saved_values['single_image']);
        $image_preview = '<div class="attachment-preview"><div class="thumbnail"><div class="centered">' . $image_markup . '</div></div></div>';
    }
    $output .= '<div class="form-group"><label for="single_image"><strong>' . __('Image') . '</strong></label>';
    $output .= '<div class="media-upload-btn-wrapper"><div class="img-wrap">' . $image_preview . '</div><input type="hidden" name="single_image" value="' . $image_val . '">';
    $output .= '<button type="button" class="btn btn-info btn-xs media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">';
    $output .= __('Select Image') . '</button></div></div>';

    $output .= '<button class="btn btn-info btn-xs widget_save_change_button margin-top-40">' . __('Save Changes') . '</button>';
    $output .= '</form>';

    return $output;
}


/**
 * image widgets
 * it will be used for render content in frontend
 * */
function render_single_image_widget($id){
    $widget_data = !empty($id) ? Widgets::find($id) : '';
    $widget_saved_values = !empty($widget_data) ? unserialize($widget_data->widget_content) : '';
    $widget_title = !empty($widget_saved_values) && isset($widget_saved_values['widget_title_'. get_user_lang()]) ? $widget_saved_values['widget_title_'. get_user_lang()] : '';
    $image_val = !empty($widget_saved_values) ? $widget_saved_values['single_image'] : '';

    $output = '<div class="col-lg-3 col-md-6"><div class="footer-widget widget">';
    if (!empty($widget_title)){
        $output .= '<h4 class="widget-title">'.$widget_title.'</h4>';
    }
    $output .= '<div class="single-wrap">';
    $output .= render_image_markup_by_attachment_id($image_val,'footer-logo');
    $output .= '</div></div></div>';

    return $output;
}
