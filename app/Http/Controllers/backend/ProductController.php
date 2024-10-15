<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubcategoryModel;
use App\Models\ProductModel;
use App\Http\Requests\productRequest;
use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\OptionModel;
use App\Models\OptionValueModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductImagesModel;
use App\Models\ProductOptionModel;
use App\Models\ProductOptionValueModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function product_list()
    {
        $data['products'] = productModel::all();
        $data['product_image'] = ProductImagesModel::all();

        return view('backend/product/product_list', $data);
    }

    public function add_product(Request $request)
    {
        if (!$_POST) {

            $data['category'] = CategoryModel::all();
            $data['subcategory'] = SubCategoryModel::all();
            $data['attribute'] = AttributeModel::all();
            $data['options'] = OptionModel::all();
            $data['option_values'] = OptionValueModel::all();

            return view('backend/product/add_product', $data);
        } else {

            $request->validate(
                [
                    'product_title' => 'required|alpha|max:50',
                    'product_description' => 'required|alpha_num|max:200',
                    'product_price' => 'required|numeric|max:50',
                    'product_quantity' => 'required | numeric',
                    'category_id' => 'required',
                    'subcategory_id' => 'required'
                ]
            );

            $product_images = $request->product_images;
            $attributes_array = $request->attribute_ids;
            $options_array = $request->options;


            // ================= store product in product Table================= 
            $product = productModel::create([
                'product_title' => $request->product_title,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id
            ]);

            $product_id = $product->product_id;

            // ================= image upload and store in DB================= 
            foreach ($product_images as $image) {

                $path = 'uploads/products';
                // //Move Uploaded File

                $image_name = $path . "/" . $request->product_title . rand() . '.' . $image->getClientOriginalExtension();

                $image->move($path, $image_name);

                ProductImagesModel::create([
                    'product_image_name' => $image_name,
                    'product_id' => $product_id
                ]);
            }

            // ================= store attribut in product_attribute Table================= 
            if (!empty($attributes_array)) {
                foreach ($attributes_array as $attribute_id) {

                    ProductAttributeModel::create([
                        'product_id' => $product_id,
                        'attribute_id' => $attribute_id
                    ]);

                    $data['product_attribute'] = array(
                        'product_id' => $product_id,
                        'attribute_id' => $attribute_id
                    );
                }
            }

            //================= store Options in product_option table=================
            if (!empty($options_array)) {
                foreach ($options_array as $option_id) {
                    $product_option = ProductOptionModel::create([
                        'option_id' => $option_id,
                        'product_id' => $product_id,
                        'option_status' => $_POST['option_status_' . $option_id]
                    ]);

                    $data['product_option'][] = array(
                        'option_id' => $option_id,
                        'product_id' => $product_id,
                        'option_status' => $_POST['option_status_' . $option_id]
                    );
                }
                // $product_option_id = $product_option->product_option_id;
            }



            // //================= store Options in product_option_value  table================= //old
            // if (!empty($options_array)) {
            //     foreach ($option_value_id_array as $key => $option_value_id) {
            //         ProductOptionValueModel::create([
            //             'product_option_id' => $product_option_id,
            //             'option_value_id' => $option_value_id,
            //             'product_id' => $product_id,
            //             'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //             'option_value_price' => $option_value_price_array[$key]
            //         ]);

            //         // $data['product_option_value'][] = array(
            //         //     'product_option_id' => $product_option_id,
            //         //     'option_value_id' => $option_value_id,
            //         //     'product_id' => $product_id,
            //         //     'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //         //     'option_value_price' => $option_value_price_array[$key]
            //         // );
            //     }
            // }

            // ================= store Options in product_option_value  table================= //new

            $add_option_value_array = $request->add_option_value_id;
            $add_option_value_price_array = $request->add_option_value_price;
            $i = $request->status_num;

            if (!empty($add_option_value_price_array)) {
                foreach ($add_option_value_price_array as $key => $value_price) {
                    ProductOptionValueModel::create([
                        'option_id' => $option_id,
                        'option_value_id' => $add_option_value_array[$key],
                        'product_id' => $product_id,
                        'option_value_status' => $_POST['add_option_value_status_' . $i[$key]],
                        'option_value_price' => $value_price
                    ]);
                }
            }


            // return $data;
            return redirect()->to('product_list');
        }
    }

    public function edit_product(Request $request, $product_id)
    {
        if (!$_POST) {

            $data['category'] = CategoryModel::all();
            $data['subcategory'] = SubCategoryModel::all();
            $data['attribute'] = AttributeModel::all();
            $data['options'] = OptionModel::all();
            $data['product'] = productModel::find($product_id);
            $data['product_image'] = ProductImagesModel::all();
            $data['product_attribute'] = ProductAttributeModel::where("product_id", $product_id)->get();
            $data['product_option'] = ProductOptionModel::join('options', 'product_option.option_id', 'options.option_id')->where("product_id", $product_id)->get();
            $data['product_option_values'] = ProductOptionValueModel::join('option_value', 'product_option_value.option_value_id', 'option_value.option_value_id')->where("product_id", $product_id)->get();
            $data['option_values'] = OptionValueModel::join('options', 'option_value.option_id', 'options.option_id')->get();

            return view('backend/product/edit_product', $data);
        } else {

            $request->validate(
                [
                    'product_title' => 'required|alpha|max:50',
                    'product_description' => 'required|max:200',
                    'product_price' => 'required|numeric',
                    'product_quantity' => 'required | numeric',
                    'category_id' => 'required',
                    'subcategory_id' => 'required'
                ]
            );

            $product_images = $request->product_images;
            $attributes_array = $request->attribute_ids;
            $options_array = $request->options;
            $option_value_id_array = $request->option_value_id;
            $option_value_price_array = $request->option_value_price;

            $product_attribute = ProductAttributeModel::where("product_id", $product_id)->get('attribute_id');
            $product_options = ProductOptionModel::where("product_id", $product_id)->get('option_id');

            //===================== update product ===================== 
            productModel::find($product_id)->update([
                'product_title' => $request->product_title,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id
            ]);

            //==================== add/update  product attribute 
            $attribute_id = array();
            foreach ($product_attribute as $p) {
                $attribute_id[] = $p->attribute_id;
            }
            if (!empty($attributes_array)) {


                //================= store attribute in product_attribute Table================= 
                foreach ($attributes_array as $attribute) {
                    if (!in_array($attribute, $attribute_id)) {

                        ProductAttributeModel::create([
                            'product_id' => $product_id,
                            'attribute_id' => $attribute
                        ]);
                    }
                }

                //================= delete attribute if it is removed ========================
                if (!empty($attribute_id)) {
                    foreach ($attribute_id as $attribute) {
                        if (!in_array($attribute, $attributes_array)) {
                            ProductAttributeModel::where(['attribute_id' => $attribute, 'product_id' => $product_id])->delete();
                            // DB::table('product_attributes')->where(['attribute_id' => $attribute, 'product_id' => $product_id])->delete();
                        }
                    }
                }
            } else {

                $attributes_array = array();

                //================= delete attribute when all attribute  removed ========================
                if (!empty($attribute_id)) {
                    foreach ($attribute_id as $attribute) {
                        if (!in_array($attribute, $attributes_array)) {
                            ProductAttributeModel::where(['attribute_id' => $attribute, 'product_id' => $product_id])->delete();
                            // DB::table('product_attributes')->where(['attribute_id' => $attribute, 'product_id' => $product_id])->delete();
                        }
                    }
                }
            }

            //================= image upload and store in DB================= 
            if (!empty($product_images)) {
                foreach ($product_images as $image) {
                    $path = 'uploads/products';
                    $image_name = $path . "/" . $request->product_title . rand() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $image_name);

                    ProductImagesModel::create([
                        'product_image_name' => $image_name,
                        'product_id' => $product_id
                    ]);
                }
            }

            //================= store Options in product_option table=================
            if (!empty($options_array)) {
                $option_ids = array();
                foreach ($product_options as $option) {
                    $option_ids[] = $option->option_id;
                }

                foreach ($options_array as $option_id) {

                    if (!in_array($option_id, $option_ids)) {

                        ProductOptionModel::create([
                            'option_id' => $option_id,
                            'product_id' => $product_id,
                            'option_status' => $_POST['option_status_' . $option_id]
                        ]);
                    } else {
                        ProductOptionModel::where('option_id', $option->option_id)->update([
                            'option_status' => $_POST['option_status_' . $option_id]
                        ]);
                    }
                }
            }


            // ================= store Options values in product_option_value  table================= //old
            // if (!empty($options_array)) {
            //     $option_value_ids = array();
            //     foreach ($product_option_values as $value) {
            //         $option_value_ids[] = $value->option_value_id;
            //     }

            //     foreach ($option_value_id_array as $key => $option_value_id) {

            //         if (!in_array($option_value_id, $option_value_ids)) {

            //             ProductOptionValueModel::create([
            //                 'product_option_id' => $product_option_id,
            //                 'option_value_id' => $option_value_id,
            //                 'product_id' => $product_id,
            //                 'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //                 'option_value_price' => $option_value_price_array[$key]
            //             ]);

            //             // $data['product_option_value'][] = array(
            //             //     'create',
            //             //     'product_option_id' => $product_option_id,
            //             //     'option_value_id' => $option_value_id,
            //             //     'product_id' => $product_id,
            //             //     'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //             //     'option_value_price' => $option_value_price_array[$key]
            //             // );
            //         } else {
            //             ProductOptionValueModel::where('option_value_id', $option_value_id)->update([
            //                 'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //                 'option_value_price' => $option_value_price_array[$key]
            //             ]);

            //             // $data['product_option_value'][] = array(
            //             //     'update',                           
            //             //     'option_value_status' => $_POST['option_value_status_' . $option_value_id],
            //             //     'option_value_price' => $option_value_price_array[$key]
            //             // );
            //         }
            //     }
            // }

            // ================= store Options Values in product_option_value  table================= //new

            $add_option_value_array = $request->add_option_value_id;
            $add_option_value_price_array = $request->add_option_value_price;
            $i = $request->status_num;

            if (!empty($add_option_value_price_array)) {
                foreach ($add_option_value_price_array as $key => $value_price) {
                    ProductOptionValueModel::create([
                        'option_id' => $option_id,
                        'option_value_id' => $add_option_value_array[$key],
                        'product_id' => $product_id,
                        'option_value_status' => $_POST['add_option_value_status_' . $i[$key]],
                        'option_value_price' => $add_option_value_price_array[$key]
                    ]);
                }
            }

            // ================update Option Value in product_option_value table ===================
            $option_value_id_array = $request->option_value_id;
            $option_value_price_array = $request->option_value_price;

            if (!empty($option_value_price_array)) {

                foreach ($option_value_id_array as $key => $option_value_id) {
                    ProductOptionValueModel::where('option_value_id', $option_value_id)->update([
                        'option_value_status' => $_POST['option_value_status_' . $key],
                        'option_value_price' => $option_value_price_array[$key]
                    ]);
                }
            }

            // return $data;
            //clear the cache for product
            Cache::clear('products');

            return redirect()->to('product_list')->with('message', 'Product Updated successfully');
        }
    }

    public function get_option_values(Request $request)
    {
        $option_id = $request->option_id;

        // $options = OptionModel::whereIn('option_id', $option_id)->get();
        // $option_values = DB::table('option_value')->join('options', 'option_value.option_id', '=', 'options.option_id')->whereIn('option_value.option_id', $option_id)->get();

        $data['options'] = OptionModel::whereIn('option_id', $option_id)->get();
        $data['option_values'] = DB::table('option_value')->join('options', 'option_value.option_id', '=', 'options.option_id')->whereIn('option_value.option_id', $option_id)->get();

        return $data;
        
        // foreach ($options as $option) {
        //     // echo $option->option_name;
        //     echo '
        //     <div class="form-control">
        //         <h4>' . $option->option_name . ' Status : </h4>
        //         <b>Enable</b> <input type="radio" name="option_status_' . $option->option_id . '"
        //             value="enable" checked>
        //         &emsp;
        //         <b> Disable </b><input type="radio"
        //             name="option_status_' . $option->option_id . '" value="disable">
        //         &emsp;
        //     </div>
        //     <br>';
        // }
        // echo '<table class="table">
        //     <thead>
        //         <th class="col-3"> Option </th>
        //         <th class="col-2"> Option Value </th>
        //         <th class="col-2"> Option Value Price</th>
        //         <th> Option Value Status</th>
        //         <th></th>
        //     </thead>
        // </table> ';

        // foreach ($option_values as $key => $value) {
        //     echo  '                    
        //             <div class="col-12 option_values form-control" >

        //                 <input class="col-2" type="text" name="add_option_ids[]" disabled
        //                 value="' . $value->option_name . ' "> &emsp;
            
        //                 <input type="hidden" name="add_option_value_id[]"
        //                     value="' . $value->option_value_id . ' "> &emsp;

        //                 <input class="col-2" type="text" name="add_option_value_name[]" disabled
        //                     value="' . $value->option_value . ' "> &emsp;

        //                 <input class="col-2" type="text" name="add_option_value_price[]"
        //                     value=""> &emsp;

        //                 <input type="hidden" value="' . $key . '" name=status_num[]>

        //                 Enable <input type="radio"
        //                     name="add_option_value_status_' . $key . '"
        //                     value="enable" checked> &emsp;
        //                 Disable <input type="radio"
        //                     name="add_option_value_status_' . $key . '"
        //                     value="disable"> &emsp;

        //                 <button type="button" class="btn btn-danger " id="remove"> X
        //                 </button>

        //             </div>
        //             <br> ';
        // }
    }

    public function delete_product($product_id)
    {
        productModel::where(['product_id' => $product_id])->delete();
        ProductImagesModel::where(['product_id' => $product_id])->delete();

        return redirect()->to('product_list');
    }

    public function delete_image(Request $request)
    {
        $product_image_id = $request->img_id;
        $image = ProductImagesModel::find($product_image_id);
        // echo $image->product_image_name;
        unlink($image->product_image_name);
        ProductImagesModel::where(['product_image_id' => $product_image_id])->delete();
    }

    public function delete_option()
    {
        $option_id = $_POST['option_id'];
        DB::table('options')->where(['option_id' => $option_id])->delete();
    }
}
