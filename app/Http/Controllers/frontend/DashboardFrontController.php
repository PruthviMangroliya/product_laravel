<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use App\Models\ProductImagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis as FacadesRedis;
use illuminate\Support\Redis;

class DashboardFrontController extends Controller
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

    public function dashboard(Request $request)
    {

        // Set a value in Redis cache
        // Redis::set('hi', 'hello');

        // return FacadesRedis::get('hi');

        $data['categories'] = Cache::remember('category', 360, function () {
            return CategoryModel::all();
        });
        $data['subcategories'] = Cache::remember('subcategory', 360, function () {
            return SubCategoryModel::all();
        });
        $data['leatest_products'] = Cache::remember('leatest_products', 360, function () {
            return ProductModel::all();
        });
        $data['products'] = Cache::remember('products', 360, function () {
            return ProductModel::orderByDesc('product_id')->limit(6)->get();
        });
        $data['product_images'] = Cache::remember('product_images', 360, function () {
            return ProductImagesModel::all();
        });

        // cache::clear('subcategory');
        // return Cache::get('category');
        // return Cache::get('subcategory');

        // $data['categories'] = CategoryModel::all();
        // $data['subcategories'] = DB::table('subcategory')->get();
        // $data['leatest_products'] = DB::table('products')->orderByDesc('product_id')->limit(6)->get();
        // $data['products'] = ProductModel::all();
        // $data['product_images'] = ProductImagesModel::all();


        // $this->header();
        return view('frontend/index', $data);
    }
}
