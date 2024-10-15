<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\OptionModel;
use App\Models\ProductImagesModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add_to_cart(Request $request, $product_id)
    {
        // return $request->all();


        //======================= product selected option ==============================
        $options = DB::table('product_option')->join('options', 'options.option_id', '=', 'product_option.option_id')
            ->where(['product_id' => $product_id])->get();

        $cart_product_option = $request->session()->get('cart_product_option');
        foreach ($options as $option) {

            $option_name = $option->option_name;

            if (!empty($request->$option_name)) {

                // echo $request->$option_name;
                $product_option[] = array(
                    $option_name => $request->$option_name
                );

                if (isset($cart_product_option[$product_id])) {
                    $cart_product_option[$product_id] = $product_option;
                } else {
                    $cart_product_option[$product_id] = $product_option;
                }
            }
        }
        session()->put('cart_product_option', $cart_product_option);
        // $request->session()->forget('cart_product_option');
        // return $cart_product_option;
        //======================= product selected option ==============================


        $cart_data = $request->session()->get('cart');
        $quantity = $request->quantity;

        if (!empty($cart_data)) {

            if (isset($cart_data[$product_id])) {

                echo "update quantity";
                $cart_quantity = $cart_data[$product_id];

                $cart_data[$product_id] = $cart_quantity + $quantity;
                session()->put('cart', $cart_data);
            } else {

                echo "add item";
                $cart_data[$product_id] = 1;
                // return $cart_data;
                session()->put('cart', $cart_data);
            }
        } else {

            echo "create session and add";
            $cart = [
                $product_id => $quantity
            ];
            session()->put('cart', $cart);
        }

        $cart_data = $request->session()->get('cart');
        // return $cart_data;

        // session()->flash('item_added', 'Item added to cart successfully');

        return redirect()->back()->with('message', 'Item added to cart successfully!');
        // $request->session()->forget('cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $cart_data = session()->get('cart');

        $product_id =$request->product_id;
        $quantity =$request->quantity;
        $product_price =$request->product_price;

        $cart_data[$product_id] = $quantity;

        session()->put('cart', $cart_data);

        $data['pricing'] = ($product_price * $quantity);
        $data['g_total'] = 20;

        return $data;
        //  session()->forget('cart');

    }

    public function view_cart(Request $request)
    {
        $data['cart_data'] = $request->session()->get('cart');
        $data['cart_product_option_data'] = $request->session()->get('cart_product_option');


        $data['categories'] = Cache::remember('category', 360, function () {
            return CategoryModel::all();
        });
        $data['subcategories'] = Cache::remember('subcategory', 360, function () {
            return SubCategoryModel::all();
        });  
        $data['subcategories'] = Cache::remember('subcategory', 360, function () {
            return OptionModel::all();
        });
        // $data['options'] = DB::table('options')->get();
        // $data['categories'] = DB::table('category')->get();
        // $data['subcategories'] = DB::table('subcategory')->get();

        if (!empty($data['cart_data'])) {
            foreach ($data['cart_data'] as $product_id => $quantity) {
                $cart_product_ids[] = $product_id;
            }
            // print_r($cart_product_ids);

            $data['cart_products'] = DB::table('products')
                ->join('category', 'products.category_id', '=', 'category.category_id')
                ->join('subcategory', 'products.subcategory_id', '=', 'subcategory.subcategory_id')
                ->whereIn('products.product_id', $cart_product_ids)->get();

            $data['cart_product_images'] = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
            $data['cart_product_images'] = ProductImagesModel::whereIn('product_id', $cart_product_ids)->get();
        }

        // return $data;

        return view('frontend/view_cart', $data);
    }

    public function remove_cart($product_id)
    {
        // session()->forget('cart')[$product_id];
        Session()->forget('cart.' . $product_id);
        Session()->forget('cart_product_option.' . $product_id);


        // $cart = session()->get('cart'); // Get the array
        // unset($cart[$product_id]); // Unset the index you want
        // session()->set('cart', $cart); // Set the array again


        $data['cart_data'] = session()->get('cart');
        // return $data;
        return redirect()->back()->with('message', 'Item removed from cart successfully!');
    }
}
