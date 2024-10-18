<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $primaryKey="order_id";
    protected $guarded=[];
    public $timestamps=false;

}
