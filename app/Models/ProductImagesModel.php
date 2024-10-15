<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImagesModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded=[];
    public $timestamps=false;
    protected $table='product_images';
    protected $primaryKey='product_image_id';

}
