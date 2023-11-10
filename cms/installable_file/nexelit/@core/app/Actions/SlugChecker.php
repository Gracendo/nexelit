<?php

namespace App\Actions;

class SlugChecker
{
    public static function Check($request,$model){
        $user_given_slug = $request->slug;
        if (!empty($request->lang)){
            $model->where('lang' , $request->lang);
        }
        $slug_count = $model->count();

        if ($request->type === 'new' && $slug_count > 0){
            return $user_given_slug.'-'.$slug_count;
        }elseif ($request->type === 'update' && $slug_count > 1){
            return $user_given_slug.'-'.$slug_count;
        }
        return $user_given_slug;
    }
}