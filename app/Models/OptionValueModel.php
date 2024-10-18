<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionValueModel extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = [];
    protected $table = 'option_value';
    protected $primaryKey = 'option_value_id';
    protected $foreignKey = 'option_id';
    public $timestamps = false;
}
