<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubcategoryModel;
use App\Models\categoryModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class SubCategoryController extends Controller
{
    public function subcategory_list()
    {
        // $data['subcategories'] = SubCategoryModel::all();
        $data['subcategories'] = DB::table('subcategory')->join('category', 'subcategory.category_id', '=', 'category.category_id')->get();


        return view('backend/subcategory/subcategory_list', $data);
    }

    public function add_subcategory(Request $request)
    {
        if (!$_POST) {

            $data['category'] = CategoryModel::all();

            return view('backend/subcategory/add_subcategory', $data);
        } else {

            $image = $request->subcategory_image;
            //============= image =================
            $path = 'uploads/subcategory';
            $image_name = $path . "/" . $request->subcategory_name . rand() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $image_name);

            SubCategoryModel::create([
                'subcategory_name' => $request->subcategory_name,
                'category_id' => $request->category_id,
                'subcategory_image' => $image_name,
            ]);

            return redirect()->to('subcategory_list');
        }
    }

    public function edit_subcategory(Request $request, $subcategory_id)
    {
        if (!$_POST) {

            $data['category'] = categoryModel::all();
            $data['subcategory'] = SubcategoryModel::find($subcategory_id);
            // return $data;
            // foreach ($data as $s) {
            //    echo $category_id = $s->category_id;
            //    echo $subcategory_name = $s->subcategory_name;
            // }

            return view('backend/subcategory/edit_subcategory', $data);
        } else {

            $image = $request->subcategory_image;

            // if ($image != '') {
            //     //============= image =================
            //     $path = 'uploads/subcategory';
            //     $image_name = $path . "/" . $request->subcategory_name . rand() . '.' . $image->getClientOriginalExtension();
            //     $image->move($path, $image_name);

            //     SubcategoryModel::where(['subcategory_id' => $subcategory_id])->update([
            //         'subcategory_image' => $image_name,
            //     ]);
            // }

            SubcategoryModel::where(['subcategory_id' => $subcategory_id])->update([
                // SubcategoryModel::find($subcategory_id)->update([
                'subcategory_name' => $request->subcategory_name,
                'category_id' => $request->category_id
            ]);

            //clear the cache for subcategory
            Cache::clear('subcategory');

            return redirect()->to('subcategory_list');
        }
    }

    public function delete_subcategory($subcategory_id)
    {
        echo $subcategory_id;
        // $SubcategoryModel = new SubcategoryModel();
        // $where = array('subcategory_id' => $subcategory_id);
        // $SubcategoryModel->delete_category('subcategory', $where);

        SubcategoryModel::where(['subcategory_id' => $subcategory_id])->delete(); //eloquent ORM

        return redirect()->to('subcategory_list');
    }
}
