<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function attribute_list()
    {
        // $data['category'] = $this->categoryModel->get_category('category', '');

        // $data = category::with('subc')->get();//one to one

        // $data = category::with('subcs')->get();//one to many
        // echo $data->attribute_id;
        // return $data;

        $data['attributes'] = AttributeModel::all(); //eloquent 

        return view('backend/attribute/attribute_list', $data);
    }

    public function add_attribute(Request $request)
    {
        if (!$_POST) {

            return view('backend/attribute/add_attribute');
        } else {
            $request->validate(
                [
                    'attribute_name' => 'unique:attributes,attribute_name|alpha|max:25'
                ]
            );
            //query builder-------------------
            // $category_name = $request->category_name;
            // $data = array(
            //     'category_name' => $category_name
            // );
            // $data['category'] = $this->categoryModel->insert_category('category', $data);

            //eloquent ORM-------------------
            AttributeModel::create([
                'attribute_name' => $request->attribute_name,
            ]);

            return redirect()->to('attribute_list');
        }
    }

    public function edit_attribute(Request $request, $attribute_id)
    {
        if (!$_POST) {

            // $where = array('attribute_id' => $attribute_id);
            // $data['category'] = $this->categoryModel->get_category('category', $where);

            $data['attribute'] = AttributeModel::find($attribute_id);

            // foreach ($data as $c) {
            //     echo $attribute_id = $c->attribute_id;
            //     echo $attribute_name = $c->attribute_name;
            // }
            // return $data['attribute'];

            return view('backend/attribute/edit_attribute', $data);
        } else {

            // $request->validate(
            //     [
            //         'attribute_name' => 'unique:attribute,attribute_name,' . $attribute_id
            //     ]
            // );

            // $data['attribute_name'] = $_POST['attribute_name'];
            // $where = array('attribute_id' => $attribute_id);
            // //   print_r($data);
            // $this->attributeModel->update_attribute('attribute', $where, $data);

            $image = $request->attribute_image;
            if ($image != '') {
                //============= image =================
                $path = 'uploads/attribute';
                $image_name = $path . "/" . $request->attribute_name . rand() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $image_name);

                AttributeModel::find($attribute_id)->update([
                    'attribute_image' => $image_name,
                ]);
            }
            AttributeModel::find($attribute_id)->update([
                'attribute_name' => $request->attribute_name
            ]);

            return redirect()->to('attribute_list');
        }
    }

    public function delete_attribute($attribute_id)
    {
        AttributeModel::find($attribute_id)->delete(); //softdelete
       
        return redirect()->to('attribute_list');
    }
}
