<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\ProductImagesModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\Cache;

class CategoryFrontController extends Controller
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

    //     // return $data;
    //     echo view('frontend/header', $data);
    // }

    public function get_category_info($category_id)
    {

        $data['categories'] = Cache::remember('CATEGORY_SINGLE_'.$category_id, 360, function () use($category_id){
            return CategoryModel::find($category_id);
        });
        $data['subcategories'] = Cache::remember('subcategory_'.$category_id, 360, function () use($category_id){
            return SubCategoryModel::where('category_id', $category_id)->get();
        });
        $data['products'] = Cache::remember('products_'.$category_id, 360, function () use($category_id){
            return ProductModel::where('category_id', $category_id)->get();
        });
        $data['product_images'] = Cache::remember('product_images', 360, function () {
            return ProductImagesModel::all();
        });

        // $data['categories'] =CategoryModel::where('category_id', $category_id)->get();
        // $data['subcategories'] = SubCategoryModel::where('category_id', $category_id)->get();
        // $data['products'] = ProductModel::where('category_id', $category_id)->get();
        // $data['product_images'] = ProductImagesModel::all();
        
        $data['cart_data'] = session()->get('cart');


        return view('frontend/category_description', $data);
   
    }
}
