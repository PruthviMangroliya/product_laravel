<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'options';
    protected $primaryKey = 'option_id';
    public $timestamp = false;

    //one to many relationship
    public function optionValues()
    {
        return $this->hasMany(OptionValueModel::class, 'option_id', 'option_id');
    }
}
