<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductImagesModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ProductFrontController extends Controller
{
    // public function header()
    // {
    //     $data['categories'] = DB::table('category')->get();
    //     $data['subcategories'] = DB::table('subcategory')->get();

    //     $data['cart_data'] = session()->get('cart');

    //     if (!empty($data['cart_data'])) {
    //         foreach ($data['cart_data'] as $product_id => $quantity) {
    //             $cart_product_ids[] = $product_id;
    //         }
    //         // $product_ids=implode(',',$cart_product_ids);
    //         // $data['cart_products'] = DB::table('products')->where('product_id','IN',$product_ids)->get();

    //         $data['cart_products'] = DB::table('products')->whereIn('product_id', $cart_product_ids)->get();
    //         $data['product_images'] = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
    //     }

    //     echo view('frontend/header', $data);
    // }

    public function  product_description($product_id)
    {
        $data['categories'] = Cache::remember('category', 360, function () {
            return CategoryModel::all();
        });
        $data['subcategories'] = Cache::remember('subcategory', 360, function () {
            return SubCategoryModel::all();
        });

        $data['products'] = Cache::remember('products_' . $product_id, 360, function () use ($product_id) {
            return ProductModel::where('product_id', $product_id)->get();
        });
        $data['product_images'] = Cache::remember('product_images', 360, function () use ($product_id) {
            return ProductImagesModel::where('product_id', $product_id)->get();
        });
        // $data['categories'] = DB::table('category')->get();
        // $data['subcategories'] = DB::table('subcategory')->get();
        // $data['products'] = DB::table('products')->where('product_id', $product_id)->get();
        // $data['product_images'] = DB::table('product_images')->where('product_id', $product_id)->get();
        $data['product_attributes'] = DB::table('product_attributes')
            ->join('attributes', 'attributes.attribute_id', '=', 'product_attributes.attribute_id')
            ->where('product_id', $product_id)
            ->get();

        $data['product_option'] = DB::table('product_option')->join('options', 'options.option_id', '=', 'product_option.option_id')
            ->where(['product_id' => $product_id])->get();
        // ->where(['product_id'=> $product_id,'product_option.option_status'=>'enable'])->get();

        $data['product_option_value'] = DB::table('product_option_value')
            ->join('option_value', 'option_value.option_value_id', '=', 'product_option_value.option_value_id')
            ->join('options', 'options.option_id', '=', 'option_value.option_id')
            ->where('product_id', $product_id)->get();

        $data['cart_data'] = session()->get('cart');

        // $data['coupons'] = DB::table('coupon_apply_on')->join('coupons', 'coupons.coupon_id', '=', 'coupon_apply_on.coupon_id')->where('apply_on', $product_id)->get();
        $data['coupons'] = DB::table('coupon_apply_on')->join('coupons', 'coupons.coupon_id', '=', 'coupon_apply_on.coupon_id')->get();

        // return $data;
        return view('frontend/product_description', $data);
    }
}
