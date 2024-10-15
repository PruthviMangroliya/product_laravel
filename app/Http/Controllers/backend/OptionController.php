<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OptionModel;
use App\Models\OptionValueModel;
use Illuminate\Http\Request;


class OptionController extends Controller
{
    public function option_list()
    {
        // $data['options'] = DB::table('options')->get();
        // $data['option_value'] = DB::table('option_value')->join('options','options.option_id','option_value.option_id')->get();

        // $data['options'] = OptionModel::all();
        $data['options'] = OptionModel::with('optionValues')->get();

        // return $data;
        return view('backend/option/option_list', $data);
    }

    public function add_option(Request $request)
    {
        if (!$_POST) {

            return view('backend/option/add_option');
        } else {

            $request->validate(
                [
                    'option_name' => 'unique:options,option_name|alpha|max:25',
                ]
            );

            $option_values_array = $request->option_values;

            $option = OptionModel::create([
                'option_name' => $request->option_name,
            ]);

            if (!empty($option_values_array)) {

                foreach ($option_values_array as $key => $option_value) {
                    if ($option_value != '') {

                        $option->optionValues()->create([
                            'option_value' => $option_value,
                        ]);
                    }
                }
            }
           
            return redirect()->to('option_list');
        }
    }

    public function edit_option(Request $request, $option_id)
    {
        if (!$_POST) {

            $data['option'] = OptionModel::find($option_id);
            $data['option_value'] = OptionValueModel::where(['option_id' => $option_id])->get();
            // return $data;
            return view('backend/option/edit_option', $data);
        } else {

            $request->validate(
                [
                    'option_name' => 'alpha|max:25',
                ]
            );

            $option=OptionModel::find($option_id)->update([
                'option_name' => $request->option_name,
            ]);

            $option_values_array = $request->option_values;
            $option_value_ids_array = $request->option_value_ids;

            if (!empty($option_values_array)) {

                foreach ($option_values_array as $key => $option_value) {
                    if ($option_value != '') {

                        if (isset($option_value_ids_array[$key])) {
                            OptionValueModel::where(['option_value_id' => $option_value_ids_array[$key]])->update([
                                'option_value' => $option_value,
                            ]);
                        } else {
                            OptionValueModel::create([
                                'option_value' => $option_value,
                                'option_id' => $option_id
                            ]);
                        }
                    }
                }
            }

            return redirect()->to('option_list');
        }
    }

    public function delete_option($option_id)
    {

        OptionModel::find($option_id)->delete(); //softdelete

        // OptionModel::where(['option_id' => $option_id])->delete(); //eloquent ORM

        return redirect()->to('option_list');
    }
}
