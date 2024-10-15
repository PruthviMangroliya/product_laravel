<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionModel extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'product_option';
    protected $primaryKey='product_option_id';

}
