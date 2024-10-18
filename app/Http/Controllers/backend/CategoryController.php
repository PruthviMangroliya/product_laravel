<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoryModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new categoryModel();
    }

    public function category_list(): View
    {

        // $data['category'] = $this->categoryModel->get_category('category', '');

        // $data = category::with('subc')->get();//one to one

        // $data = category::with('subcs')->get();//one to many
        // echo $data->category_id;
        // return $data;

        // $data['category'] = categoryModel::all()->simplePaginate(3); //eloquent 
        // $data['category'] = categoryModel::all();
        $data['category'] = categoryModel::paginate(3);
        
        return view('backend/category/category_list', $data);
    }

    public function add_category(Request $request)
    {
        if (!$_POST) {

            return view('backend/category/add_category');

        } else {
            $request->validate(
                [
                    'category_name' => 'unique:category,category_name|alpha|max:25',
                    'category_image' => 'required',
                ]
            );
            //query builder-------------------
            // $category_name = $request->category_name;
            // $data = array(
            //     'category_name' => $category_name
            // );
            // $data['category'] = $this->categoryModel->insert_category('category', $data);
            
            $image = $request->category_image;
            //============= image =================
            $path = 'uploads/category';
            $image_name = $path . "/" . $request->category_name . rand() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $image_name);

            //eloquent ORM-------------------
            categoryModel::create([
                'category_name' => $request->category_name,
                'category_image' => $image_name,
            ]);

            return redirect()->to('category_list')->with('message','Catagory Added Successfully...');
        }
    }

    public function edit_category(Request $request, $category_id)
    {
        if (!$_POST) {

            // $where = array('category_id' => $category_id);
            // $data['category'] = $this->categoryModel->get_category('category', $where);

            $data['category'] = categoryModel::find($category_id);

            return view('backend/category/edit_category', $data);

        } else {

            $request->validate(
                [
                    'category_name' => 'unique:category,category_name,'.$category_id.',category_id' ,
                ]
            );
           
            // $where = array('category_id' => $category_id);         
            // $this->categoryModel->update_category('category', $where, $data);

            // $image = $request->category_image;
            // if ($image != '') {
            //     //============= image =================
            //     $path = 'uploads/category';
            //     $image_name = $path . "/" . $request->category_name . rand() . '.' . $image->getClientOriginalExtension();
            //     $image->move($path, $image_name);

            //     categoryModel::find($category_id)->update([
            //         'category_image' => $image_name,
            //     ]);
            // }
            categoryModel::find($category_id)->update([
                'category_name' => $request->category_name
            ]);

            //clear the cache for category
            Cache::clear('category');
            
            return redirect()->to('category_list')->with('message','Category Updated successfully..');
        }
    }

    public function delete($category_id)
    {

        $where = array('category_id', '=', $category_id);
        print_r($where);
        // $this->categoryModel->where()->delete_category('category');
        $categoryModel = DB::table('category')->where('category_id', '=', $category_id)->delete();

        // $where = array('category_id' => $category_id);
        // $this->categoryModel->delete_category('category', $where);

        // Category::where(['category_id' => $category_id])->delete();

        return redirect()->to('category_list')->with('message','categeory deleted Successfully..');
    }
}
