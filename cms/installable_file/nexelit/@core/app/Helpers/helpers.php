<?php

use App\CourseCoupon;
use App\Language;
use App\Menu;
use App\ProductRatings;
use App\StaticOption;
use App\WorksCategory;
use App\Works;
use Illuminate\Support\Facades\Auth;
use App\MediaUpload;
use App\Page;
use Illuminate\Support\Facades\Session;


function active_menu($url)
{
    return $url == request()->path() ? 'active' : '';
}

function active_menu_frontend($url)
{

    return $url == request()->path() ? 'current-menu-item' : '';
}


function check_image_extension($file)
{
    $extension = strtolower($file->getClientOriginalExtension());
    if (!in_array($extension,['jpg','jpeg','png','gif'])) {
        return false;
    }
    return true;
}


function set_static_option($key, $value)
{
    if (!StaticOption::where('option_name', $key)->first()) {
        StaticOption::create([
            'option_name' => $key,
            'option_value' => $value
        ]);
        return true;
    }
    return false;
}

function get_static_option($key,$default = null)
{
    global $option_name;
    $option_name = $key;
    $value = \Illuminate\Support\Facades\Cache::remember($option_name,6400, function () {
        global $option_name;
        return StaticOption::where('option_name', $option_name)->first();
    });

    return $value->option_value ?? $default;
}

function update_static_option($key, $value)
{
    $static_option = null;
    if ($static_option === null){
        $static_option = StaticOption::query();
    }
    $static_option->updateOrCreate(['option_name' => $key],[
        'option_name' => $key,
        'option_value' => $value
    ]);
    \Illuminate\Support\Facades\Cache::forget($key);
    return true;
}

function delete_static_option($key)
{
    return StaticOption::where('option_name', $key)->delete();
}

function single_post_share($url, $title, $img_url)
{
    $output = '';
    //get current page url
    $encoded_url = urlencode($url);
    //get current page title
    $post_title = str_replace(' ', '%20', $title);

    //all social share link generate
    $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url;
    $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $encoded_url . '&amp;via=' . get_static_option('site_' . get_default_language() . '_title');
    $linkedin_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $encoded_url . '&amp;title=' . $post_title;
    $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url=' . $encoded_url . '&amp;media=' . $img_url . '&amp;description=' . $post_title;

    $output .= '<li><a class="facebook" href="' . $facebook_share_link . '"><i class="fab fa-facebook-f"></i></a></li>';
    $output .= '<li><a class="twitter" href="' . $twitter_share_link . '"><i class="fab fa-twitter"></i></a></li>';
    $output .= '<li><a class="linkedin" href="' . $linkedin_share_link . '"><i class="fab fa-linkedin-in"></i></a></li>';
    $output .= '<li><a class="pinterest" href="' . $pinterest_share_link . '"><i class="fab fa-pinterest-p"></i></a></li>';

    return $output;
}


function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}


function licnese_cheker()
{
    $data = array(
        'action' => env('XGENIOUS_API_ACTION'),
        'purchase_code' => get_static_option('item_purchase_key'),
        'author' => env('XGENIOUS_API_AUTHOR'),
        'site_url' => url('/'),
        'item_unique_key' => env('XGENIOUS_API_KEY'),
    );
    //item_license_status
    $api_url = env('XGENIOUS_API_URL') . '?' . http_build_query($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);
	//nulled
	$result = '{"license_status":"verified","msg":"Valid!"}';
    $result = json_decode($result);
    update_static_option('item_license_status', $result->license_status);
    $type = 'verified' == $result->license_status ? 'success' : 'danger';
    $license_info = [
        "item_license_status" => $result->license_status,
        "last_check" => time(),
        "purchase_code" => get_static_option('item_purchase_key'),
        "xgenious_app_key" => env('XGENIOUS_API_KEY'),
        "author" => env('XGENIOUS_API_AUTHOR'),
        "message" => $result->message
    ];
    file_put_contents('@core/license.json', json_encode($license_info));
}

function get_work_category_by_id($id, $output = 'array')
{
    $category_id = Works::find($id)->categories_id;
    $cat_list = [];
    $cat_list_string = '';
    $cat_list_slug = '';

    foreach ($category_id as $key => $data) {
        $separator = $key != 0 ? ', ' : '';
        $cat_item = WorksCategory::find($data);
        if (!empty($cat_item)){
            $cat_list[$cat_item->id] = $cat_item->name;
            $cat_list_string .= $separator . $cat_item->name;
            $cat_list_slug .= Str::slug($cat_item->name) . ' ';
        }

    }
    switch ($output) {
        case ("string"):
            return $cat_list_string;
            break;
        case ("slug"):
            return $cat_list_slug;
            break;
        default:
            return $cat_list;
            break;
    }
}

function get_child_menu_count($menu_content, $parent_id)
{
    $return_val = 0;
    foreach ($menu_content as $data) {
        if ($parent_id == $data->parent_id) {
            $return_val++;
        }
    }
    return $return_val;
}

function minify_css_lines($css)
{
    // some of the following functions to minimize the css-output are directly taken
    // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
    // all credits to Christian Schaefer: http://twitter.com/derSchepp
    // remove comments
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
    // backup values within single or double quotes
    preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
    for ($i = 0, $iMax = count($hit[1]); $i < $iMax; $i++) {
        $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
    }
    // remove traling semicolon of selector's last property
    $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
    // remove any whitespace between semicolon and property-name
    $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
    // remove any whitespace surrounding property-colon
    $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
    // remove any whitespace surrounding selector-comma
    $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
    // remove any whitespace surrounding opening parenthesis
    $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
    // remove any whitespace between numbers and units
    $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
    // shorten zero-values
    $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
    // constrain multiple whitespaces
    $css = preg_replace('/\p{Zs}+/ims', ' ', $css);
    // remove newlines
    $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
    // Restore backupped values within single or double quotes
    for ($i = 0, $iMax = count($hit[1]); $i < $iMax; $i++) {
        $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
    }

    return $css;
}

function google_captcha_check($token)
{
    if(empty(get_static_option('site_google_captcha_status'))){
        return ['success' => true];
    }
    $captha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $captha_url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('secret' => get_static_option('site_google_captcha_v3_secret_key'), 'response' => $token)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);
    return $result;
}
function load_google_fonts()
{
    //google fonts link;
    $fonts_url = 'https://fonts.googleapis.com/css2?family=';
    //body fonts
    $body_font_family = get_static_option('body_font_family') ?? 'Open Sans';
    $heading_font_family = get_static_option('heading_font_family') ??  'Montserrat';



    $load_body_font_family = str_replace(' ', '+', $body_font_family);
    $body_font_variant = get_static_option('body_font_variant');
    $body_font_variant_selected_arr = !empty($body_font_variant) ? unserialize($body_font_variant,['class' => false]) : ['400'];
    $load_body_font_variant = is_array($body_font_variant_selected_arr) ? implode(';', $body_font_variant_selected_arr) : '400';

    $body_italic = '';
    preg_match('/1,/',$load_body_font_variant,$match);
    if(count($match) > 0){
        $body_italic =  'ital,';
    }else{
        $load_body_font_variant = str_replace('0,','',$load_body_font_variant);
    }

    $fonts_url .= $load_body_font_family . ':'.$body_italic.'wght@' . $load_body_font_variant;
    $load_heading_font_family = str_replace(' ', '+', $heading_font_family);
    $heading_font_variant = get_static_option('heading_font_variant');
    $heading_font_variant_selected_arr = !empty($heading_font_variant) ? unserialize($heading_font_variant,['class' => false]) : ['400'];
    $load_heading_font_variant = is_array($heading_font_variant_selected_arr) ? implode(';', $heading_font_variant_selected_arr) : '400';

    if (!empty(get_static_option('heading_font')) && $heading_font_family != $body_font_family) {

        $heading_italic = '';
        preg_match('/1,/',$load_heading_font_variant,$match);
        if(count($match) > 0){
            $heading_italic =  'ital,';
        }else{
            $load_heading_font_variant = str_replace('0,','',$load_heading_font_variant);
        }

        $fonts_url .= '&family=' . $load_heading_font_family . ':'.$heading_italic.'wght@' . $load_heading_font_variant;
    }

    return sprintf('<link rel="preconnect" href="https://fonts.gstatic.com"> <link href="%1$s&display=swap" rel="stylesheet">', $fonts_url);
}

function get_language_by_slug($slug)
{
    $lang_details = \App\Language::where('slug', $slug)->first();
    return !empty($lang_details) ? $lang_details->name : '';
}

function get_default_language()
{
    return \App\Helpers\LanguageHelper::default_slug();
}

function get_all_language()
{
    return \App\Helpers\LanguageHelper::all_languages();
}

function get_user_lang()
{
    return \App\Helpers\LanguageHelper::user_lang_slug();
}

function get_user_lang_direction()
{
    return \App\Helpers\LanguageHelper::user_lang_dir();
}

function get_field_by_type($type, $name, $placeholder, $options = [], $requried = null, $mimes = null)
{
    $markup = '';
    $placeholder = __($placeholder);
    $required_markup_html = 'required="required"';
    switch ($type) {
        case('email'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group"> <input type="email" id="' . $name . '" name="' . $name . '" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></div>';
            break;
        case('tel'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group"> <input type="tel" id="' . $name . '" name="' . $name . '" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></div>';
            break;
        case('date'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group"> <input type="date" id="' . $name . '" name="' . $name . '" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></div>';
            break;
        case('url'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group"> <input type="url" id="' . $name . '" name="' . $name . '" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></div>';
            break;
        case('textarea'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group textarea"><textarea name="' . $name . '" id="' . $name . '" cols="30" rows="10" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></textarea></div>';
            break;
        case('file'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $mimes_type_markup = str_replace('mimes:', __('Accept File Type:') . ' ', $mimes);
            $markup = ' <div class="form-group file"> <label for="' . $name . '">' . __($placeholder) . '</label> <input type="file" id="' . $name . '" name="' . $name . '" ' . $required_markup . ' class="form-control" > <span class="help-info">' . $mimes_type_markup . '</span></div>';
            break;
        case('checkbox'):
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group checkbox">  <input type="checkbox" id="' . $name . '" name="' . $name . '" class="form-control" ' . $required_markup . '> <label for="' . $name . '">' . __($placeholder) . '</label></div>';
            break;
        case('select'):
            $option_markup = '';
            $required_markup = !empty($requried) ? $required_markup_html : '';
            foreach ($options as $opt) {
                $option_markup .= '<option value="' . Str::slug($opt) . '">' . $opt . '</option>';
            }
            $markup = ' <div class="form-group select"> <label for="' . $name . '">' . __($placeholder) . '</label> <select id="' . $name . '" name="' . $name . '" class="form-control" ' . $required_markup . '>' . $option_markup . '</select></div>';
            break;
        default:
            $required_markup = !empty($requried) ? $required_markup_html : '';
            $markup = ' <div class="form-group"> <input type="text" id="' . $name . '" name="' . $name . '" class="form-control" placeholder="' . __($placeholder) . '" ' . $required_markup . '></div>';
            break;
    }

    return $markup;
}

function check_page_permission($page)
{
    if (Auth::check()) {
        $id = auth()->user()->id;
        $role_id = \App\Admin::where('id', $id)->first();
        $user_role = \App\AdminRole::where('id', $role_id->role)->first();
        if ($user_role){
            $all_permission = json_decode($user_role->permission);
            if (in_array($page, $all_permission)) {
                return true;
            }
        }

    }
    return false;
}
function check_page_permission_by_string($page)
{
    $page = strtolower(str_replace(' ','_',$page));
    if (Auth::check()) {
        $id = auth()->user()->id;
        $role_id = \App\Admin::where('id', $id)->first();
        $user_role = \App\AdminRole::where('id', $role_id->role)->first();
        if ($user_role){
            $all_permission = json_decode($user_role->permission);
            if (in_array($page, $all_permission)) {
                return true;
            }
        }
    }
    return false;
}


function get_user_role_name_by_id($id)
{
    $name = \App\AdminRole::where('id', $id)->first();
    return $name->name;
}

function get_topic_name_by_id($id)
{
    $name = \App\KnowledgebaseTopic::where('id', $id)->first();
    return !empty($name) ? $name->title : '';
}

/*
 * php delete function that deals with directories recursively
 */
function delete_dir_with_file($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            delete_dir_with_file($file);
        }

        if (file_exists($target)) {
            rmdir($target);
        }
    } elseif (is_file($target)) {
        unlink($target);
    }
}

function chmod_r($path)
{
    if (is_dir($path)) {
        $files = glob($path . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            chmod($file, 0777);
        }

    } elseif (is_file($path)) {
        chmod($path, 0777);
    }
}

function chmod_file_folder($dir)
{
    $dh = @opendir($dir);
    chmod($dir, 0777);
    if ($dh) {

        while (false !== ($file = readdir($dh))) {

            if ($file != "." && $file != "..") {

                $fullpath = $dir . '/' . $file;
                if (!is_dir($fullpath)) {
                    chmod($fullpath, 0777);
                } else {
                    if (chmod($fullpath, 0777)) {
                        chmod_file_folder($fullpath);
                    }
                }
            }
        }
        closedir($dh);
    }
}

function copy_dir_with_files($src, $dst)
{

    // open the source directory
    $dir = opendir($src);

    // Make the destination directory if not exist
    @mkdir($dst);

    // Loop through the files in source directory
    while ($file = readdir($dir)) {

        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {

                // Recursively calling custom copy function
                // for sub directory
                custom_copy($src . '/' . $file, $dst . '/' . $file);

            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }

    closedir($dir);
}

function get_attachment_image_by_id($id, $size = null, $default = false)
{
    $image_details = MediaUpload::find($id);
    $return_val = [];
    $image_url = '';

    if (!empty($id) && !empty($image_details)) {
        $image_url = asset('assets/uploads/media-uploader/' . $image_details->path);
        switch ($size) {
            case "large":
                if (file_exists('assets/uploads/media-uploader/large-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/large-' . $image_details->path);
                }
                break;
            case "grid":
                if (file_exists('assets/uploads/media-uploader/grid-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image_details->path);
                }
                break;
            case "thumb":
                if (file_exists('assets/uploads/media-uploader/thumb-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/thumb-' . $image_details->path);
                }
                break;
            default:
                if (is_numeric($id) && file_exists('assets/uploads/media-uploader/' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/' . $image_details->path);
                }
                break;
        }
    }

    if (!empty($image_details)) {
        $return_val['image_id'] = $image_details->id;
        $return_val['path'] = $image_details->path;
        $return_val['img_url'] = $image_url;
        $return_val['img_alt'] = $image_details->alt;
    } elseif (empty($image_details) && $default) {
        $return_val['img_url'] = asset('assets/uploads/no-image.png');
    }

    return $return_val;
}

function render_ratings($ratings)
{
    $return_val = '';
    switch ($ratings) {
        case(1):
            $return_val = '<i class="fas fa-star"></i>';
            break;
        case(2):
            $return_val = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case(3):
            $return_val = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case(4):
            $return_val = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case(5):
            $return_val = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        default:
            break;
    }
    return $return_val;
}

function get_product_ratings_avg_by_id($id)
{
    $average_ratings = ProductRatings::Where('product_id', $id)->pluck('ratings')->avg();
    return $average_ratings;
}
function get_appointment_ratings_avg_by_id($id)
{
    $average_ratings = \App\AppointmentReview::Where('appointment_id', $id)->pluck('ratings')->avg();
    return $average_ratings;
}
function get_course_ratings_avg_by_id($id)
{
    $average_ratings = \App\CourseReview::Where('course_id', $id)->pluck('ratings')->avg();
    return $average_ratings;
}


function setEnvValue(array $values)
{

    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {

            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
        }
    }

    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str)) return false;
    return true;
}

 function course_discounted_amount($price, $coupon)
{
    //have to write code for get discounted price
    $return_val = $price;
    if (!empty($coupon)) {
        $coupon_details = CourseCoupon::where('code', $coupon)->first();
        if (!empty($coupon_details)) {
            if ($coupon_details->discount_type === 'percentage') {
                $discount_bal = ($price / 100) * (int)$coupon_details->discount;
                $return_val = $price - $discount_bal;
            } elseif ($coupon_details->discount_type === 'amount') {
                $return_val = $price - (int)$coupon_details->discount;
            }
        }
    }

    return $return_val;
}

function getJson($url)
{
    // cache files are created like cache/abcdef123456...
    $cacheFile = 'cache' . DIRECTORY_SEPARATOR . md5($url);

    if (file_exists($cacheFile)) {
        $fh = fopen($cacheFile, 'r');
        $cacheTime = trim(fgets($fh));

        // if data was cached recently, return cached data
        if ($cacheTime > strtotime('-60 minutes')) {
            return fread($fh);
        }

        // else delete cache file
        fclose($fh);
        unlink($cacheFile);
    }

    $json = file_get_contents($url);

    $fh = fopen($cacheFile, 'w');
    fwrite($fh, time() . "\n");
    fwrite($fh, $json);
    fclose($fh);

    return $json;
}

function render_image_markup_by_attachment_id($id, $class = null, $size = 'full')
{
    if (empty($id)) return '';
    $output = '';

    $image_details = get_attachment_image_by_id($id, $size);
    if (!empty($image_details)) {
        $class_list = !empty($class) ? 'class="' . $class . '"' : '';
        $output = '<img src="' . $image_details['img_url'] . '" ' . $class_list . ' alt="'.$image_details['img_alt'].'"/>';
    }
    return $output;
}

function render_background_image_markup_by_attachment_id($id, $size = 'full')
{
    if (empty($id)) return '';
    $output = '';

    $image_details = get_attachment_image_by_id($id, $size);
    if (!empty($image_details)) {
        $output = 'style="background-image: url(' . $image_details['img_url'] . ');"';
    }
    return $output;
}

function render_og_meta_image_by_attachment_id($id, $size = 'full')
{
    if (empty($id)) return '';
    $output = '';

    $image_details = get_attachment_image_by_id($id, $size);
    if (!empty($image_details)) {
        $output = ' <meta property="og:image" content="' . $image_details['img_url'] . '" />';
    }
    return $output;
}


function render_embed_google_map($address, $zoom = 10)
{
    if (empty($address)) {
        return;
    }
    printf(
        '<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
        rawurlencode($address),
        $zoom,
        $address
    );
}

function render_drag_drop_form_builder_markup($content = '')
{
    $output = '';

    $form_fields = json_decode($content);
    $output .= '<ul id="sortable" class="available-form-field main-fields">';
    if (!empty($form_fields)) {
        $select_index = 0;
        foreach ($form_fields->field_type as $key => $ftype) {
            $args = [];
            $required_field = '';
            if (property_exists($form_fields, 'field_required')) {
                $filed_requirement = (array)$form_fields->field_required;
                $required_field = !empty($filed_requirement[$key]) ? 'on' : '';
            }
            if ($ftype == 'select') {
                $args['select_option'] = isset($form_fields->select_options[$select_index]) ? $form_fields->select_options[$select_index] : '';
                $select_index++;
            }
            if ($ftype == 'file') {
                $mime_type = (object) $form_fields->mimes_type;
                $args['mimes_type'] = isset($mime_type->$key) ? $mime_type->$key : '';

            }
            $output .= render_drag_drop_form_builder_field_markup($key, $ftype, $form_fields->field_name[$key], $form_fields->field_placeholder[$key], $required_field, $args);
        }
    } else {
        $output .= render_drag_drop_form_builder_field_markup('1', 'text', 'your-name', 'Your Name', '');
    }

    $output .= '</ul>';
    return $output;
}

function render_drag_drop_form_builder_field_markup($key, $type, $name, $placeholder, $required, $args = [])
{
    $required_check = !empty($required) ? 'checked' : '';
    $output = '<li class="ui-state-default">
                     <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    <span class="remove-fields">x</span>
                    <a data-toggle="collapse" href="#fileds_collapse_' . $key . '" role="button"
                       aria-expanded="false" aria-controls="collapseExample">
                        ' . ucfirst($type) . ': <span
                                class="placeholder-name">' . $placeholder . '</span>
                    </a>';
    $output .= '<div class="collapse" id="fileds_collapse_' . $key . '">
            <div class="card card-body margin-top-30">
                <input type="hidden" class="form-control" name="field_type[]"
                       value="' . $type . '">
                <div class="form-group">
                    <label>' . __('Name') . '</label>
                    <input type="text" class="form-control " name="field_name[]"
                           placeholder="' . __('enter field name') . '"
                           value="' . $name . '" >
                </div>
                <div class="form-group">
                    <label>' . __('Placeholder/Label') . '</label>
                    <input type="text" class="form-control field-placeholder"
                           name="field_placeholder[]" placeholder="' . __('enter field placeholder/label') . '"
                           value="' . $placeholder . '" >
                </div>
                <div class="form-group">
                    <label ><strong>' . __('Required') . '</strong></label>
                    <label class="switch">
                        <input type="checkbox" class="field-required" ' . $required_check . ' name="field_required[' . $key . ']">
                        <span class="slider onff"></span>
                    </label>
                </div>';
    if ($type == 'select') {
        $output .= '<div class="form-group">
                        <label>' . __('Options') . '</label>
                            <textarea name="select_options[]" class="form-control max-height-120" cols="30" rows="10"
                                required>' . $args['select_option'] . '</textarea>
                           <small>' . __('separate option by new line') . '</small>
                    </div>';
    }
    if ($type == 'file') {
        $output .= '<div class="form-group"><label>' . __('File Type') . '</label><select name="mimes_type[' . $key . ']" class="form-control mime-type">';
        $output .= '<option value="mimes:jpg,jpeg,png"';
        if (isset($args['mimes_type']) && $args['mimes_type'] == 'mimes:jpg,jpeg,png') {
            $output .= 'selected="selected"';
        }
        $output .= '>' . __('mimes:jpg,jpeg,png') . '</option>';

        $output .= '<option value="mimes:txt,pdf"';
        if (isset($args['mimes_type']) && $args['mimes_type'] == 'mimes:txt,pdf') {
            $output .= ' selected="selected" ';
        }
        $output .= '>' . __('mimes:txt,pdf') . '</option>';
        $output .= '<option value="mimes:doc,docx"';
        if (isset($args['mimes_type']) && $args['mimes_type'] == 'mimes:doc,docx') {
            $output .= 'selected="selected"';
        }
        $output .= '>' . __('mimes:doc,docx') . '</option>';
        $output .= '<option value="mimes:doc,docx,txt,pdf,jpg,jpeg,png"';
        if (isset($args['mimes_type']) && $args['mimes_type'] == 'mimes:doc,docx,txt,pdf,jpg,jpeg,png') {
            $output .= 'selected="selected"';
        }
        $output .= '>' . __('mimes:doc,docx,txt,pdf,jpg,jpeg,png') . '</option>';
        $output .= '</select></div>';
    }
    $output .= '</div></div></li>';

    return $output;
}


function render_form_field_for_frontend($form_content)
{
    if (empty($form_content)) {
        return;
    }
    $output = '';
    $form_fields = json_decode($form_content);
    $select_index = 0;
    $options = [];

    foreach ($form_fields->field_type as $key => $value) {
        if (!empty($value)) {
            if ($value == 'select') {
                $options = explode("\n", $form_fields->select_options[$select_index]);
            }
            $required = isset($form_fields->field_required->$key) ? $form_fields->field_required->$key : '';
            $mimes_type = (object) optional($form_fields)->mimes_type;
            $mimes = isset($mimes_type->$key) ? $mimes_type->$key : '';
            $output .= get_field_by_type($value, $form_fields->field_name[$key], $form_fields->field_placeholder[$key], $options, $required, $mimes);
            if ($value == 'select') {
                $select_index++;
            };
        }
    }

    return $output;
}


function render_favicon_by_id($id)
{

    $site_favicon = get_attachment_image_by_id($id, "full", false);
    $output = '';
    if (!empty($site_favicon)) {
        $output .= '<link rel="icon" href="' . $site_favicon['img_url'] . '" type="image/png">';
    }
    return $output;
}

function get_user_name_by_id($id)
{
    $user = \App\User::find($id);
    return $user;
}

function get_price_plan_category_name_by_id($id)
{
    $cat = \App\PricePlanCategory::findOrFail($id);
    return $cat->name;
}

function get_percentage($amount, $numb)
{
    if ($amount > 0) {
        return round($numb / ($amount / 100), 2);
    }
    return 0;
}

function get_cart_items()
{
    $old_cart_item = session()->get('cart_item');
    $return_val = !empty($old_cart_item) ? $old_cart_item : [];

    return $return_val;
}

function render_cart_table()
{
    $ajax_preloader = '<div class="ajax-loading-wrap hide">
                        <div class="sk-fading-circle">
                            <div class="sk-circle1 sk-circle"></div>
                            <div class="sk-circle2 sk-circle"></div>
                            <div class="sk-circle3 sk-circle"></div>
                            <div class="sk-circle4 sk-circle"></div>
                            <div class="sk-circle5 sk-circle"></div>
                            <div class="sk-circle6 sk-circle"></div>
                            <div class="sk-circle7 sk-circle"></div>
                            <div class="sk-circle8 sk-circle"></div>
                            <div class="sk-circle9 sk-circle"></div>
                            <div class="sk-circle10 sk-circle"></div>
                            <div class="sk-circle11 sk-circle"></div>
                            <div class="sk-circle12 sk-circle"></div>
                        </div>
                    </div>';

    $output = '';
    $all_cart_item = session()->get('cart_item');
    if (!empty($all_cart_item)) {
        $output = '<div class="table-responsive cart-table"><form id="cart_update_form" method="post"><table class="table table-bordered">';
        $output .= "\t" . '<thead><tr>';

        $output .= "\n\t" . '<th>' . __('Serial') . '</th>';
        $output .= "\n\t" . '<th>' . __('Thumbnail') . '</th>';
        $output .= "\n\t" . '<th>' . __('Product Name') . '</th>';
        $output .= "\n\t" . '<th>' . __('Quantity') . '</th>';
        $output .= "\n\t" . '<th>' . __('Unit Price') . '</th>';
        if (is_tax_enable() && get_static_option('product_tax_type') == 'individual') {
            $output .= "\n\t" . '<th>' . __('Tax') . '</th>';
        }
        $output .= "\n\t" . '<th>' . __('Subtotal') . '</th>';
        $output .= "\n\t" . '<th>' . __('Action') . '</th>';
        $output .= "\n\t" . '</tr></thead>';

        $output .= "\n\t" . '<tbody>';
        $a = 1;

        foreach ($all_cart_item as $id => $item) {

            $single_product = \App\Products::find($id);
            $colspan = 7;
            if (empty($single_product)) {
                continue;
            }

            $tax_markup = !empty($single_product->tax_percentage) ? '<small>+' . __('Tax') . ' (' . $single_product->tax_percentage . '%)</small>' : '';
            $output .= '<tr>';
            $output .= '<td>' . $a . '<input name="product_id[]" type="hidden" value="' . $id . '">' . '</td>';
            $output .= '<td><div class="thumbnail">' . render_image_markup_by_attachment_id($single_product->image, '', 'thumb') . '</div></td>';
            $output .= '<td><h4 class="product-title"><a href="' . route('frontend.products.single', $single_product->slug) . '">' . $single_product->title . '</a></h4>';
            $price_with_variant = 0;
            if (!empty($item['variant'])){
                foreach(json_decode($item['variant']) as $variants){
                    $variant = get_product_variant_list_by_id($variants->variantID);
                    if(!empty($variant)){
                        $index = array_search($variants->term,(array) json_decode($variant->terms));
                        $prices = json_decode($variant->price) ?? [];
                        $terms = json_decode($variant->terms) ?? [];
                        $output .= '<div class="product-variant-list-wrapper"><h5 class="title">'.$variant->title.'</h5><ul class="product-variant-list">';
                        $output .= '<li>'.$terms[$index] ?? '' ;
                        if (isset($prices[$index]) && !empty($prices[$index])){
                            $output .= '<small> +'. amount_with_currency_symbol($prices[$index]) .'</small>';
                            $price_with_variant = $prices[$index];
                        }

                        $output .= '</li>';
                        $output .= '</ul></div>';
                    }
                }
            }

            $output .= '</td>'; //end title td here
            $output .= '<td><input type="number" name="product_quantity[]" class="quantity" value="' . $item['quantity'] . '"></td>';
            $output .= '<td class="unit_price">' . amount_with_currency_symbol($single_product->sale_price + $price_with_variant) . '</td>';
            $tax_amount = 0;
                $final_price = !empty($price_with_variant) ? $price_with_variant + $single_product->sale_price : $single_product->sale_price ;
            if (is_tax_enable() && get_static_option('product_tax_type') == 'individual') {
                $tax_amount = ($final_price / 100) * $single_product->tax_percentage;
                $output .= '<td class="tax_amount">' . amount_with_currency_symbol($tax_amount) . '(' . $single_product->tax_percentage . '%)</td>';
                $colspan = 8;
            }
//            dd($final_price * $item['quantity'] + $tax_amount );
            $subtotal = (get_static_option('product_tax_type') == 'individual') ? $final_price * $item['quantity']  + $tax_amount : $final_price * $item['quantity'];
//            dd($subtotal);
            $output .= '<td>' . amount_with_currency_symbol($subtotal) . '</td>';
            $output .= '<td><div class="cart-action-wrap"><a href="#" class="btn btn-sm btn-danger ajax_remove_cart_item"  data-product_id="' . $single_product->id . '"><i class="fas fa-trash-alt"></i></a>' . $ajax_preloader . '</div></td>';
            $output .= '</tr>';
            $a++;
        }

        $output .= "\n\t" . '</tbody>';
        $output .= "\n\t" . '<tfoot>';
        $output .= '<tr><td colspan="' . $colspan . '">';
        $output .= '<div class="cart-table-footer-wrap">';
        $output .= '<div class="coupon-wrap"><input type="text" class="form-control" name="coupon_code" placeholder="' . __('Coupon Code') . '"><button class="btn-boxed add_coupon_code_btn">' . __('Submit') . '</button>' . $ajax_preloader . '</div>';
        $output .= '<div class="update-cart-wrap">' . $ajax_preloader . '<button class="btn-boxed update_cart_items_btn">' . __('Update Cart') . '</button></div>';
        $output .= '</div>';
        $output .= '</td></tr>';
        $output .= "\n\t" . '</tfoot>';

        $output .= '</table></form></div>';
        return $output;
    }

    $output = '<div class="alert alert-warning">' . __('No Item In Cart!') . '</div>';
    return $output;
}

function cart_destroy($key)
{
    session()->forget($key);
}

function cart_total_items()
{
    $return_val = session()->get('cart_item');
    return !empty($return_val) ? array_sum(array_column($return_val, 'quantity')) : 0;
}
function is_shipping_available(){
    $all_cart_item = session()->get('cart_item');
    $return_val = true;
    $cart_item_type = !empty($all_cart_item) ? array_unique(array_column($all_cart_item,'type')) : [];
    if (count($cart_item_type)  == 1 && in_array('digital',$cart_item_type)){
        $return_val = false;
    }

    return $return_val;
}
function get_cart_tax()
{
    $tax_percentage = get_static_option('product_tax_percentage') ? get_static_option('product_tax_percentage') : 0;
    $cart_sub_total = get_cart_subtotal(false);
    $get_coupon_discount = session()->get('coupon_discount');

    $return_val = $cart_sub_total;

    if (!empty($get_coupon_discount)) {
        $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
        if ($coupon_details->discount_type == 'percentage') {
            $discount_bal = ($cart_sub_total / 100) * (int)$coupon_details->discount;
            $return_val = $cart_sub_total - $discount_bal;
        } elseif ($coupon_details->discount_type == 'amount') {
            $return_val = $cart_sub_total - (int)$coupon_details->discount;
        }
    }

    $tax_amount = ($return_val / 100) * (int)$tax_percentage;

    if (get_static_option('product_tax_type') == 'individual') {
        //write code for all individual tax amount and sum all of them
        $all_cart_items = session()->get('cart_item');
        $all_individual_tax = [];
        foreach ($all_cart_items as $item) {
            $product_details = \App\Products::find($item['id']);
            if (empty($product_details)) {
                continue;
            }
            $price = $product_details->sale_price * $item['quantity'];
            $tax_percentage = ($price / 100) * $product_details->tax_percentage;
            $all_individual_tax[] = $tax_percentage;
        }
        $tax_amount = array_sum($all_individual_tax);

    }

    return $tax_amount;
}

function render_cart_total_table()
{
    $output = '';

    $car_total = cart_total_items();
    if ($car_total > 0) {
        $output .= '<h4 class="title">' . __('Order Summery') . '</h4><div class="cart-total-table-wrap">';
        $output .= ' <div class="cart-total-table table-responsive"><table class="table table-bordered"> <tbody>';
        $output .= ' <tr><th>' . __('Subtotal') . '</th><td>' . get_cart_subtotal() . '</td></tr>';
        $output .= ' <tr><th>' . __('Coupon Discount') . '</th><td>-' . get_cart_coupon_discount() . '</td></tr>';
        if (is_tax_enable()) {
            $tax_percentage = get_static_option('product_tax_type') == 'total' ? ' (' . get_static_option('product_tax_percentage') . '%)' : '';
            $output .= ' <tr><th>' . __('Tax') . $tax_percentage . '</th><td>+ ' . amount_with_currency_symbol(get_cart_tax()) . '</td></tr>';
        }
        if (is_shipping_available()) {
            $output .= ' <tr><th>' . __('Shipping Cost') . '</th><td>+ ' . get_cart_shipping_cost() . '</td></tr>';
        }

        $output .= ' <tr><th>' . __('Total') . '</th><td><strong>' . get_cart_total_cost() . '</strong></td></tr>';
        $output .= '</tbody></table></div>';
        $output .= '</div><a href="' . route('frontend.products.checkout') . '" class="btn-boxed">' . __('Process To Checkout') . '</a></div>';
    }

    return $output;
}
function is_tax_enable()
{
    return get_static_option('product_tax') && get_static_option('product_tax_system') == 'exclusive'  ? true : false;
}
function get_cart_subtotal($currency_symbol = true)
{
    $total_cart_items = session()->get('cart_item');
    $return_val = $currency_symbol ? amount_with_currency_symbol(0) : 0;
    if (!empty($total_cart_items)) {
        $return_val = 0;
        foreach ($total_cart_items as $product_id => $cat_data) {
            $return_val += (int) $cat_data['price'];
        }
        return $currency_symbol ? amount_with_currency_symbol($return_val) : $return_val;
    }

    return $return_val;
}

function get_cart_coupon_discount_by_code( $code,$symbol = true)
{
    $return_val = $symbol ? amount_with_currency_symbol(0) : 0;
    if (!empty($code)) {
        return $return_val;
    }
    if (!empty($get_coupon_discount)) {
        $coupon_details = \App\ProductCoupon::where('code', $code)->first();
        if ($coupon_details->discount_type === 'percentage') {
            $return_val = $symbol ? $coupon_details->discount . '%' : (int) $coupon_details->discount;
        } elseif ($coupon_details->discount_type === 'amount') {
            $return_val = $symbol ? amount_with_currency_symbol($coupon_details->discount) : (int) $coupon_details->discount;
        }
    }

    return $return_val;
}

function get_cart_coupon_discount($symbol = true)
{
    $get_coupon_discount = session()->get('coupon_discount');
    $return_val = $symbol ? amount_with_currency_symbol(0) : 0;

    if (!empty($get_coupon_discount)) {
        $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
        if ($coupon_details->discount_type == 'percentage') {
            $return_val = $symbol ? $coupon_details->discount . '%' : (int) $coupon_details->discount;
        } elseif ($coupon_details->discount_type == 'amount') {
            $return_val = $symbol ? amount_with_currency_symbol($coupon_details->discount) : (int) $coupon_details->discount;
        }
    }

    return $return_val;
}

function get_cart_shipping_cost($symbol = true)
{
    $get_shipping_charge = session()->get('shipping_charge');
    $return_val = $symbol ? amount_with_currency_symbol(0) : 0;

    if (!empty($get_shipping_charge)) {
        $shipping_details = \App\ProductShipping::where('id', $get_shipping_charge)->first();
        $shipping_details = !empty($shipping_details) ? $shipping_details : 0;
        $return_val = $symbol ? amount_with_currency_symbol($shipping_details->cost) : (int) $shipping_details->cost;
    }
    return is_shipping_available() ? $return_val : 0;
}


function get_cart_total_cost($symbol = true)
{
    $cart_sub_total = get_cart_subtotal(false);
    $get_coupon_discount = session()->get('coupon_discount');
    $get_shipping_id = session()->get('shipping_charge');
    $shipping_details = \App\ProductShipping::where('id', $get_shipping_id)->first();
    $get_shipping_charge = !empty($shipping_details) && is_shipping_available() ? $shipping_details->cost : 0;

    $return_val = $symbol ? amount_with_currency_symbol($cart_sub_total + $get_shipping_charge + get_cart_tax()) : $cart_sub_total + $get_shipping_charge + get_cart_tax();

    if (!empty($get_coupon_discount)) {
        $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
        if ($coupon_details->discount_type == 'percentage') {
            $discount_bal = ($cart_sub_total / 100) * (int) $coupon_details->discount;
            $return_val = $cart_sub_total - $discount_bal;
        } elseif ($coupon_details->discount_type == 'amount') {
            $return_val = $cart_sub_total - (int) $coupon_details->discount;
        }

        $total_cost = $return_val + $get_shipping_charge + get_cart_tax();
        return $symbol ? amount_with_currency_symbol($total_cost) : $total_cost;
    }

    return $return_val;
}

function get_country_field($name, $id, $class)
{
    return '<select name="' . $name . '" id="' . $id . '" class="' . $class . '"><option value="">' . __('Select Country') . '</option><option value="Afghanistan" >Afghanistan</option><option value="Albania" >Albania</option><option value="Algeria" >Algeria</option><option value="American Samoa" >American Samoa</option><option value="Andorra" >Andorra</option><option value="Angola" >Angola</option><option value="Anguilla" >Anguilla</option><option value="Antarctica" >Antarctica</option><option value="Antigua and Barbuda" >Antigua and Barbuda</option><option value="Argentina" >Argentina</option><option value="Armenia" >Armenia</option><option value="Aruba" >Aruba</option><option value="Australia" >Australia</option><option value="Austria" >Austria</option><option value="Azerbaijan" >Azerbaijan</option><option value="Bahamas" >Bahamas</option><option value="Bahrain" >Bahrain</option><option value="Bangladesh" >Bangladesh</option><option value="Barbados" >Barbados</option><option value="Belarus" >Belarus</option><option value="Belgium" >Belgium</option><option value="Belize" >Belize</option><option value="Benin" >Benin</option><option value="Bermuda" >Bermuda</option><option value="Bhutan" >Bhutan</option><option value="Bolivia" >Bolivia</option><option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option><option value="Botswana" >Botswana</option><option value="Bouvet Island" >Bouvet Island</option><option value="Brazil" >Brazil</option><option value="British Indian Ocean Territory" >British Indian Ocean Territory</option><option value="Brunei Darussalam" >Brunei Darussalam</option><option value="Bulgaria" >Bulgaria</option><option value="Burkina Faso" >Burkina Faso</option><option value="Burundi" >Burundi</option><option value="Cambodia" >Cambodia</option><option value="Cameroon" >Cameroon</option><option value="Canada" >Canada</option><option value="Cape Verde" >Cape Verde</option><option value="Cayman Islands" >Cayman Islands</option><option value="Central African Republic" >Central African Republic</option><option value="Chad" >Chad</option><option value="Chile" >Chile</option><option value="China" >China</option><option value="Christmas Island" >Christmas Island</option><option value="Cocos (Keeling) Islands" >Cocos (Keeling) Islands</option><option value="Colombia" >Colombia</option><option value="Comoros" >Comoros</option><option value="Cook Islands" >Cook Islands</option><option value="Costa Rica" >Costa Rica</option><option value="Croatia (Hrvatska)" >Croatia (Hrvatska)</option><option value="Cuba" >Cuba</option><option value="Cyprus" >Cyprus</option><option value="Czech Republic" >Czech Republic</option><option value="Democratic Republic of the Congo" >Democratic Republic of the Congo</option><option value="Denmark" >Denmark</option><option value="Djibouti" >Djibouti</option><option value="Dominica" >Dominica</option><option value="Dominican Republic" >Dominican Republic</option><option value="East Timor" >East Timor</option><option value="Ecuador" >Ecuador</option><option value="Egypt" >Egypt</option><option value="El Salvador" >El Salvador</option><option value="Equatorial Guinea" >Equatorial Guinea</option><option value="Eritrea" >Eritrea</option><option value="Estonia" >Estonia</option><option value="Ethiopia" >Ethiopia</option><option value="Falkland Islands (Malvinas)" >Falkland Islands (Malvinas)</option><option value="Faroe Islands" >Faroe Islands</option><option value="Fiji" >Fiji</option><option value="Finland" >Finland</option><option value="France" >France</option><option value="France, Metropolitan" >France, Metropolitan</option><option value="French Guiana" >French Guiana</option><option value="French Polynesia" >French Polynesia</option><option value="French Southern Territories" >French Southern Territories</option><option value="Gabon" >Gabon</option><option value="Gambia" >Gambia</option><option value="Georgia" >Georgia</option><option value="Germany" >Germany</option><option value="Ghana" >Ghana</option><option value="Gibraltar" >Gibraltar</option><option value="Greece" >Greece</option><option value="Greenland" >Greenland</option><option value="Grenada" >Grenada</option><option value="Guadeloupe" >Guadeloupe</option><option value="Guam" >Guam</option><option value="Guatemala" >Guatemala</option><option value="Guernsey" >Guernsey</option><option value="Guinea" >Guinea</option><option value="Guinea-Bissau" >Guinea-Bissau</option><option value="Guyana" >Guyana</option><option value="Haiti" >Haiti</option><option value="Heard and Mc Donald Islands" >Heard and Mc Donald Islands</option><option value="Honduras" >Honduras</option><option value="Hong Kong" >Hong Kong</option><option value="Hungary" >Hungary</option><option value="Iceland" >Iceland</option><option value="India" >India</option><option value="Indonesia" >Indonesia</option><option value="Iran (Islamic Republic of)" >Iran (Islamic Republic of)</option><option value="Iraq" >Iraq</option><option value="Ireland" >Ireland</option><option value="Isle of Man" >Isle of Man</option><option value="Israel" >Israel</option><option value="Italy" >Italy</option><option value="Ivory Coast" >Ivory Coast</option><option value="Jamaica" >Jamaica</option><option value="Japan" >Japan</option><option value="Jersey" >Jersey</option><option value="Jordan" >Jordan</option><option value="Kazakhstan" >Kazakhstan</option><option value="Kenya" >Kenya</option><option value="Kiribati" >Kiribati</option><option value="Korea, Democratic People\'s Republic of" >Korea, Democratic People\'s Republic of</option><option value="Korea, Republic of" >Korea, Republic of</option><option value="Kosovo" >Kosovo</option><option value="Kuwait" >Kuwait</option><option value="Kyrgyzstan" >Kyrgyzstan</option><option value="Lao People\'s Democratic Republic" >Lao People\'s Democratic Republic</option><option value="Latvia" >Latvia</option><option value="Lebanon" >Lebanon</option><option value="Lesotho" >Lesotho</option><option value="Liberia" >Liberia</option><option value="Libyan Arab Jamahiriya" >Libyan Arab Jamahiriya</option><option value="Liechtenstein" >Liechtenstein</option><option value="Lithuania" >Lithuania</option><option value="Luxembourg" >Luxembourg</option><option value="Macau" >Macau</option><option value="Madagascar" >Madagascar</option><option value="Malawi" >Malawi</option><option value="Malaysia" >Malaysia</option><option value="Maldives" >Maldives</option><option value="Mali" >Mali</option><option value="Malta" >Malta</option><option value="Marshall Islands" >Marshall Islands</option><option value="Martinique" >Martinique</option><option value="Mauritania" >Mauritania</option><option value="Mauritius" >Mauritius</option><option value="Mayotte" >Mayotte</option><option value="Mexico" >Mexico</option><option value="Micronesia, Federated States of" >Micronesia, Federated States of</option><option value="Moldova, Republic of" >Moldova, Republic of</option><option value="Monaco" >Monaco</option><option value="Mongolia" >Mongolia</option><option value="Montenegro" >Montenegro</option><option value="Montserrat" >Montserrat</option><option value="Morocco" >Morocco</option><option value="Mozambique" >Mozambique</option><option value="Myanmar" >Myanmar</option><option value="Namibia" >Namibia</option><option value="Nauru" >Nauru</option><option value="Nepal" >Nepal</option><option value="Netherlands" >Netherlands</option><option value="Netherlands Antilles" >Netherlands Antilles</option><option value="New Caledonia" >New Caledonia</option><option value="New Zealand" >New Zealand</option><option value="Nicaragua" >Nicaragua</option><option value="Niger" >Niger</option><option value="Nigeria" >Nigeria</option><option value="Niue" >Niue</option><option value="Norfolk Island" >Norfolk Island</option><option value="North Macedonia" >North Macedonia</option><option value="Northern Mariana Islands" >Northern Mariana Islands</option><option value="Norway" >Norway</option><option value="Oman" >Oman</option><option value="Pakistan" >Pakistan</option><option value="Palau" >Palau</option><option value="Palestine" >Palestine</option><option value="Panama" >Panama</option><option value="Papua New Guinea" >Papua New Guinea</option><option value="Paraguay" >Paraguay</option><option value="Peru" >Peru</option><option value="Philippines" >Philippines</option><option value="Pitcairn" >Pitcairn</option><option value="Poland" >Poland</option><option value="Portugal" >Portugal</option><option value="Puerto Rico" >Puerto Rico</option><option value="Qatar" >Qatar</option><option value="Republic of Congo" >Republic of Congo</option><option value="Reunion" >Reunion</option><option value="Romania" >Romania</option><option value="Russian Federation" >Russian Federation</option><option value="Rwanda" >Rwanda</option><option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option><option value="Saint Lucia" >Saint Lucia</option><option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option><option value="Samoa" >Samoa</option><option value="San Marino" >San Marino</option><option value="Sao Tome and Principe" >Sao Tome and Principe</option><option value="Saudi Arabia" >Saudi Arabia</option><option value="Senegal" >Senegal</option><option value="Serbia" >Serbia</option><option value="Seychelles" >Seychelles</option><option value="Sierra Leone" >Sierra Leone</option><option value="Singapore" >Singapore</option><option value="Slovakia" >Slovakia</option><option value="Slovenia" >Slovenia</option><option value="Solomon Islands" >Solomon Islands</option><option value="Somalia" >Somalia</option><option value="South Africa" >South Africa</option><option value="South Georgia South Sandwich Islands" >South Georgia South Sandwich Islands</option><option value="South Sudan" >South Sudan</option><option value="Spain" >Spain</option><option value="Sri Lanka" >Sri Lanka</option><option value="St. Helena" >St. Helena</option><option value="St. Pierre and Miquelon" >St. Pierre and Miquelon</option><option value="Sudan" >Sudan</option><option value="Suriname" >Suriname</option><option value="Svalbard and Jan Mayen Islands" >Svalbard and Jan Mayen Islands</option><option value="Swaziland" >Swaziland</option><option value="Sweden" >Sweden</option><option value="Switzerland" >Switzerland</option><option value="Syrian Arab Republic" >Syrian Arab Republic</option><option value="Taiwan" >Taiwan</option><option value="Tajikistan" >Tajikistan</option><option value="Tanzania, United Republic of" >Tanzania, United Republic of</option><option value="Thailand" >Thailand</option><option value="Togo" >Togo</option><option value="Tokelau" >Tokelau</option><option value="Tonga" >Tonga</option><option value="Trinidad and Tobago" >Trinidad and Tobago</option><option value="Tunisia" >Tunisia</option><option value="Turkey" >Turkey</option><option value="Turkmenistan" >Turkmenistan</option><option value="Turks and Caicos Islands" >Turks and Caicos Islands</option><option value="Tuvalu" >Tuvalu</option><option value="Uganda" >Uganda</option><option value="Ukraine" >Ukraine</option><option value="United Arab Emirates" >United Arab Emirates</option><option value="United Kingdom" >United Kingdom</option><option value="United States" >United States</option><option value="United States minor outlying islands" >United States minor outlying islands</option><option value="Uruguay" >Uruguay</option><option value="Uzbekistan" >Uzbekistan</option><option value="Vanuatu" >Vanuatu</option><option value="Vatican City State" >Vatican City State</option><option value="Venezuela" >Venezuela</option><option value="Vietnam" >Vietnam</option><option value="Virgin Islands (British)" >Virgin Islands (British)</option><option value="Virgin Islands (U.S.)" >Virgin Islands (U.S.)</option><option value="Wallis and Futuna Islands" >Wallis and Futuna Islands</option><option value="Western Sahara" >Western Sahara</option><option value="Yemen" >Yemen</option><option value="Zambia" >Zambia</option><option value="Zimbabwe" >Zimbabwe</option></select>';
}

function rest_cart_session()
{
    session()->forget([
        'shipping_charge',
        'cart_item',
        'coupon_discount',
        'cart_items'
    ]);
}


function ratings_markup($ratings, $type = '')
{
    $markup = '';
    $markup_frontend = '';
    switch ($ratings) {
        case('1'):
            $markup = '<i class="fas fa-star"></i>';
            $markup_frontend = '<li><i class="fas fa-star"></i></li>';
            break;
        case('2'):
            $markup = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
            $markup_frontend = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';
            break;
        case('3'):
            $markup = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            $markup_frontend = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';
            break;
        case('4'):
            $markup = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            $markup_frontend = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';
            break;
        case('5'):
            $markup = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            $markup_frontend = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';
            break;
        default:
            break;
    }
    return $type == 'li' ? $markup_frontend : $markup;
}


function get_mega_menu_cat_name_by_id($type, $cat_id)
{
    $return_val = '';

    switch ($type) {
        case('service_mega_menu'):
            $cat_details = \App\ServiceCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->name : '';
            break;
        case('work_mega_menu'):
            $cat_details = WorksCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->name : '';
            break;
        case('event_mega_menu'):
            $cat_details = \App\EventsCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->title : '';
            break;
        case('product_mega_menu'):
            $cat_details = \App\ProductCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->title : '';
            break;
        case('donation_mega_menu'):
            $return_val = '';
            break;
        case('blog_mega_menu'):
            $cat_details = \App\BlogCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->name : '';
            break;
        case('job_mega_menu'):
            $cat_details = \App\JobsCategory::find($cat_id);
            $return_val = !empty($cat_details) ? $cat_details->title : '';
            break;
        default:
            break;
    }

    return $return_val;
}

function get_mege_menu_item_url($type, $slug)
{
    $return_val = '';

    switch ($type) {
        case('service_mega_menu'):
            $return_val = route('frontend.services.single',$slug);
            break;
        case('work_mega_menu'):
            $return_val = route('frontend.work.single',$slug);
            break;
        case('event_mega_menu'):
            $return_val =  route('frontend.events.single',$slug);
            break;
        case('product_mega_menu'):
            $return_val =  route('frontend.products.single',$slug);
            break;
        case('donation_mega_menu'):
            $return_val = route('frontend.donations.single',$slug);
            break;
        case('blog_mega_menu'):
            $return_val =  route('frontend.blog.single',$slug);
            break;
        case('job_mega_menu'):
            $return_val =  route('frontend.jobs.single',$slug);
            break;
        default:
            break;
    }

    return $return_val;
}


function getVisIpAddr() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function get_visitor_country(){
    $return_val = 'NG';
    $ip = getVisIpAddr();
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));
       
    $ipdat = (array) $ipdat;
    $return_val = isset($ipdat['geoplugin_countryCode']) ? $ipdat['geoplugin_countryCode'] : $return_val;

    return $return_val;
}

function get_blog_category_by_id($id,$type = '',$class = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\BlogCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->name;
        if ($type == 'link' ){
            $return_val = '<a class="'.$class.'" href="'.route('frontend.blog.category',['id' => $blog_cat->id,'any' => Str::slug($blog_cat->name) ]).'">'.$blog_cat->name.'</a>';
        }
    }

    return $return_val;
}
function get_jobs_category_by_id($id,$type = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\JobsCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->title;
        if ($type == 'link' ){
            $return_val = '<a href="'.route('frontend.jobs.category',['id' => $blog_cat->id,'any' => Str::slug($blog_cat->title) ]).'">'.$blog_cat->title.'</a>';
        }
    }

    return $return_val;
}

function get_events_category_by_id($id,$type = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\EventsCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->title;
        if ($type == 'link' ){
            $return_val = '<a href="'.route('frontend.events.category',['id' => $blog_cat->id,'any' => Str::slug($blog_cat->title) ]).'">'.$blog_cat->title.'</a>';
        }
    }

    return $return_val;
}
function get_product_category_by_id($id,$type = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\ProductCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->title;
        if ($type == 'link' ){
            $return_val = '<a href="'.route('frontend.products.category',['id' => $blog_cat->id,'any' => Str::slug($blog_cat->title) ]).'">'.$blog_cat->title.'</a>';
        }
    }

    return $return_val;
}
function get_product_subcategory_by_id($id,$type = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\ProductSubCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->title;
        if ($type == 'link' ){
            $return_val = '<a href="'.route('frontend.products.subcategory',['id' => $blog_cat->id,'any' => \Illuminate\Support\Str::slug($blog_cat->title) ]).'">'.$blog_cat->title.'</a>';
        }
    }

    return $return_val;
}

function get_service_category_by_id($id,$type = ''){
    $return_val = __('uncategorized');
    $blog_cat = \App\ServiceCategory::find($id);
    if (!empty($blog_cat)){
        $return_val = $blog_cat->name;
        if ($type == 'link' ){
            $return_val = '<a href="'.route('frontend.services.category',['id' => $blog_cat->id,'any' => Str::slug($blog_cat->name) ]).'">'.$blog_cat->name.'</a>';
        }
    }

    return $return_val;
}

function get_price_plan_category_by_id($id,$type = ''){

    $return_val = __('uncategorized');
    $blog_cat = \App\PricePlanCategory::find($id);

    if (!empty($blog_cat)){
        $return_val = $blog_cat->name;
    }

    return $return_val;
}
function amount_with_currency_symbol($amount, $text = false)
{
    $amount = number_format((float) $amount,2,'.',',');
    $position = get_static_option('site_currency_symbol_position');
    $symbol = site_currency_symbol($text);
    $return_val = $symbol . $amount;
    if ($position == 'right') {
        $return_val = $amount . $symbol;
    }
    return $return_val;
}

function site_currency_symbol($text = false)
{
    $all_currency = script_currency_list();

    $symbol = '$';
    $global_currency = get_static_option('site_global_currency');
    foreach ($all_currency as $currency => $sym) {
        if ($global_currency == $currency) {
            $symbol = $text ? $currency : $sym;
            break;
        }
    }
    return $symbol;
}

function render_payment_gateway_for_form($cash_on_delivery = false)
{
    $output = '<div class="payment-gateway-wrapper">';
    if (empty(get_static_option('site_payment_gateway'))) {
        return;
    }

    $output .= '<input type="hidden" name="selected_payment_gateway" value="' . get_static_option('site_default_payment_gateway') . '">';
    $all_gateway = [
        'paypal', 'paytm', 'mollie','stripe','manual_payment', 'razorpay', 'flutterwave', 'paystack','midtrans',
        'payfast','cashfree','instamojo','marcadopago','squareup','cinetpay','paytabs','billplz','zitopay', 'toyyibpay', 'pagalipay','authorizenet'
    ];
    $output .= '<ul>';
    if ($cash_on_delivery && !empty(get_static_option('cash_on_delivery_gateway'))) {
        $output .= '<li data-gateway="cash_on_delivery" ><div class="img-select">';
        $output .= render_image_markup_by_attachment_id(get_static_option('cash_on_delivery_preview_logo'));
        $output .= '</div></li>';
    }

    foreach ($all_gateway as $gateway) {
        if (!empty(get_static_option($gateway . '_gateway'))):
            $class = (get_static_option('site_default_payment_gateway') == $gateway) ? 'class="selected"' : '';

            $output .= '<li data-gateway="' . $gateway . '" ' . $class . '><div class="img-select">';
            $output .= render_image_markup_by_attachment_id(get_static_option($gateway . '_preview_logo'));
            $output .= '</div></li>';
        endif;
    }
    $output .= '</ul>';

    $output .= '</div>';
    return $output;
}

function get_manual_payment_description()
{
    $manual_payment_description = get_static_option('site_manual_payment_description');
    $manual_payment_description = str_replace(array('https://{url}', 'http://{url}'), array(url('/'), url('/')), $manual_payment_description);
    return $manual_payment_description;
}

function is_paypal_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'INR', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK', 'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD'];
    return in_array($global_currency, $supported_currency);
}

function is_paytm_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['INR'];
    return in_array($global_currency, $supported_currency);
}

function is_razorpay_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['INR'];
    return in_array($global_currency, $supported_currency);
}

function is_mollie_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['AED', 'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'ILS', 'ISK', 'JPY', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN', 'RON', 'RUB', 'SEK', 'SGD', 'THB', 'TWD', 'USD', 'ZAR'];
    return in_array($global_currency, $supported_currency);
}

function is_flutterwave_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN', 'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD'];
    return in_array($global_currency, $supported_currency);
}

function is_paystack_supported_currency()
{
    $global_currency = get_static_option('site_global_currency');
    $supported_currency = ['NGN', 'GHS'];
    return in_array($global_currency, $supported_currency);
}

function get_amount_in_usd($amount, $currency)
{
    $output = 0;
    $all_currency = [
        'USD' => '$', 'EUR' => '€', 'INR' => '₹', 'IDR' => 'Rp', 'AUD' => 'A$', 'SGD' => 'S$', 'JPY' => '¥', 'GBP' => '£', 'MYR' => 'RM', 'PHP' => '₱', 'THB' => '฿', 'KRW' => '₩', 'NGN' => '₦', 'GHS' => 'GH₵', 'BRL' => 'R$',
        'BIF' => 'FBu', 'CAD' => 'C$', 'CDF' => 'FC', 'CVE' => 'Esc', 'GHP' => 'GH₵', 'GMD' => 'D', 'GNF' => 'FG', 'KES' => 'K', 'LRD' => 'L$', 'MWK' => 'MK', 'MZN' => 'MT', 'RWF' => 'R₣', 'SLL' => 'Le', 'STD' => 'Db', 'TZS' => 'TSh', 'UGX' => 'USh', 'XAF' => 'FCFA', 'XOF' => 'CFA', 'ZMK' => 'ZK', 'ZMW' => 'ZK', 'ZWD' => 'Z$',
        'AED' => 'د.إ', 'AFN' => '؋', 'ALL' => 'L', 'AMD' => '֏', 'ANG' => 'NAf', 'AOA' => 'Kz', 'ARS' => '$', 'AWG' => 'ƒ', 'AZN' => '₼', 'BAM' => 'KM', 'BBD' => 'Bds$', 'BDT' => '৳', 'BGN' => 'Лв', 'BMD' => '$', 'BND' => 'B$', 'BOB' => 'Bs', 'BSD' => 'B$', 'BWP' => 'P', 'BZD' => '$',
        'CHF' => 'CHf', 'CNY' => '¥', 'CLP' => '$', 'COP' => '$', 'CRC' => '₡', 'CZK' => 'Kč', 'DJF' => 'Fdj', 'DKK' => 'Kr', 'DOP' => 'RD$', 'DZD' => 'دج', 'EGP' => 'E£', 'ETB' => 'ብር', 'FJD' => 'FJ$', 'FKP' => '£', 'GEL' => 'ლ', 'GIP' => '£', 'GTQ' => 'Q',
        'GYD' => 'G$', 'HKD' => 'HK$', 'HNL' => 'L', 'HRK' => 'kn', 'HTG' => 'G', 'HUF' => 'Ft', 'ILS' => '₪', 'ISK' => 'kr', 'JMD' => '$', 'KGS' => 'Лв', 'KHR' => '៛', 'KMF' => 'CF', 'KYD' => '$', 'KZT' => '₸', 'LAK' => '₭', 'LBP' => 'ل.ل.', 'LKR' => 'ரூ', 'LSL' => 'L',
        'MAD' => 'MAD', 'MDL' => 'L', 'MGA' => 'Ar', 'MKD' => 'Ден', 'MMK' => 'K', 'MNT' => '₮', 'MOP' => 'MOP$', 'MRO' => 'MRU', 'MUR' => '₨', 'MVR' => 'Rf', 'MXN' => 'Mex$', 'NAD' => 'N$', 'NIO' => 'C$', 'NOK' => 'kr', 'NPR' => 'रू', 'NZD' => '$', 'PAB' => 'B/.', 'PEN' => 'S/', 'PGK' => 'K',
        'PKR' => '₨', 'PLN' => 'zł', 'PYG' => '₲', 'QAR' => 'QR', 'RON' => 'lei', 'RSD' => 'din', 'RUB' => '₽', 'SAR' => 'SR', 'SBD' => 'Si$', 'SCR' => 'SR', 'SEK' => 'kr', 'SHP' => '£', 'SOS' => 'Sh.so.', 'SRD' => '$', 'SZL' => 'E', 'TJS' => 'ЅM',
        'TRY' => '₺', 'TTD' => 'TT$', 'TWD' => 'NT$', 'UAH' => '₴', 'UYU' => '$U', 'UZS' => 'so\'m', 'VND' => '₫', 'VUV' => 'VT', 'WST' => 'WS$', 'XCD' => '$', 'XPF' => '₣', 'YER' => '﷼', 'ZAR' => 'R'
    ];
    foreach ($all_currency as $cur => $symbol) {
        if ($cur == 'USD') {
            continue;
        }
        if ($cur == $currency) {
            $exchange_rate = get_static_option('site_' . strtolower($cur) . '_to_usd_exchange_rate');
            $output = $amount * $exchange_rate;
        }
    }

    return $output;
}

function get_amount_in_inr($amount, $currency)
{
    $output = 0;
    $all_currency = [
        'USD' => '$', 'EUR' => '€', 'INR' => '₹', 'IDR' => 'Rp', 'AUD' => 'A$', 'SGD' => 'S$', 'JPY' => '¥', 'GBP' => '£', 'MYR' => 'RM', 'PHP' => '₱', 'THB' => '฿', 'KRW' => '₩', 'NGN' => '₦', 'GHS' => 'GH₵', 'BRL' => 'R$',
        'BIF' => 'FBu', 'CAD' => 'C$', 'CDF' => 'FC', 'CVE' => 'Esc', 'GHP' => 'GH₵', 'GMD' => 'D', 'GNF' => 'FG', 'KES' => 'K', 'LRD' => 'L$', 'MWK' => 'MK', 'MZN' => 'MT', 'RWF' => 'R₣', 'SLL' => 'Le', 'STD' => 'Db', 'TZS' => 'TSh', 'UGX' => 'USh', 'XAF' => 'FCFA', 'XOF' => 'CFA', 'ZMK' => 'ZK', 'ZMW' => 'ZK', 'ZWD' => 'Z$',
        'AED' => 'د.إ', 'AFN' => '؋', 'ALL' => 'L', 'AMD' => '֏', 'ANG' => 'NAf', 'AOA' => 'Kz', 'ARS' => '$', 'AWG' => 'ƒ', 'AZN' => '₼', 'BAM' => 'KM', 'BBD' => 'Bds$', 'BDT' => '৳', 'BGN' => 'Лв', 'BMD' => '$', 'BND' => 'B$', 'BOB' => 'Bs', 'BSD' => 'B$', 'BWP' => 'P', 'BZD' => '$',
        'CHF' => 'CHf', 'CNY' => '¥', 'CLP' => '$', 'COP' => '$', 'CRC' => '₡', 'CZK' => 'Kč', 'DJF' => 'Fdj', 'DKK' => 'Kr', 'DOP' => 'RD$', 'DZD' => 'دج', 'EGP' => 'E£', 'ETB' => 'ብር', 'FJD' => 'FJ$', 'FKP' => '£', 'GEL' => 'ლ', 'GIP' => '£', 'GTQ' => 'Q',
        'GYD' => 'G$', 'HKD' => 'HK$', 'HNL' => 'L', 'HRK' => 'kn', 'HTG' => 'G', 'HUF' => 'Ft', 'ILS' => '₪', 'ISK' => 'kr', 'JMD' => '$', 'KGS' => 'Лв', 'KHR' => '៛', 'KMF' => 'CF', 'KYD' => '$', 'KZT' => '₸', 'LAK' => '₭', 'LBP' => 'ل.ل.', 'LKR' => 'ரூ', 'LSL' => 'L',
        'MAD' => 'MAD', 'MDL' => 'L', 'MGA' => 'Ar', 'MKD' => 'Ден', 'MMK' => 'K', 'MNT' => '₮', 'MOP' => 'MOP$', 'MRO' => 'MRU', 'MUR' => '₨', 'MVR' => 'Rf', 'MXN' => 'Mex$', 'NAD' => 'N$', 'NIO' => 'C$', 'NOK' => 'kr', 'NPR' => 'रू', 'NZD' => '$', 'PAB' => 'B/.', 'PEN' => 'S/', 'PGK' => 'K',
        'PKR' => '₨', 'PLN' => 'zł', 'PYG' => '₲', 'QAR' => 'QR', 'RON' => 'lei', 'RSD' => 'din', 'RUB' => '₽', 'SAR' => 'SR', 'SBD' => 'Si$', 'SCR' => 'SR', 'SEK' => 'kr', 'SHP' => '£', 'SOS' => 'Sh.so.', 'SRD' => '$', 'SZL' => 'E', 'TJS' => 'ЅM',
        'TRY' => '₺', 'TTD' => 'TT$', 'TWD' => 'NT$', 'UAH' => '₴', 'UYU' => '$U', 'UZS' => 'so\'m', 'VND' => '₫', 'VUV' => 'VT', 'WST' => 'WS$', 'XCD' => '$', 'XPF' => '₣', 'YER' => '﷼', 'ZAR' => 'R'
    ];
    foreach ($all_currency as $cur => $symbol) {
        if ($cur == 'INR') {
            continue;
        }
        if ($cur == $currency) {
            $exchange_rate = get_static_option('site_' . strtolower($cur) . '_to_inr_exchange_rate');
            $output = $amount * $exchange_rate;
        }
    }

    return $output;
}

function get_amount_in_ngn($amount, $currency)
{
    $output = 0;
    $all_currency = [
        'USD' => '$', 'EUR' => '€', 'INR' => '₹', 'IDR' => 'Rp', 'AUD' => 'A$', 'SGD' => 'S$', 'JPY' => '¥', 'GBP' => '£', 'MYR' => 'RM', 'PHP' => '₱', 'THB' => '฿', 'KRW' => '₩', 'NGN' => '₦', 'GHS' => 'GH₵', 'BRL' => 'R$',
        'BIF' => 'FBu', 'CAD' => 'C$', 'CDF' => 'FC', 'CVE' => 'Esc', 'GHP' => 'GH₵', 'GMD' => 'D', 'GNF' => 'FG', 'KES' => 'K', 'LRD' => 'L$', 'MWK' => 'MK', 'MZN' => 'MT', 'RWF' => 'R₣', 'SLL' => 'Le', 'STD' => 'Db', 'TZS' => 'TSh', 'UGX' => 'USh', 'XAF' => 'FCFA', 'XOF' => 'CFA', 'ZMK' => 'ZK', 'ZMW' => 'ZK', 'ZWD' => 'Z$',
        'AED' => 'د.إ', 'AFN' => '؋', 'ALL' => 'L', 'AMD' => '֏', 'ANG' => 'NAf', 'AOA' => 'Kz', 'ARS' => '$', 'AWG' => 'ƒ', 'AZN' => '₼', 'BAM' => 'KM', 'BBD' => 'Bds$', 'BDT' => '৳', 'BGN' => 'Лв', 'BMD' => '$', 'BND' => 'B$', 'BOB' => 'Bs', 'BSD' => 'B$', 'BWP' => 'P', 'BZD' => '$',
        'CHF' => 'CHf', 'CNY' => '¥', 'CLP' => '$', 'COP' => '$', 'CRC' => '₡', 'CZK' => 'Kč', 'DJF' => 'Fdj', 'DKK' => 'Kr', 'DOP' => 'RD$', 'DZD' => 'دج', 'EGP' => 'E£', 'ETB' => 'ብር', 'FJD' => 'FJ$', 'FKP' => '£', 'GEL' => 'ლ', 'GIP' => '£', 'GTQ' => 'Q',
        'GYD' => 'G$', 'HKD' => 'HK$', 'HNL' => 'L', 'HRK' => 'kn', 'HTG' => 'G', 'HUF' => 'Ft', 'ILS' => '₪', 'ISK' => 'kr', 'JMD' => '$', 'KGS' => 'Лв', 'KHR' => '៛', 'KMF' => 'CF', 'KYD' => '$', 'KZT' => '₸', 'LAK' => '₭', 'LBP' => 'ل.ل.', 'LKR' => 'ரூ', 'LSL' => 'L',
        'MAD' => 'MAD', 'MDL' => 'L', 'MGA' => 'Ar', 'MKD' => 'Ден', 'MMK' => 'K', 'MNT' => '₮', 'MOP' => 'MOP$', 'MRO' => 'MRU', 'MUR' => '₨', 'MVR' => 'Rf', 'MXN' => 'Mex$', 'NAD' => 'N$', 'NIO' => 'C$', 'NOK' => 'kr', 'NPR' => 'रू', 'NZD' => '$', 'PAB' => 'B/.', 'PEN' => 'S/', 'PGK' => 'K',
        'PKR' => '₨', 'PLN' => 'zł', 'PYG' => '₲', 'QAR' => 'QR', 'RON' => 'lei', 'RSD' => 'din', 'RUB' => '₽', 'SAR' => 'SR', 'SBD' => 'Si$', 'SCR' => 'SR', 'SEK' => 'kr', 'SHP' => '£', 'SOS' => 'Sh.so.', 'SRD' => '$', 'SZL' => 'E', 'TJS' => 'ЅM',
        'TRY' => '₺', 'TTD' => 'TT$', 'TWD' => 'NT$', 'UAH' => '₴', 'UYU' => '$U', 'UZS' => 'so\'m', 'VND' => '₫', 'VUV' => 'VT', 'WST' => 'WS$', 'XCD' => '$', 'XPF' => '₣', 'YER' => '﷼', 'ZAR' => 'R'
    ];
    foreach ($all_currency as $cur => $symbol) {
        if ($cur == 'NGN') {
            continue;
        }
        if ($cur == $currency) {
            $exchange_rate = get_static_option('site_' . strtolower($cur) . '_to_ngn_exchange_rate');
            $output = $amount * $exchange_rate;
        }
    }

    return $output;
}
function check_currency_support_by_payment_gateway($gateway)
{
    $output = false;
    if ($gateway == 'paypal') {
        $output = is_paypal_supported_currency();
    } elseif ($gateway == 'paytm') {
        $output = is_paytm_supported_currency();
    } elseif ($gateway == 'mollie') {
        $output = is_mollie_supported_currency();
    } elseif ($gateway == 'stripe') {
        $output = true;
    } elseif ($gateway == 'razorpay') {
        $output = is_razorpay_supported_currency();
    } elseif ($gateway == 'flutterwave') {
        $output = is_flutterwave_supported_currency();
    } elseif ($gateway == 'paystack') {
        $output = is_paystack_supported_currency();
    } else {
        $output = true;
    }

    return $output;
}

function get_charge_currency($gateway)
{
    $output = 'USD';
    if ($gateway == 'paypal') {
        $output = 'USD';
    } elseif ($gateway == 'paytm') {
        $output = 'INR';
    } elseif ($gateway == 'mollie') {
        $output = 'USD';
    } elseif ($gateway == 'razorpay') {
        $output = 'INR';
    } elseif ($gateway == 'flutterwave') {
        $output = 'USD';
    } elseif ($gateway == 'paystack') {
        $output = 'NGN';
    }

    return $output;
}

function get_charge_amount($amount, $gateway)
{
    $output = 0;
    if ($gateway == 'paypal') {
        $output = get_amount_in_usd($amount, get_static_option('site_global_currency'));
    } elseif ($gateway == 'paytm') {
        $output = get_amount_in_inr($amount, get_static_option('site_global_currency'));
    } elseif ($gateway == 'mollie') {
        $output = get_amount_in_usd($amount, get_static_option('site_global_currency'));
    } elseif ($gateway == 'razorpay') {
        $output = get_amount_in_inr($amount, get_static_option('site_global_currency'));
    } elseif ($gateway == 'flutterwave') {
        $output = get_amount_in_usd($amount, get_static_option('site_global_currency'));
    } elseif ($gateway == 'paystack') {
        $output = get_amount_in_ngn($amount, get_static_option('site_global_currency'));
    }

    return $output;
}


function get_paypal_form_url()
{
    $output = 'https://secure.paypal.com/cgi-bin/webscr';
    $sandbox_enable = get_static_option('paypal_test_mode');
    if (!empty($sandbox_enable)) {
        $output = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    }
    return $output;
}

function get_paytm_environment()
{
    $output = 'PROD';
    $sandbox_enable = get_static_option('paytm_test_mode');
    if (!empty($sandbox_enable)) {
        $output = 'TEST';
    }
    return $output;
}

function redirect_404_page()
{
    return view('frontend.pages.404');
}
function get_future_date($current_days, $days)
{
    $date_plus_60_days = new DateTime($current_days);
    $date_plus_60_days->modify("+$days days");
    return $date_plus_60_days->format("d-M-Y  H:i:s");
}

function get_language_name_by_slug($slug)
{
    $data = Language::where('slug', $slug)->first();
    return $data->name;
}

function get_default_language_direction(){
    $default_lang = Language::where('default',1)->first();
    return !empty($default_lang) ? $default_lang->direction : 'ltr';
}

function custom_number_format ($amount){
   return number_format((float)$amount, 2, '.', '');
}

function get_footer_copyright_text(){
    $footer_copyright_text = get_static_option('site_'.get_user_lang().'_footer_copyright');
    $footer_copyright_text = str_replace(array('{copy}', '{year}'), array('&copy;', date('Y')), $footer_copyright_text);
    return $footer_copyright_text;
}

function cart_tax_for_mail_template($cart_items = [])
{
    $tax_percentage = get_static_option('product_tax_percentage') ?: 0;
    $cart_sub_total = get_cart_subtotal(false);
    $get_coupon_discount = session()->get('coupon_discount');

    $return_val = $cart_sub_total;

    if (!empty($get_coupon_discount)) {
        $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
        if ($coupon_details->discount_type == 'percentage') {
            $discount_bal = ($cart_sub_total / 100) * (int) $coupon_details->discount;
            $return_val = $cart_sub_total - $discount_bal;
        } elseif ($coupon_details->discount_type == 'amount') {
            $return_val = $cart_sub_total - (int) $coupon_details->discount;
        }
    }

    $tax_amount = ($return_val / 100) * (int) $tax_percentage;

    if (get_static_option('product_tax_type') == 'individual') {
        //write code for all individual tax amount and sum all of them
        $all_cart_items = $cart_items;
        $all_individual_tax = [];
        foreach ($all_cart_items as $item) {
            $product_details = \App\Products::find($item['id']);
            if (empty($product_details)) {
                continue;
            }
            $price = $product_details->sale_price * $item['quantity'];
            $tax_percentage = ($price / 100) * $product_details->tax_percentage;
            $all_individual_tax[] = $tax_percentage;
        }
        $tax_amount = array_sum($all_individual_tax);

    }

    return $tax_amount;
}

function get_shipping_name_by_id($id)
{
    $shipping_details = \App\ProductShipping::find($id);
    return !empty($shipping_details) ? $shipping_details->title : "Undefined";
}
function get_image_category_name_by_id($id){
    $return_val = __('uncategorized');

    $category_details = \App\ImageGalleryCategory::find($id);
    if (!empty($category_details)){
            $return_val = $category_details->title;
    }

    return $return_val;
}

function get_home_variant(){
    return get_static_option('home_page_variant');
}

function get_static_option_arr($home){
    $default_lang = Language::where('default', 1)->first();
    $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;
    $home_09 = [
        'home_page_07_topbar_section_info_item_icon',
        'home_page_07_'.$lang.'_topbar_section_info_item_title',
        'home_page_07_'.$lang.'_topbar_section_info_item_details',
        'language_select_option',
        'navbar_button',
        'navbar_button_custom_url_status',
        'navbar_'.$lang.'_button_text',
        'site_white_logo',
        'site_'.$lang.'_title',
        'product_module_status',
        'construction_header_section_bg_image',
        'construction_header_section_'.$lang.'_title',
        'construction_header_section_'.$lang.'_description',
        'construction_header_section_'.$lang.'_button_one_text',
        'construction_header_section_button_one_icon',
        'construction_header_section_button_one_url',
        'home_page_about_us_section_status',
        'construction_about_section_left_image',
        'construction_about_section_video_url',
        'construction_about_section_experience_year',
        'construction_about_section_'.$lang.'_experience_year_title',
        'construction_about_section_'.$lang.'_subtitle',
        'construction_about_section_'.$lang.'_title',
        'construction_about_section_'.$lang.'_description',
        'construction_about_section_'.$lang.'_button_one_text',
        'construction_about_section_button_one_icon',
        'construction_about_section_button_one_url',
        'home_page_counterup_section_status',
        'home_page_service_section_status',
        'construction_what_we_offer_section_'.$lang.'_subtitle',
        'construction_what_we_offer_section_'.$lang.'_title',
        'construction_what_we_offer_section_'.$lang.'_button_text',
        'home_page_quote_faq_section_status',
        'construction_quote_section_bg_image',
        'construction_quote_section_right_image',
        'construction_quote_section_'.$lang.'_subtitle',
        'construction_quote_section_'.$lang.'_title',
        'construction_quote_section_'.$lang.'_button_text',
        'construction_quote_section__button_icon',
        'quote_page_form_fields',
        'home_page_case_study_section_status',
        'construction_project_section_'.$lang.'_subtitle',
        'construction_project_section_'.$lang.'_title',
        'home_page_team_member_section_status',
        'construction_team_member_section_'.$lang.'_subtitle',
        'construction_team_member_section_'.$lang.'_title',
        'home_page_testimonial_section_status',
        'construction_testimonial_section_'.$lang.'_subtitle',
        'construction_testimonial_section_'.$lang.'_title',
        'home_page_latest_news_section_status',
        'construction_news_area_section_'.$lang.'_title',
        'construction_news_area_section_'.$lang.'_subtitle',
        'portfolio_news_section_'.$lang.'_button_text',
    ];

    $home_01 = [
        'home_page_01_'.$lang.'_about_us_title',
        'home_page_01_'.$lang.'_service_area_title',
        'home_page_01_'.$lang.'_service_area_description',
        'home_page_01_'.$lang.'_about_us_video_url',
        'home_page_01_'.$lang.'_latest_news_title',
        'home_page_01_'.$lang.'_latest_news_description',
        'home_page_01_'.$lang.'_latest_news_description',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_quality_area_title',
        'home_page_01_'.$lang.'_quality_area_description',
        'home_page_01_'.$lang.'_quality_area_button_status',
        'home_page_01_'.$lang.'_quality_area_button_url',
        'home_page_01_'.$lang.'_quality_area_button_title',
        'home_page_01_'.$lang.'_case_study_title',
        'home_page_01_'.$lang.'_case_study_description',
        'home_page_01_'.$lang.'_read_more_text',
        'home_page_01_'.$lang.'_testimonial_section_title',
        'home_page_01_'.$lang.'_price_plan_section_title',
        'home_page_01_'.$lang.'_price_plan_section_description',
        'site_'.$lang.'_title',
        'case_study_'.$lang.'_read_more_text',
        'home_page_key_feature_section_status',
        'home_page_about_us_section_status',
        'home_page_01_about_us_video_background_image',
        'home_page_service_section_status',
        'home_page_01_service_area_item_type',
        'home_page_quality_section_status',
        'home_page_01_quality_area_background_image',
        'home_page_testimonial_section_status',
        'home_page_price_plan_section_status',
        'home_page_counterup_section_status',
        'home_page_01_price_plan_background_image',
        'home_page_brand_logo_section_status',
        'home_page_latest_news_section_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'site_white_logo',
        'home_page_variant',
        'product_module_status',
        'home_page_case_study_section_status'
    ];
    $home_02 = [
        'home_page_variant',
        'site_white_logo',
        'product_module_status',
        'home_page_key_feature_section_status',
        'home_page_service_section_status',
        'home_page_01_service_area_item_type',
        'home_page_quality_section_status',
        'home_page_02_quality_area_image',
        'home_page_about_us_section_status',
        'home_page_02_about_us_video_background_image',
        'home_page_02_about_us_signature_image',
        'home_page_testimonial_section_status',
        'home_page_brand_logo_section_status',
        'home_page_price_plan_section_status',
        'home_page_counterup_section_status',
        'home_page_case_study_section_status',
        'home_page_02_case_study_background_image',
        'home_page_team_member_section_status',
        'home_page_latest_news_section_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_service_area_title',
        'home_page_01_'.$lang.'_service_area_description',
        'home_page_01_'.$lang.'_quality_area_title',
        'home_page_01_'.$lang.'_quality_area_description',
        'home_page_01_'.$lang.'_quality_area_button_status',
        'home_page_01_'.$lang.'_quality_area_button_url',
        'home_page_01_'.$lang.'_quality_area_button_title',
        'home_page_01_'.$lang.'_about_us_video_url',
        'home_page_01_'.$lang.'_about_us_title',
        'home_page_01_'.$lang.'_about_us_description',
        'home_page_01_'.$lang.'_about_us_quote_text',
        'home_page_01_'.$lang.'_testimonial_section_title',
        'home_page_01_'.$lang.'_about_us_quote_text',
        'home_page_01_'.$lang.'_brand_logo_area_title',
        'home_page_01_'.$lang.'_price_plan_section_title',
        'home_page_01_'.$lang.'_price_plan_section_description',
        'home_page_01_'.$lang.'_case_study_title',
        'home_page_01_'.$lang.'_case_study_description',
        'home_page_01_'.$lang.'_team_member_section_title',
        'home_page_01_'.$lang.'_team_member_section_description',
        'home_page_01_'.$lang.'_latest_news_title',
        'home_page_01_'.$lang.'_latest_news_description',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
    ];

    $home_03 = [
        'site_white_logo',
        'home_page_variant',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'home_page_about_us_section_status',
        'home_page_03_about_us_image_one',
        'home_page_03_about_us_image_two',
        'home_page_key_feature_section_status',
        'home_page_service_section_status',
        'home_page_01_service_area_background_image',
        'home_page_01_service_area_item_type',
        'home_page_call_to_action_section_status',
        'home_page_01_cta_area_button_url',
        'home_page_case_study_section_status',
        'home_page_testimonial_section_status',
        'home_page_counterup_section_status',
        'home_page_price_plan_section_status',
        'home_page_01_price_plan_background_image',
        'home_page_latest_news_section_status',
        'home_page_brand_logo_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'home_page_01_'.$lang.'_about_us_title',
        'home_page_01_'.$lang.'_about_us_description',
        'home_page_01_'.$lang.'_about_us_quote_text',
        'home_page_01_'.$lang.'_service_area_title',
        'home_page_01_'.$lang.'_service_area_description',
        'home_page_01_'.$lang.'_cta_area_title',
        'home_page_01_'.$lang.'_cta_area_button_title',
        'home_page_01_'.$lang.'_case_study_title',
        'home_page_01_'.$lang.'_case_study_description',
        'home_page_01_'.$lang.'_price_plan_section_title',
        'home_page_01_'.$lang.'_price_plan_section_description',
        'home_page_01_'.$lang.'_latest_news_title',
        'home_page_01_'.$lang.'_latest_news_description',
        'home_page_01_'.$lang.'_brand_logo_area_title',
    ];

    $home_04 = [
        'home_page_variant',
        'site_white_logo',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'home_page_about_us_section_status',
        'home_page_04_about_us_our_mission_image',
        'home_page_04_about_us_our_vision_image',
        'home_page_quality_section_status',
        'home_page_04_quality_area_image',
        'home_page_01_en_quality_area_list',
        'home_page_service_section_status',
        'home_page_01_service_area_background_image',
        'home_page_01_service_area_item_type',
        'home_page_case_study_section_status',
        'home_page_testimonial_section_status',
        'home_03_testimonial_bg',
        'home_page_price_plan_section_status',
        'home_page_counterup_section_status',
        'home_page_latest_news_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'home_page_01_'.$lang.'_about_us_title',
        'home_page_01_'.$lang.'_about_us_description',
        'home_page_01_'.$lang.'_about_us_our_mission_title',
        'home_page_01_'.$lang.'_about_us_our_mission_description',
        'home_page_01_'.$lang.'_about_us_our_vision_title',
        'home_page_01_'.$lang.'_about_us_our_vision_description',
        'home_page_01_'.$lang.'_quality_area_title',
        'home_page_01_'.$lang.'_quality_area_description',
        'home_page_01_'.$lang.'_service_area_title',
        'home_page_01_'.$lang.'_service_area_description',
        'home_page_01_'.$lang.'_case_study_title',
        'home_page_01_'.$lang.'_case_study_description',
        'home_page_01_'.$lang.'_testimonial_section_title',
        'home_page_01_'.$lang.'_price_plan_section_title',
        'home_page_01_'.$lang.'_price_plan_section_description',
        'home_page_01_'.$lang.'_latest_news_title',
        'home_page_01_'.$lang.'_latest_news_description',
    ];
    $home_05 = [
        'home_page_variant',
        'site_white_logo',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'portfolio_home_page_right_image',
        'portfolio_home_page_button_url',
        'home_page_counterup_section_status',
        'home_page_about_us_section_status',
        'portfolio_about_section_left_image',
        'home_page_05_about_section_icon_box_icon',
        'portfolio_about_section_button_one_url',
        'portfolio_about_section_button_one_icon',
        'portfolio_about_section_button_two_url',
        'portfolio_about_section_button_two_icon',
        'home_page_expertice_section_status',
        'home_page_05_experties_section_skill_box_number',
        'home_page_service_section_status',
        'home_page_case_study_section_status',
        'home_page_call_to_action_section_status',
        'portfolio_cta_section_button_url',
        'portfolio_cta_section_button_icon',
        'portfolio_cta_section_right_image',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'site_'.$lang.'_title',
        'portfolio_home_page_'.$lang.'_subtitle',
        'portfolio_home_page_'.$lang.'_title',
        'portfolio_home_page_'.$lang.'_profession',
        'portfolio_home_page_'.$lang.'_description',
        'portfolio_home_page_'.$lang.'_button_text',
        'portfolio_about_section_'.$lang.'_subtitle',
        'portfolio_about_section_'.$lang.'_title',
        'portfolio_about_section_'.$lang.'_description',
        'home_page_05_'.$lang.'_about_section_icon_box_title',
        'portfolio_about_section_'.$lang.'_button_one_text',
        'portfolio_about_section_'.$lang.'_button_two_text',
        'portfolio_expertice_section_'.$lang.'_subtitle',
        'portfolio_expertice_section_'.$lang.'_title',
        'home_page_05_'.$lang.'_experties_section_skill_box_title',
        'home_page_05_'.$lang.'_experties_section_skill_box_subtitle',
        'home_page_05_'.$lang.'_experties_section_skill_box_subtitle',
        'portfolio_what_we_offer_section_'.$lang.'_subtitle',
        'portfolio_what_we_offer_section_'.$lang.'_title',
        'portfolio_recent_work_section_'.$lang.'_subtitle',
        'portfolio_recent_work_section_'.$lang.'_title',
        'portfolio_recent_work_section_'.$lang.'_button_text',
        'portfolio_cta_section_'.$lang.'_title',
        'portfolio_cta_section_'.$lang.'_description',
        'portfolio_cta_section_'.$lang.'_description',
        'portfolio_cta_section_'.$lang.'_button_text',
        'portfolio_testimonial_section_'.$lang.'_subtitle',
        'portfolio_testimonial_section_'.$lang.'_title',
        'portfolio_news_section_'.$lang.'_subtitle',
        'portfolio_news_section_'.$lang.'_title',
        'portfolio_news_section_'.$lang.'_button_text',
    ];
    $home_06 = [
        'site_white_logo',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'home_page_variant',
        'home_page_06_header_section_bg_image',
        'home_page_06_header_section_button_one_url',
        'home_page_06_header_section_button_two_url',
        'home_page_key_feature_section_status',
        'home_page_service_section_status',
        'home_page_video_section_status',
        'portfolio_video_section_background_image',
        'portfolio_video_section_video_url',
        'home_page_counterup_section_status',
        'portfolio_counterup_section_background_image',
        'home_page_case_study_section_status',
        'home_page_quote_faq_section_status',
        'quote_page_form_fields',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'home_page_06_'.$lang.'_header_section_description',
        'home_page_06_'.$lang.'_header_section_button_one_text',
        'home_page_06_'.$lang.'_header_section_button_two_text',
        'home_page_06_'.$lang.'_header_section_title',
        'logistic_what_we_offer_section_'.$lang.'_subtitle',
        'logistic_what_we_offer_section_'.$lang.'_title',
        'logistic_what_we_offer_section_'.$lang.'_button_text',
        'logistic_project_section_'.$lang.'_subtitle',
        'logistic_project_section_'.$lang.'_title',
        'logistic_quote_section_'.$lang.'_subtitle',
        'logistic_quote_section_'.$lang.'_title',
        'logistic_quote_section_'.$lang.'_button_text',
        'logistic_faq_section_'.$lang.'_subtitle',
        'logistic_faq_section_'.$lang.'_title',
        'home_page_06_'.$lang.'_faq_item_title',
        'home_page_06_'.$lang.'_faq_item_description',
        'logistic_testimonial_section_'.$lang.'_subtitle',
        'logistic_testimonial_section_'.$lang.'_title',
        'portfolio_news_section_'.$lang.'_button_text',
        'logistic_news_section_'.$lang.'_title',
        'logistic_news_section_'.$lang.'_subtitle',
    ];
    $home_07 = [
        'site_logo',
        'home_page_variant',
        'site_white_logo',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'home_page_07_topbar_section_info_item_icon',
        'language_select_option',
        'home_page_07_header_section_bg_image',
        'home_page_07_header_section_button_one_url',
        'home_page_07_header_section_button_one_icon',
        'home_page_about_us_section_status',
        'industry_about_section_left_image',
        'industry_about_section_video_background_image',
        'industry_about_section_video_url',
        'industry_about_section_experience_year',
        'industry_about_section_button_one_url',
        'industry_about_section_button_one_icon',
        'home_page_service_section_status',
        'home_page_counterup_section_status',
        'industry_counterup_section_background_image',
        'home_page_case_study_section_status',
        'home_page_team_member_section_status',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'home_page_brand_logo_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'home_page_07_'.$lang.'_topbar_section_info_item_title',
        'home_page_07_'.$lang.'_topbar_section_info_item_details',
        'home_page_07_'.$lang.'_header_section_description',
        'home_page_07_'.$lang.'_header_section_button_one_text',
        'home_page_07_'.$lang.'_header_section_title',
        'industry_about_section_'.$lang.'_experience_year_title',
        'industry_about_section_'.$lang.'_title',
        'industry_about_section_'.$lang.'_subtitle',
        'industry_about_section_'.$lang.'_description',
        'industry_about_section_'.$lang.'_button_one_text',
        'industry_what_we_offer_section_'.$lang.'_subtitle',
        'industry_what_we_offer_section_'.$lang.'_title',
        'industry_what_we_offer_section_'.$lang.'_readmore_text',
        'logistic_what_we_offer_section_'.$lang.'_button_text',
        'industry_project_section_'.$lang.'_subtitle',
        'industry_project_section_'.$lang.'_title',
        'industry_team_member_section_'.$lang.'_subtitle',
        'industry_team_member_section_'.$lang.'_title',
        'industry_testimonial_section_'.$lang.'_subtitle',
        'industry_testimonial_section_'.$lang.'_title',
        'industry_news_area_section_'.$lang.'_subtitle',
        'industry_news_area_section_'.$lang.'_title',
        'portfolio_news_section_'.$lang.'_button_text',
    ];
    $home_08 = [
        'creative_agency_video_section_video_url',
        'home_page_variant',
        'site_white_logo',
        'product_module_status',
        'home_page_01_contact_area_map_location',
        'get_in_touch_form_fields',
        'home_page_contact_section_status',
        'cagency_header_section_right_image',
        'cagency_header_section_button_one_url',
        'cagency_header_section_button_one_icon',
        'home_page_service_section_status',
        'home_page_video_section_status',
        'creative_agency_video_section_background_image',
        'creative_agency_video_section_background_image',
        'home_page_counterup_section_status',
        'home_page_case_study_section_status',
        'cagency_work_process_section_item_number',
        'home_page_call_to_action_section_status',
        'cagency_cta_section_right_image',
        'cagency_cta_section_button_url',
        'cagency_cta_section_button_icon',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'site_'.$lang.'_title',
        'home_page_01_'.$lang.'_contact_area_title',
        'home_page_01_'.$lang.'_contact_area_button_text',
        'cagency_header_section_'.$lang.'_title',
        'cagency_header_section_'.$lang.'_description',
        'cagency_header_section_'.$lang.'_button_one_text',
        'cagency_what_we_offer_section_'.$lang.'_subtitle',
        'cagency_what_we_offer_section_'.$lang.'_title',
        'logistic_what_we_offer_section_'.$lang.'_button_text',
        'cagency_work_process_section_'.$lang.'_subtitle',
        'cagency_work_process_section_'.$lang.'_title',
        'cagency_work_process_section_item_'.$lang.'_title',
        'cagency_our_portfolio_section_'.$lang.'_subtitle',
        'cagency_our_portfolio_section_'.$lang.'_title',
        'cagency_cta_section_'.$lang.'_title',
        'cagency_cta_section_'.$lang.'_description',
        'cagency_cta_section_'.$lang.'_button_text',
        'cagency_testimonial_section_'.$lang.'_subtitle',
        'cagency_testimonial_section_'.$lang.'_title',
        'cagency_news_area_section_'.$lang.'_subtitle',
        'cagency_news_area_section_'.$lang.'_title',
        'portfolio_news_section_'.$lang.'_button_text',
    ];

    $home_10 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_white_logo',
        'home_page_about_us_section_status',
        'home_page_service_section_status',
        'home_page_case_study_section_status',
        'home_page_team_member_section_status',
        'home_page_counterup_section_status',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'home_page_contact_section_status',
        'home_page_call_to_action_section_status',
        'get_in_touch_form_fields',
        'home_page_01_service_area_items',
        'product_module_status',
        'home_page_10_header_section_bg_image',
        'home_page_10_header_section_button_one_url',
        'home_page_10_header_section_button_two_url',
        'home_page_10_key_features_section_icon',
        'lawyer_about_section_button_url',
        'lawyer_about_section_left_top_image',
        'lawyer_about_section_left_bottom_image',
        'home_10_counterup_section_background_image',
        'home_page_10_cta_area_background_image',
        'home_page_10_cta_area_button_url',
        'home_page_10_'.$lang.'_header_section_description',
        'home_page_10_'.$lang.'_header_section_button_one_text',
        'home_page_10_'.$lang.'_header_section_button_two_text',
        'home_page_10_'.$lang.'_header_section_title',
        'home_page_10_'.$lang.'_header_section_subtitle',
        'home_page_10_'.$lang.'_key_feeatures_item_description',
        'home_page_10_'.$lang.'_key_features_item_title',
        'lawyer_about_section_'.$lang.'_subtitle',
        'lawyer_about_section_'.$lang.'_title',
        'lawyer_about_section_'.$lang.'_description',
        'lawyer_about_section_'.$lang.'_button_text',
        'home_page_10_'.$lang.'_service_area_title',
        'home_page_10_'.$lang.'_service_area_subtitle',
        'home_page_10_'.$lang.'_service_area_readmore_text',
        'home_page_10_'.$lang.'_team_member_section_subtitle',
        'home_page_10_'.$lang.'_team_member_section_title',
        'home_page_10_'.$lang.'_testimonial_section_title',
        'home_page_10_'.$lang.'_testimonial_section_subtitle',
        'home_page_10_'.$lang.'_new_area_subtitle',
        'home_page_10_'.$lang.'_new_area_title',
        'home_page_10_'.$lang.'_cta_area_title',
        'home_page_10_'.$lang.'_cta_area_description',
        'home_page_10_'.$lang.'_cta_area_button_status',
        'home_page_10_'.$lang.'_cta_area_button_title',
        'home_page_10_'.$lang.'_contact_area_title',
        'home_page_10_'.$lang.'_contact_area_button_title',
        'home_page_appointment_section_status',
        'home_page_10_'.$lang.'_appointment_section_subtitle',
        'home_page_10_'.$lang.'_appointment_section_title',
    ];

    $home_11 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_about_us_section_status',
        'home_page_key_feature_section_status',
        'home_page_counterup_section_status',
        'home_page_video_section_status',
        'home_page_call_to_action_section_status',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'home_page_service_section_status',
        'home_page_11_key_features_section_icon',
        'political_home_page_header_'.$lang.'_title',
        'political_home_page_header_'.$lang.'_description',
        'political_home_page_header_'.$lang.'_button_text',
        'home_page_11_'.$lang.'_key_features_item_title',
        'political_home_page_header_button_url' ,
        'political_home_page_header_left_image',
        'political_home_page_header_background_image',
        'political_about_section_button_url',
        'political_about_section_right_image',
        'political_about_section_'.$lang.'_subtitle',
        'political_about_section_'.$lang.'_title',
        'political_about_section_'.$lang.'_description',
        'political_about_section_'.$lang.'_button_text',
        'home_page_11_video_area_video_url',
        'home_page_11_video_area_background_image',
        'home_page_11_cta_area_button_url',
        'home_11_counterup_section_background_image',
        'home_page_11_cta_area_background_image',
        'home_page_01_event_area_items',
        'home_page_11_'.$lang.'_cta_area_subtitle',
        'home_page_11_'.$lang.'_cta_area_title',
        'home_page_11_'.$lang.'_cta_area_description',
        'home_page_11_'.$lang.'_cta_area_button_status',
        'home_page_11_'.$lang.'_cta_area_button_title',
        'home_page_11_'.$lang.'_service_area_subtitle',
        'home_page_11_'.$lang.'_service_area_title',
        'home_page_11_'.$lang.'_service_area_readmore_text',
        'home_page_11_'.$lang.'_event_area_subtitle',
        'home_page_11_'.$lang.'_event_area_title',
        'home_page_11_testimonial_area_background_image',
        'home_page_11_'.$lang.'_testimonial_section_subtitle',
        'home_page_11_'.$lang.'_testimonial_section_title',
        'home_page_11_'.$lang.'_new_area_subtitle',
        'home_page_11_'.$lang.'_new_area_title',
        'home_page_11_'.$lang.'_new_area_button_text',
        ];

        $home_12 = [
            'site_'.$lang.'_title',
            'home_page_appointment_section_status',
            'home_page_variant',
            'site_logo',
            'site_white_logo',
            'product_module_status',
            'home_page_about_us_section_status',
            'home_page_call_to_action_section_status',
            'home_page_service_section_status',
            'medical_home_page_header_button_two_url' ,
            'medical_home_page_header_button_url' ,
            'medical_home_page_header_right_image',
            'medical_home_page_header_background_image',
            'medical_about_section_button_url',
            'medical_about_section_right_image',
            'medical_about_section_right_bottom_image',
            'medical_home_page_header_'.$lang.'_title',
            'medical_home_page_header_'.$lang.'_description',
            'medical_home_page_header_'.$lang.'_button_text',
            'medical_home_page_header_'.$lang.'_button_two_text',
            'medical_about_section_'.$lang.'_subtitle',
            'medical_about_section_'.$lang.'_title',
            'medical_about_section_'.$lang.'_description',
            'medical_about_section_'.$lang.'_button_text',
            'home_page_12_'.$lang.'_service_area_subtitle',
            'home_page_12_'.$lang.'_service_area_title',
            'home_page_counterup_section_status',
            'appointment_form_fields',
            'home_page_team_member_section_status',
            'home_page_case_study_section_status',
            'home_page_testimonial_section_status',
            'home_page_latest_news_section_status',
            'home_page_brand_logo_section_status',
            'medical_appointment_section_'.$lang.'_subtitle',
            'medical_appointment_section_'.$lang.'_title',
            'medical_appointment_section_'.$lang.'_description',
            'medical_appointment_section_'.$lang.'_hotline',
            'medical_appointment_section_'.$lang.'_button_text',
            'home_page_11_'.$lang.'_team_member_section_title',
            'home_page_11_'.$lang.'_team_member_section_subtitle',
            'home_page_12_'.$lang.'_case_study_section_title',
            'home_page_12_'.$lang.'_case_study_section_subtitle',
            'home_page_12_'.$lang.'_testimonial_section_title',
            'home_page_12_'.$lang.'_testimonial_section_subtitle',
            'home_page_12_'.$lang.'_news_section_subtitle',
            'home_page_12_'.$lang.'_news_section_title',
            'home_page_12_'.$lang.'_news_section_readmore_text',
            'home_page_12_about_section_video_url',
            'medical_cta_area_section_'.$lang.'_subtitle',
            'medical_cta_area_section_'.$lang.'_title',
            'medical_cta_area_section_'.$lang.'_description',
            'medical_cta_area_section_'.$lang.'_hotline',
            'medical_cta_area_section_'.$lang.'_button_text',
            'home_page_12_'.$lang.'_appointment_section_subtitle',
            'home_page_12_'.$lang.'_appointment_section_title',
            ];

    $home_13 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_about_us_section_status',
        'home_page_13_'.$lang.'_header_section_subtitle',
        'home_page_13_'.$lang.'_header_section_title' ,
        'home_page_13_'.$lang.'_header_section_description',
        'home_page_13_'.$lang.'_header_section_button_one_text',
        'home_page_13_header_section_button_one_url' ,
        'home_page_13_header_section_button_one_icon',
        'home_page_13_header_section_bg_image',
        'home_page_13_about_section_button_url',
        'home_page_13_about_section_video_url',
        'home_page_13_about_section_right_image',
        'home_page_13_about_section_button_icon',
        'home_page_donation_cause_section_status',
        'home_page_call_to_action_section_status',
        'home_page_team_member_section_status',
        'home_page_13_popular_cause_popular_cause_background_image',
        'home_page_13_'.$lang.'_about_section_subtitle',
        'home_page_13_'.$lang.'_about_section_title',
        'home_page_13_'.$lang.'_about_section_description',
        'home_page_13_'.$lang.'_about_section_button_text',
        'home_page_13_'.$lang.'_popular_cause_subtitle',
        'home_page_13_'.$lang.'_popular_cause_title',
        'home_page_13_'.$lang.'_popular_cause_goal_text',
        'home_page_13_'.$lang.'_popular_cause_rise_text',
        'home_page_13_'.$lang.'_team_member_section_title',
        'home_page_13_'.$lang.'_team_member_section_subtitle',
        'home_page_13_'.$lang.'_cta_area_title',
        'home_page_13_'.$lang.'_cta_area_button_title',
        'home_page_13_'.$lang.'_cta_area_button_status',
        'home_page_13_cta_area_button_url',
        'home_page_13_cta_area_background_image',
        'home_page_13_cta_section_button_icon',
        'home_page_event_section_status',
        'home_page_01_event_area_items',
        'home_page_testimonial_section_status',
        'home_page_latest_news_section_status',
        'home_page_brand_logo_section_status',
        'home_page_13_testimonial_section_background_image',
        'home_page_13_'.$lang.'_event_area_subtitle',
        'home_page_13_'.$lang.'_event_area_title',
        'home_page_13_'.$lang.'_testimonial_section_subtitle',
        'home_page_13_'.$lang.'_testimonial_section_title',
        'home_page_13_'.$lang.'_cta_two_area_title',
        'home_page_13_'.$lang.'_cta_two_area_button_title',
        'home_page_13_'.$lang.'_cta_two_area_button_status',
        'home_page_13_cta_two_section_button_icon',
        'home_page_13_cta_two_area_button_url',
        'home_page_13_'.$lang.'_new_area_subtitle',
        'home_page_13_'.$lang.'_new_area_title',
        'home_page_13_'.$lang.'_new_area_button_text'
    ];

    $home_14 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_call_to_action_section_status',
        'home_page_service_section_status',
        'home_page_brand_logo_section_status',
        'home_page_case_study_section_status',
        'home_page_work_process_section_status',
        'home_page_counterup_section_status',
        'home_page_14_counterup_section_background_image',
        'home_page_latest_news_section_status',
        'home_page_testimonial_section_status',
        'home_page_contact_section_status',
        'get_in_touch_form_fields',
        'home_page_14_header_background_image',
        'home_page_14_header_right_image',
        'home_page_14_header_area_button_one_icon',
        'home_page_14_header_area_button_one_url',
        'home_page_14_'.$lang.'_header_area_title',
        'home_page_14_'.$lang.'_header_area_description',
        'home_page_14_'.$lang.'_header_area_button_one_text',
        'home_page_14_'.$lang.'_service_area_subtitle',
        'home_page_14_'.$lang.'_service_area_title',
        'home_page_14_'.$lang.'_project_area_title',
        'home_page_14_'.$lang.'_project_area_subtitle',
        'home_page_14_cta_section_button_icon',
        'home_page_14_cta_area_button_url',
        'home_page_14_cta_area_right_image',
        'home_page_14_'.$lang.'_cta_area_button_title',
        'home_page_14_'.$lang.'_cta_area_button_status',
        'home_page_14_'.$lang.'_cta_area_description',
        'home_page_14_'.$lang.'_cta_area_title',
        'home_page_14_work_process_section_'.$lang.'_subtitle',
        'home_page_14_work_process_section_'.$lang.'_title',
        'home_page_14_work_process_section_item_'.$lang.'_title',
        'home_page_14_work_process_section_item_number',
        'home_page_14_'.$lang.'_testimonial_section_subtitle',
        'home_page_14_'.$lang.'_testimonial_section_title',
        'home_page_14_'.$lang.'_news_area_section_subtitle',
        'home_page_14_'.$lang.'_news_area_section_title',
        'home_page_14_'.$lang.'_contact_area_subtitle',
        'home_page_14_'.$lang.'_contact_area_title',
        'home_page_14_'.$lang.'_contact_area_button_text',
        'home_page_14_contact_area_button_icon',
        ];

    $home_15 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_15_'.$lang.'_header_area_title',
        'home_page_15_'.$lang.'_header_area_description',
        'home_page_15_'.$lang.'_header_area_button_text',
        'home_page_15_header_area_button_url',
        'home_page_15_header_area_button_icon',
        'home_page_15_header_area_background_image',
        'home_page_15_header_area_bottom_image',
        'home_page_15_'.$lang.'_offer_item_title',
        'home_page_15_'.$lang.'_offer_item_short_description',
        'home_page_15_'.$lang.'_offer_item_button_text',
        'home_page_15_offer_item_button_url',
        'home_page_15_offer_item_image',
        'home_page_15_'.$lang.'_featured_product_area_subtitle',
        'home_page_15_'.$lang.'_featured_product_area_title',
        'home_page_15_'.$lang.'_featured_product_area_items',
        'home_page_15_process_area_background_image',
        'home_page_15_process_area_right_image',
        'home_page_15_process_area_left_image',
        'home_page_15_'.$lang.'_process_area_item_title',
        'home_page_15_'.$lang.'_process_area_item_description',
        'home_page_15_process_area_item_icon',
        'home_page_15_process_area_item_number',
        'home_page_15_'.$lang.'_product_section_subtitle',
        'home_page_15_'.$lang.'_product_section_title',
        'home_page_products_area_items',
        'home_page_testimonial_section_status',
        'home_page_15_'.$lang.'_testimonial_area_title',
        'home_page_15_'.$lang.'_testimonial_area_subtitle',
        'home_page_15_testimonial_area_background_image',
        'home_page_15_testimonial_area_right_image',
        'home_page_15_testimonial_area_left_image',
        'home_page_15_top_selling_product_area_items',
        'home_page_15_top_selling_product_area_left_image',
        'home_page_15_top_selling_product_area_right_image',
        'home_page_15_'.$lang.'_top_selling_product_area_title',
        'home_page_15_'.$lang.'_top_selling_product_area_subtitle',
        'home_page_brand_logo_section_status',
        'home_page_top_selling_section_status',
        'home_page_online_store_section_status',
        'home_page_process_section_status',
        'home_page_offer_section_status',
        'home_page_featured_fruit_section_status',
        ];
    $home_16 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_16_header_area_button_url',
        'home_page_16_header_area_background_image',
        'home_page_16_header_area_right_image',
        'home_page_16_'.$lang.'_header_area_title',
        'home_page_16_'.$lang.'_header_area_description',
        'home_page_16_'.$lang.'_header_area_button_text',
        'home_page_about_us_section_status',
        'home_page_16_'.$lang.'_about_section_button_text',
        'home_page_16_'.$lang.'_about_section_description',
        'home_page_16_'.$lang.'_about_section_title',
        'home_page_16_'.$lang.'_about_section_subtitle',
        'home_page_16_about_section_left_image',
        'home_page_16_about_section_button_url',
        'home_page_16_'.$lang.'_service_area_title',
        'home_page_16_'.$lang.'_service_area_subtitle',
        'home_page_01_service_area_items',
        'home_page_service_section_status',
        'home_page_16_'.$lang.'_estimate_area_form_button_text',
        'home_page_16_'.$lang.'_estimate_area_form_title',
        'home_page_16_'.$lang.'_estimate_area_title',
        'home_page_brand_logo_section_status',
        'estimate_form_fields',
        'home_page_case_study_section_status',
        'home_page_latest_news_section_status',
        'home_page_counterup_section_status',
        'home_page_testimonial_section_status',
        'home_page_16_'.$lang.'_work_section_title',
        'home_page_16_'.$lang.'_work_section_subtitle',
        'home_page_16_'.$lang.'_testimonial_area_subtitle',
        'home_page_16_'.$lang.'_testimonial_area_title',
        'home_page_16_'.$lang.'_new_area_subtitle',
        'home_page_16_'.$lang.'_new_area_title',
        'home_page_16_'.$lang.'_new_area_button_text',
        'home_page_quote_faq_section_status',
        'home_page_appointment_section_status',
        'home_page_16_'.$lang.'_appointment_section_subtitle',
        'home_page_16_'.$lang.'_appointment_section_title',
        ];

    $home_17 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_17_header_area_button_url',
        'home_page_17_header_area_button_icon',
        'home_page_17_header_area_background_image',
        'home_page_17_header_area_right_image',
        'home_page_17_'.$lang.'_header_area_title',
        'home_page_17_'.$lang.'_header_area_description',
        'home_page_17_'.$lang.'_header_area_button_text',
        'course_home_page_'.$lang.'_specialities_area_title',
        'course_home_page_specialities_item_icon',
        'course_home_page_specialities_item_icon',
        'course_home_page_'.$lang.'_specialities_item_title',
        'course_home_page_'.$lang.'_specialities_item_description',
        'course_home_page_specialities_item_url',
        'course_home_page_'.$lang.'_featured_course_area_title',
        'home_page_testimonial_section_status',
        'home_page_video_section_status',
        'home_page_counterup_section_status',
        'course_home_page_video_section_background_image',
        'course_home_page_video_section_video_url',
        'course_home_page_'.$lang.'_all_course_area_title',
        'course_home_page_'.$lang.'_all_course_area_button_text',
        'course_home_page_'.$lang.'_testimonial_area_title',
        'home_page_event_section_status',
        'course_home_page_'.$lang.'_event_area_title',
        'home_page_call_to_action_section_status',
        'course_home_page_cta_section_button_icon',
        'course_home_page_cta_area_button_url',
        'course_home_page_'.$lang.'_cta_area_title',
        'course_home_page_'.$lang.'_cta_area_button_status',
        'course_home_page_'.$lang.'_cta_area_button_title',
        'home_page_all_courses_section_status',
        'home_page_featured_courses_section_status',
        'home_page_course_category_section_status',
        'home_page_our_speciality_section_status',
        ];
    $home_18 = [
        'site_'.$lang.'_title',
        'home_page_variant',
        'site_logo',
        'site_white_logo',
        'product_module_status',
        'home_page_17_header_area_button_url',
        'home_page_17_header_area_button_icon',
        'home_page_17_header_area_background_image',
        'home_page_17_header_area_right_image',
        'grocery_home_page_'.$lang.'_header_section_subtitle',
        'grocery_home_page_'.$lang.'_header_section_title' ,
        'grocery_home_page_'.$lang.'_header_section_description',
        'grocery_home_page_'.$lang.'_header_section_button_one_text',
        'grocery_home_page_header_section_button_one_url' ,
        'grocery_home_page_header_section_button_one_icon',
        'grocery_home_page_header_section_bg_image',
        'grocery_home_page_'.$lang.'_product_category_area_title',
        'home_page_offer_section_status',
        'home_page_featured_fruit_section_status',
        'grocery_home_page_'.$lang.'_featured_product_area_subtitle',
        'grocery_home_page_'.$lang.'_featured_product_area_title',
        'home_page_process_section_status',
        'grocery_home_page_process_area_background_image',
        'grocery_home_page_process_area_right_image',
        'grocery_home_page_process_area_left_image',
        'grocery_home_page_'.$lang.'_process_area_item_title',
        'grocery_home_page_'.$lang.'_process_area_item_description',
        'grocery_home_page_process_area_item_icon',
        'grocery_home_page_process_area_item_number',
        'home_page_online_store_section_status',
        'home_page_brand_logo_section_status',
        'home_page_testimonial_section_status',
        'home_page_product_category_section_status',
        'grocery_home_page_'.$lang.'_product_section_subtitle',
        'grocery_home_page_'.$lang.'_product_section_title',
        'grocery_home_page_'.$lang.'_product_section_button_text',
        'grocery_home_page_'.$lang.'_testimonial_area_title',
        'grocery_home_page_'.$lang.'_testimonial_area_subtitle'
    ];

    $var_name = 'home_'.$home;
    return $$var_name ?? abort(404);
}

function filter_static_option_value(string $index , array $array = []){
    return $array[$index] ?? '';
}

function get_attachment_url_by_id($id,$size=null){
   $return_val =  get_attachment_image_by_id($id,$size);
   return $return_val['image_id'] ?? '';
}
function paypal_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::paypal();
}
function paytm_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::paytm();
}

function paystack_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::paystack();
}

function stripe_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::stripe();
}
function flutterwaverave_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::flutterwaverev();
}

function mollie_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::mollie();
}
function razorpay_gateway(){
    return \App\PaymentGateway\PaymentGatewaySetup::razorpay();
}
function script_currency_list(){
    return \App\PaymentGateway\GlobalCurrency::script_currency_list();
}


function purify_html($html){
    return strip_tags(\Mews\Purifier\Facades\Purifier::clean($html));
}

function purify_html_raw($html){
    return \Mews\Purifier\Facades\Purifier::clean($html);
}

function render_pages_list($lang = null){
    $instance = new \App\MenuBuilder\MenuBuilderHelpers();
    return $instance->get_static_pages_list($lang);
}
function render_dynamic_pages_list($lang = null){
    $instance = new \App\MenuBuilder\MenuBuilderHelpers();
    return $instance->get_post_type_page_list($lang);
}
function render_mega_menu_list($lang = null){
    $instance = new \App\MenuBuilder\MegaMenuBuilderSetup();
    return $instance->render_mega_menu_list($lang);
}

function render_draggable_menu($id){
    $instance = new \App\MenuBuilder\MenuBuilderAdminRender();
    return $instance->render_admin_panel_menu($id);
}
function render_frontend_menu($id){
    $instance = new \App\MenuBuilder\MenuBuilderFrontendRender();
    return $instance->render_frrontend_panel_menu($id);
}

function get_product_variant_list_by_id($id){
    $varitnt = \App\ProductVariant::find($id);
    if (empty($varitnt)){
        return '';
    }
    return $varitnt;
}

function ratingMarkup($rating_avg, $rating_count, $include_count = true) {
    $width = round($rating_avg * 20);
    $width_data = '<span class="show-rating" style="width: '.$width.'%"></span>';
    $rate = '';
    if ($include_count) {
        $rate .= '<p><span class="total-ratings">('.$rating_count.')</span></p>';
    }

return <<<HTML
       <div class="rating-wrap">
        <div class="ratings">
            <span class="hide-rating"></span>
            {$width_data}
        </div>
       {$rate}
    </div>
HTML;


}


function array_flatten($array) { 
    if (!is_array($array)) { 
        return FALSE; 
      } 
      $result = array(); 
    foreach ($array as $key => $value) { 
        if (is_array($value)) { 
          $result = array_merge($result, array_flatten($value)); 
        } 
        else { 
          $result[] = $value; 
        } 
    } 
  return $result; 
} 