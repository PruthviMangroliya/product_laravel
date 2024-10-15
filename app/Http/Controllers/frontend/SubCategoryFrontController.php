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

class SubCategoryFrontController extends Controller
{
    public function header()
    {
        // $data['categories'] = DB::table('category')->get();
        // $data['subcategories'] = DB::table('subcategory')->get();
        $data['categories'] = Cache::remember('category', 160, function () {
            return CategoryModel::all();
        });
        $data['subcategories'] = Cache::remember('subcategory', 60, function () {
            return SubCategoryModel::all();
        });

        $data['cart_data'] = session()->get('cart');

        if (!empty($data['cart_data'])) {
            foreach ($data['cart_data'] as $product_id => $quantity) {
                $cart_product_ids[] = $product_id;
            }
            // $product_ids=implode(',',$cart_product_ids);
            // $data['cart_products'] = DB::table('products')->where('product_id','IN',$product_ids)->get();

            $data['cart_products'] = DB::table('products')->whereIn('product_id', $cart_product_ids)->get();
            $data['product_images'] = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
        }
        
        echo view('frontend/header', $data);
    }

    public function get_subcategory_info($subcategory_id)
    {
         $data['categories'] = Cache::remember('category', 360, function () {
            return CategoryModel::all();
        });
        $data['subcategories'] = Cache::remember('subcategory_'.$subcategory_id, 360, function () use($subcategory_id){
            return SubCategoryModel::where('subcategory_id', $subcategory_id)->get();
        });
        $data['products'] = Cache::remember('products_'.$subcategory_id, 360, function () use($subcategory_id){
            return ProductModel::where('subcategory_id', $subcategory_id)->get();
        });
        $data['product_images'] = Cache::remember('product_images', 360, function () {
            return ProductImagesModel::all();
        });

        // $data['categories'] = DB::table('category')->get();
        // $data['subcategories'] = DB::table('subcategory')->where('subcategory_id', $subcategory_id)->get();;
        // $data['products'] = DB::table('products')->where('subcategory_id', $subcategory_id)->get();
        // $data['product_images'] = DB::table('product_images')->get();

        $data['cart_data'] = session()->get('cart');

        // $this->header();
        return view('frontend/subcategory_description', $data);
        // echo view('frontend/footer');
    }
}
