<?php
namespace App\Helpers;
/**
 * this class will contain all helper method for nexelit
 * @since 2.0.4
 * */
    class NexelitHelpers{
        public static function database_upgrade($msg = null){
            return [
                'msg' => __('Database Upgrade Success'),
                'type' => 'success'
            ];
        }
        public static function payment_approved($msg = null){
            return [
                'msg' => __('Payment Approved'),
                'type' => 'success'
            ];
        }
        public static function reminder_mail($msg = null){
            return [
                'msg' => __('Reminder mail send'),
                'type' => 'success'
            ];
        }
        public static function somethig_wrong($msg = null){
            return [
                'type' => 'danger',
                'msg' => $msg ?? __('Something Went Wrong!!. Try Again Later')
            ];
        }
        public static function settings_update($msg = null){
            return [
                'type' => 'success',
                'msg' => $msg ?? __('Settings Updated')
            ];
        }
        public static function item_update($msg = null){
            return [
                'type' => 'success',
                'msg' => $msg ?? __('Item Updated')
            ];
        }
        public static function item_new($msg = null){
            return [
                'type' => 'success',
                'msg' => $msg ?? __('Item Added')
            ];
        }
        public static function item_delete($msg = null){
            return [
                'type' => 'danger',
                'msg' => $msg ?? __('Item Delete')
            ];
        }
        public static function item_clone($msg = null){
            return [
                'type' => 'success',
                'msg' => $msg ?? __('Item Cloned')
            ];
        }
    }
?>