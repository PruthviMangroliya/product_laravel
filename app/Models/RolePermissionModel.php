<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionModel extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='role_permission';
    public $timestamps=false;
}
