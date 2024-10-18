<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    public $timestamps = false;

    //one to many relationship
    public function CouponApplyOn()
    {
        return $this->hasMany(CouponApplyOnModel::class, 'coupon_id', 'coupon_id');
    }
}
