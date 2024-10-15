<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'category';
    protected $primaryKey  = 'category_id';

    //one to one relationship
    public function subc()
    {
        return $this->hasOne(SubcategoryModel::class, 'category_id', 'category_id');
    }

    //one to many relationship
    public function subcs()
    {
        return $this->hasMany(SubcategoryModel::class, 'category_id', 'category_id');
    }


    // public function insert_category($table, $data)
    // {
    //     // DB::insert('insert into category(category_name) values (?)',[$category_name]);
    //     DB::table($table)->insert($data);
    // }

    // public function get_category($table, $where, $feild = '*')
    // {
    //     // $data['category'] = DB::table('category')->select('*')->get();
    //     // print_r($data['category']);
    //     // echo '<br>';
    //     // $data['category'] = DB::select("select * from category");

    //     DB::connection()->getPDO();
    //     if (empty($where)) {
    //         $data = DB::table($table)->select($feild)->get();
    //     } else {
    //         $data = DB::table($table)->select($feild)->where($where)->get();
    //     }
    //     return $data;
    // }

    // public function update_category($table,$where,$data)
    // {
    //     DB::table($table)->where($where)->update($data);
    // }

    // public function delete_category($table,$where)
    // {
    //     // print_r($where);
    //     DB::table($table)->where($where)->delete();
    // }
}
