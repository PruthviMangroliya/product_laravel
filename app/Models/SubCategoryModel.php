<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;

    // protected $quarded=[];
    protected $fillable = ['subcategory_name', 'category_id','subcategory_image'];
    protected $table = 'subcategory';
    protected $primaryKey='subcategory_id';
    protected $foreignKey='category_id';
}
