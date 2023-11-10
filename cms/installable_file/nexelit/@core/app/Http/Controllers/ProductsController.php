<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Events;
use App\Events\ProductOrders;
use App\Facades\EmailTemplate;
use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Helpers\ProductModuleHelper;
use App\Http\Requests\SlugCheckRequest;
use App\Language;
use App\Mail\BasicMail;
use App\ProductCategory;
use App\ProductOrder;
use App\ProductRatings;
use App\Products;
use App\ProductShipping;
use App\ProductSubCategory;
use App\ProductVariant;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_product()
    {
        $all_products = Products::all()->groupBy('lang');
        return view('backend.products.all-products')->with(['all_products' => $all_products]);
    }

    public function new_product()
    {
        $all_languages = Language::all();
        $all_category = ProductCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        $all_subcategory = ProductSubCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        return view('backend.products.new-product')->with(['all_languages' => $all_languages, 'all_categories' => $all_category, 'all_subcategory' => $all_subcategory]);
    }

    public function store_product(Request $request)
    {
        $this->validate($request, [
            'attributes_title' => 'nullable|array',
            'attributes_description' => 'nullable|array',
            'lang' => 'required|string',
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'category_id' => 'required|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable',
            'regular_price' => 'nullable|string|max:191',
            'sale_price' => 'nullable|string|max:191',
            'sku' => 'nullable|string|max:191',
            'stock_status' => 'nullable|string|max:191',
            'is_downloadable' => 'nullable|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191',
            'gallery' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'badge' => 'nullable|string|max:191',
            'tax_percentage' => 'nullable|string|max:191',
            'downloadable_file' => 'nullable|mimes:doc,docx,jpg,jpeg,png,mp3,mp4,pdf,txt,zip|max:100650',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title, $request->lang);

        $variant = $request->variant ?? [];
        $id = Products::create([
            'attributes_title' => serialize($request->attributes_title),
            'attributes_description' => serialize($request->attributes_description),
            'lang' => $request->lang,
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price ?? 0,
            'sku' => $request->sku,
            'stock_status' => $request->stock_status,
            'is_downloadable' => $request->is_downloadable,
            'direct_download' => !empty($request->direct_download) ? 1 : 0,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'image' => $request->image,
            'gallery' => $request->gallery,
            'status' => $request->status,
            'badge' => $request->badge,
            'tax_percentage' => $request->tax_percentage,
            'subcategory_id' => $request->subcategory_id,
            'variant' => json_encode($variant),
        ])->id;

        if ($request->hasFile('downloadable_file')) {
            $file_extenstion = $request->downloadable_file->getClientOriginalExtension();
            if (in_array($file_extenstion,['doc','docx','jpg','jpeg','png','mp3','mp4','pdf','txt','zip'])) {
                $file_name_with_ext = $request->downloadable_file->getClientOriginalName();
                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_db = $file_name . time() . '.' . $file_extenstion;

                $request->downloadable_file->move('assets/uploads/downloadable/', $file_db);
                Products::where('id', $id)->update(['downloadable_file' => $file_db]);
            }
        }

        return redirect()->back()->with(['msg' => __('New Product Added Success'), 'type' => 'success']);
    }

    public function edit_product($id)
    {
        $product = Products::find($id);
        $all_languages = Language::all();
        $all_category = ProductCategory::where(['status' => 'publish', 'lang' => $product->lang])->get();
        $all_subcategory = ProductSubCategory::where(['status' => 'publish', 'lang' => $product->lang,'product_category_id' => $product->category_id])->get();
        $all_variants = ProductVariant::all();
        return view('backend.products.edit-product')->with([
            'all_languages' => $all_languages,
            'all_categories' => $all_category,
            'all_subcategory' => $all_subcategory,
            'product' => $product,
            'all_variants' => $all_variants,
        ]);
    }

    public function clone_product(Request $request)
    {

        $product = Products::find($request->item_id);
        Products::create([
            'attributes_title' => $product->attributes_title,
            'attributes_description' => $product->attributes_description,
            'lang' => $product->lang,
            'title' => $product->title,
            'slug' => $product->slug.'-clone',
            'category_id' => $product->category_id,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'regular_price' => $product->regular_price,
            'sale_price' => $product->sale_price ?? 0,
            'sku' => $product->sku,
            'stock_status' => $product->stock_status,
            'is_downloadable' => $product->is_downloadable,
            'meta_tags' => $product->meta_tags,
            'meta_description' => $product->meta_description,
            'image' => $product->image,
            'gallery' => $product->gallery,
            'badge' => $product->badge,
            'tax_percentage' => $product->tax_percentage,
            'status' => 'draft',
            'variant' => $product->variant,
            'subcategory_id' => $product->subcategory_id,
            'direct_download' =>  !empty($product->direct_download) ? 1 : 0,
        ]);

        return redirect()->back()->with(['msg' => __('Product Clone Success'), 'type' => 'success']);
    }

    public function delete_product(Request $request, $id)
    {
        $product_details = Products::find($id);
        if (file_exists('assets/uploads/downloadable/' . $product_details->downloadable_file)) {
            @unlink('assets/uploads/downloadable/' . $product_details->downloadable_file);
        }
        $product_details->delete();
        return redirect()->back()->with(['msg' => __('Product Deleted...'), 'type' => 'danger']);
    }

    public function update_product(Request $request)
    {

        $this->validate($request, [
            'attributes_title' => 'nullable|array',
            'attributes_description' => 'nullable|array',
            'lang' => 'required|string',
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'category_id' => 'required|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable',
            'regular_price' => 'nullable|string|max:191',
            'sale_price' => 'nullable|string|max:191',
            'sku' => 'nullable|string|max:191',
            'stock_status' => 'nullable|string|max:191',
            'is_downloadable' => 'nullable|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191',
            'gallery' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'badge' => 'nullable|string|max:191',
            'downloadable_file' => 'nullable|mimes:doc,docx,jpg,jpeg,png,mp3,mp4,pdf,txt,zip|max:10650',
            'tax_percentage' => 'nullable',
        ]);

        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title, $request->lang);
        $variant = $request->variant ?? [];

        Products::where('id', $request->product_id)->update([
            'attributes_title' => serialize($request->attributes_title),
            'attributes_description' => serialize($request->attributes_description),
            'lang' => $request->lang,
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price ?? 0,
            'sku' => $request->sku,
            'stock_status' => $request->stock_status,
            'is_downloadable' => $request->is_downloadable,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'image' => $request->image,
            'gallery' => $request->gallery,
            'status' => $request->status,
            'badge' => $request->badge,
            'tax_percentage' => $request->tax_percentage,
            'subcategory_id' => $request->subcategory_id,
            'direct_download' => !empty($request->direct_download) ? 1 : 0,
            'variant' => json_encode($variant),
        ]);

        $product_details = Products::find($request->product_id);
        if ($request->hasFile('downloadable_file')) {
            $file_extenstion = $request->downloadable_file->getClientOriginalExtension();
            if (in_array($file_extenstion,['doc','docx','jpg','jpeg','png','mp3','mp4','pdf','txt','zip'])) {
                $file_name_with_ext = $request->downloadable_file->getClientOriginalName();
                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_db = $file_name . time() . '.' . $file_extenstion;

                $request->downloadable_file->move('assets/uploads/downloadable/', $file_db);
                if (file_exists('assets/uploads/downloadable/' . $product_details->downloadable_file)) {
                    @unlink('assets/uploads/downloadable/' . $product_details->downloadable_file);
                }
                Products::where('id', $request->product_id)->update(['downloadable_file' => $file_db]);
            }
        }

        return redirect()->back()->with(['msg' => __('Product Update Success...'), 'type' => 'success']);
    }

    public function download_file(Request $request, $id)
    {

        $product_details = Products::find($id);
        if (file_exists('assets/uploads/downloadable/' . $product_details->downloadable_file)) {
            $temp_file = asset('assets/uploads/downloadable/' . $product_details->downloadable_file);
            $file = new Filesystem();

            $file->copy($temp_file, 'assets/uploads/downloadable/' . Str::slug($product_details->title) . '.zip');
            return response()->download('assets/uploads/downloadable/' . Str::slug($product_details->title) . '.zip')->deleteFileAfterSend(true);
        }
        return redirect()->route('admin.home');
    }

    public function page_settings()
    {
        $all_languages = Language::all();
        return view('backend.products.product-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request)
    {
        $this->validate($request, [
            'product_post_items' => 'nullable|string|max:191'
        ]);

        $all_languages = Language::all();

        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'product_add_to_cart_button_' . $lang->slug . '_text' => 'nullable|string|max:191',
                'product_category_' . $lang->slug . '_text' => 'nullable|string|max:191',
                'product_rating_filter_' . $lang->slug . '_text' => 'nullable|string|max:191',
                'product_price_filter_' . $lang->slug . '_text' => 'nullable|string|max:191',
                'product_download_now_button_' . $lang->slug . '_text' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_download_now_button_' . $lang->slug . '_text',
                'product_view_option_button_' . $lang->slug . '_text',
                'product_add_to_cart_button_' . $lang->slug . '_text',
                'product_category_' . $lang->slug . '_text',
                'product_price_filter_' . $lang->slug . '_text',
                'product_rating_filter_' . $lang->slug . '_text',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }

        update_static_option('product_post_items', $request->product_post_items);

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'), 'type' => 'success']);
    }

    public function single_page_settings()
    {
        $all_languages = Language::all();
        return view('backend.products.product-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request)
    {
        $all_languages = Language::all();

        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'product_single_' . $lang->slug . '_add_to_cart_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_category_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_sku_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_description_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_attributes_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_related_product_text' => 'nullable|string|max:191',
                'product_single_' . $lang->slug . '_ratings_text' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_single_' . $lang->slug . '_add_to_cart_text',
                'product_single_' . $lang->slug . '_category_text',
                'product_single_' . $lang->slug . '_subcategory_text',
                'product_single_' . $lang->slug . '_sku_text',
                'product_single_' . $lang->slug . '_description_text',
                'product_single_' . $lang->slug . '_attributes_text',
                'product_single_' . $lang->slug . '_related_product_text',
                'product_single_' . $lang->slug . '_ratings_text',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }

        update_static_option('product_single_related_products_status', $request->product_single_related_products_status);
        update_static_option('product_single_products_review_status', $request->product_single_products_review_status);

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'), 'type' => 'success']);
    }

    public function cancel_page_settings()
    {
        $all_languages = Language::all();
        return view('backend.products.product-cancel-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_cancel_page_settings(Request $request)
    {
        $all_languages = Language::all();

        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'product_cancel_page_' . $lang->slug . '_title' => 'nullable|string|max:191',
                'product_cancel_page_' . $lang->slug . '_description' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_cancel_page_' . $lang->slug . '_title',
                'product_cancel_page_' . $lang->slug . '_description',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'), 'type' => 'success']);
    }

    public function success_page_settings()
    {
        $all_languages = Language::all();
        return view('backend.products.product-success-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_success_page_settings(Request $request)
    {
        $all_languages = Language::all();

        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'product_success_page_' . $lang->slug . '_title' => 'nullable|string|max:191',
                'product_success_page_' . $lang->slug . '_description' => 'nullable|string|max:191',
            ]);
            $fields = [
                'product_success_page_' . $lang->slug . '_title',
                'product_success_page_' . $lang->slug . '_description',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('Page Settings Updated..'), 'type' => 'success']);
    }

    public function product_order_logs()
    {
        $all_orders = ProductOrder::all();
        return view('backend.products.product-orders-all')->with(['all_orders' => $all_orders]);
    }

    public function product_order_payment_approve(Request $request, $id)
    {
        $order_details = ProductOrder::find($id);
        $order_details->payment_status = 'complete';
        $order_details->save();

        try {
            Mail::to($order_details->billing_email)->send(new BasicMail(EmailTemplate::productOrderPaymentAccpetMail($order_details)));
        } catch (\Exception $e) {
            return redirect()->back()->with(['msg' => __('Payment Status Updated, email send failed'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Payment Status Updated..'), 'type' => 'success']);
    }

    public function product_order_delete(Request $request, $id)
    {
        ProductOrder::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Order Log Deleted..'), 'type' => 'danger']);
    }

    public function product_order_status_change(Request $request)
    {
        $this->validate($request, [
            'order_status' => 'nullable|string|max:191'
        ]);
        $order_details = ProductOrder::find($request->order_id);
        $cart_items = unserialize($order_details->cart_items, ['class' => false]);

        $product = '';
        foreach ($cart_items as $item) {
            $product = Products::find($item['id']);
            if (!empty($product)) {
                $product->sales += $item['quantity'];
                $product->save();
            }
        }

        $order_details->status = $request->order_status;
        $order_details->save();

        //send mail while order status change
        try {
            $order_details = ProductOrder::find($request->order_id);
            Mail::to($order_details->billing_email)->send(new BasicMail(EmailTemplate::productOrderStatusChangeMail($order_details)));
        } catch (\Exception $e) {
            return redirect()->back()->with(['msg' => __('Product Order Status Update, email sending failed'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Product Order Status Update..'), 'type' => 'success']);
    }

    public function generate_invoice(Request $request)
    {
        $order_details = ProductOrder::find($request->order_id);
        $pdf = PDF::loadView('backend.products.pdf.order', ['order_details' => $order_details]);
        return $pdf->download('product-order-invoice.pdf');
    }

    public function product_ratings()
    {
        $all_ratings = ProductRatings::all();

        return view('backend.products.product-ratings-all')->with(['all_ratings' => $all_ratings]);
    }

    public function product_ratings_delete(Request $request, $id)
    {
        ProductRatings::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Product Review Deleted..'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request)
    {
        Products::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function product_order_bulk_action(Request $request)
    {
        ProductOrder::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function product_ratings_bulk_action(Request $request)
    {
        ProductRatings::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function order_report(Request $request)
    {
        $order_data = '';
        $query = ProductOrder::query();
        if (!empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if (!empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if (!empty($request->payment_status)) {
            $query->where(['payment_status' => $request->payment_status]);
        }
        if (!empty($request->order_status)) {
            $query->where(['status' => $request->order_status]);
        }
        $error_msg = __('select start & end date to generate event payment report');
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $query->orderBy('id', 'DESC');
            $order_data = $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.products.product-order-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'error_msg' => $error_msg
        ]);
    }

    public function tax_settings()
    {
        $all_languages = Language::all();
        return view('backend.products.product-tax-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_tax_settings(Request $request)
    {
        $this->validate($request, [
            'product_tax' => 'nullable|string',
            'product_tax_system' => 'nullable|string',
            'product_tax_type' => 'nullable|string',
            'product_tax_percentage' => 'nullable'
        ]);

        $all_fields = [
            'product_tax',
            'product_tax_system',
            'product_tax_type',
            'product_tax_percentage'
        ];

        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated'), 'type' => 'success']);
    }

    public function order_reminder(Request $request)
    {
        //send order reminder mail
        $order_details = ProductOrder::find($request->id);
        try {
            //send mail while order status change
            Mail::to($order_details->billing_email)->send(new BasicMail(EmailTemplate::productOrderReminderMail($order_details)));
        } catch (\Exception $e) {
            return redirect()->back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return redirect()->back()->with(['msg' => __('Reminder Mail Send Success'), 'type' => 'success']);
    }

    public function settings()
    {
        return view('backend.products.settings')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_settings(Request $request)
    {
        $this->validate($request, [
            'disable_guest_mode_for_product_module' => 'nullable|string',
            'display_price_only_for_logged_user' => 'nullable|string',
        ]);

        $all_fields = [
            'disable_guest_mode_for_product_module',
            'display_price_only_for_logged_user',
        ];

        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return back()->with(NexelitHelpers::settings_update());
    }

    public function order_new()
    {
        $all_products = Products::where(['lang' => LanguageHelper::default_slug(), 'status' => 'publish'])->get();
        $all_users = User::all();
        $all_shipping = ProductShipping::where(['lang' => LanguageHelper::default_slug(), 'status' => 'publish'])->get();
        return view('backend.products.order-new')->with(['all_products' => $all_products, 'all_users' => $all_users, 'all_shipping' => $all_shipping]);
    }

    public function order_new_store(Request $request)
    {

        $this->validate($request, [
            'payment_gateway' => 'nullable|string',
//            'subtotal' => 'required|string',
            'coupon_discount' => 'nullable|string',
            'shipping_cost' => 'nullable|string',
            'product_shippings_id' => 'nullable|string',
//            'total' => 'required|string',
            'billing_name' => 'required|string',
            'billing_email' => 'required|string',
            'billing_phone' => 'required|string',
            'billing_country' => 'required|string',
            'billing_street_address' => 'required|string',
            'billing_town' => 'required|string',
            'billing_district' => 'required|string',
            'different_shipping_address' => 'nullable|string',
            'shipping_name' => 'nullable|string',
            'shipping_email' => 'nullable|string',
            'shipping_phone' => 'nullable|string',
            'shipping_country' => 'nullable|string',
            'shipping_street_address' => 'nullable|string',
            'shipping_town' => 'nullable|string',
            'shipping_district' => 'nullable|string'
        ],
            [
                'billing_name.required' => __('The billing name field is required.'),
                'billing_email.required' => __('The billing email field is required.'),
                'billing_phone.required' => __('The billing phone field is required.'),
                'billing_country.required' => __('The billing country field is required.'),
                'billing_street_address.required' => __('The billing street address field is required.'),
                'billing_town.required' => __('The billing town field is required.'),
                'billing_district.required' => __('The billing district field is required.')
            ]);
        $cart_item = '';
        $cart_instance = new ProductModuleHelper();
        foreach ($request->product as $pid => $item) {
            $cart_item = $cart_instance->add_to_cart($pid, $item['qty'], $item['var']);
        }


        $order_id = ProductOrder::create([
            'payment_gateway' => $request->payment_gateway,
            'payment_status' => 'pending',
            'payment_track' => Str::random(10) . Str::random(10),
            'user_id' => $request->user_id,
            'subtotal' => $cart_instance->subtotal(),
            'coupon_discount' => 0,
            'coupon_code' => null,
            'shipping_cost' => $cart_instance->shipping_cost($request->product_shippings_id),
            'product_shippings_id' => $request->product_shippings_id,
            'total' => $cart_instance->total($request->product_shippings_id, null),
            'billing_name' => $request->billing_name,
            'billing_email' => $request->billing_email,
            'billing_phone' => $request->billing_phone,
            'billing_country' => $request->billing_country,
            'billing_street_address' => $request->billing_street_address,
            'billing_town' => $request->billing_town,
            'billing_district' => $request->billing_district,
            'different_shipping_address' => $request->different_shipping_address ? 'yes' : 'no',
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_country' => $request->shipping_country,
            'shipping_street_address' => $request->shipping_street_address,
            'shipping_town' => $request->shipping_town,
            'shipping_district' => $request->shipping_district,
            'cart_items' => serialize($cart_item),
            'status' => $request->status,
        ])->id;


        event(new ProductOrders([
            'order_id' => $order_id
        ]));

        return back()->with(NexelitHelpers::settings_update(__('New Order Created, it will also show in use dashboard')));
    }

    public function order_view($id)
    {
        $order_details = ProductOrder::findOrFail($id);
        return view('backend.products.order-view', compact('order_details'));
    }


    public function cart_user_details_ajax(Request $request)
    {
        $user_details = User::find($request->id);
        if (empty($user_details)) {
            return [];
        }

        return response()->json($user_details);
    }

    public function cart_qty_recalculate_ajax(Request $request)
    {
        $product_details = Products::find($request->id);
        if (empty($product_details)) {
            return [];
        }
        $unit_price = amount_with_currency_symbol($product_details->sale_price);
        $tax_amount = 0;
        $amount = $product_details->sale_price * $request->qty;
        if (get_static_option('product_tax_type') === 'individual') {
            $tax_amount = ($amount / 100) * $product_details->tax_percentage;
            $tax_markup = amount_with_currency_symbol($tax_amount) . '(' . $product_details->tax_percentage . '%)';
        }
        $subtotal = (get_static_option('product_tax_type') === 'individual') ? $amount + $tax_amount : $amount;
        $subtotal_markup = amount_with_currency_symbol($subtotal);

        return response()->json([
            'unit_price' => $unit_price,
            'tax_markup' => $tax_markup,
            'subtotal_markup' => $subtotal_markup,
        ]);
    }


    public function cart_markup_by_ajax(Request $request)
    {

        $product_details = Products::find($request->id);
        if (empty($product_details)) {
            return '';
        }


        $product_id = $request->id;
        $image_markup = render_image_markup_by_attachment_id($product_details->image, '', 'thumb');
        $title = $product_details->title;
        $route = route('frontend.products.single', $product_details->slug);
        $product_variant_markup = '';
                    if (!empty($product_details->variant)):
                        foreach (json_decode($product_details->variant) as $id => $terms):
                            $variant = get_product_variant_list_by_id($id);
                            if (!empty($variant)):
                                $product_variant_markup = '<div class="product-variant-list-wrapper"><h5 class="title">' . $variant->title . '</h5><ul class="product-variant-list">';
                                $prices = json_decode($variant->price);
                                foreach ($terms as $term):
                                    $v_term_index = array_search($term, json_decode($variant->terms, true));
                                    $product_variant_markup .= '<li data-variantid="' . $id . '" data-variantname="' . $variant->title . '" data-term="' . $term . '"';

                                    if (isset($prices[$v_term_index]) && !empty($prices[$v_term_index])) {
                                        $product_variant_markup .= 'data-price="' . $prices[$v_term_index] . '" data-termprice="' . amount_with_currency_symbol($prices[$v_term_index] + $product_details->sale_price) . '"';
                                    } else {
                                        $product_variant_markup .= 'data-termprice="' . amount_with_currency_symbol($product_details->sale_price) . '"';
                                    }
                                    $product_variant_markup .= '>' . $term;
                                    if (isset($prices[$v_term_index]) && !empty($prices[$v_term_index])) {
                                        $product_variant_markup .= '<small>+ ' . amount_with_currency_symbol($prices[$v_term_index]) . ' </small>';
                                    }
                                    $product_variant_markup .= '</li>';
                                endforeach;
                                $product_variant_markup .= '</ul></div>';
                            endif;
                        endforeach;
                    endif;
                    $product_variant_markup .= '</ul>';
                    $product_variant_markup .= '</div>';
        $unit_price = amount_with_currency_symbol($product_details->sale_price);
        $tax_amount = 0;
        if (get_static_option('product_tax_type') == 'individual') {
            $tax_amount = ($product_details->sale_price / 100) * $product_details->tax_percentage;
            $tax_markup = amount_with_currency_symbol($tax_amount) . '(' . $product_details->tax_percentage . '%)';
        }
        $subtotal = (get_static_option('product_tax_type') == 'individual') ? $product_details->sale_price + ($tax_amount * 1) : $product_details->sale_price;
        $subtotal_markup = amount_with_currency_symbol($subtotal);
        return <<<HTML
<tr>
    <td>
        <div class="thumbnail">
            {$image_markup}
        </div>
    </td>
    <td>
        <h4 class="product-title">
            <a target="_blank" href="{$route}">{$title}</a>
        </h4>
        {$product_variant_markup}
         <input type="hidden" name="product[{$product_id}]" value="{$product_id}">
         <input type="hidden" class="product_variant_input" name="product[{$product_id}][var]" >
    </td>
    <td>
        <input type="number" name="product[$product_id][qty]" class="quantity" data-productid="{$product_id}" value="1">
    </td>
    <td class="unit_price">{$unit_price}</td>
    <td class="tax_amount">{$tax_markup}</td>
    <td class="subtotal">{$subtotal_markup}</td>
    <td>
        <div class="cart-action-wrap">
            <a href="#"
               class="btn btn-sm btn-danger ajax_remove_cart_item">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
HTML;

    }

    public function slug_check(SlugCheckRequest $request){

        $user_given_slug = $request->slug;
        $query = Products::where(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }
}
