<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];
    protected $table= 'attributes';
    protected $primaryKey='attribute_id';
}
