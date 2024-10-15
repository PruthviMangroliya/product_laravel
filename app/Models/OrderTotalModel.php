<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTotalModel extends Model
{
    use HasFactory;
    protected $table='order_total';
    protected $primaryKey="order_total_id";
    protected $guarded=[];
}
