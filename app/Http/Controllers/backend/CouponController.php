<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CouponApplyOnModel;
use App\Models\CouponModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use DateTime;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon_list()
    {
        $data['coupons'] = CouponModel::all();
        $data['coupon_apply_on'] = CouponApplyOnModel::all();

        foreach ($data['coupons'] as $coupon) {
            $expiry_date = $coupon->expires_at;

            $expiry_date = new DateTime($expiry_date);
            $current_date = new DateTime(date('Y-m-d'));


            $diff = date_diff($expiry_date, $current_date);
            $days = $diff->format('%d');
            if ($current_date > $expiry_date) {
                $data['days_left'][] = "Coupon is Expired";
                CouponModel::find($coupon->coupon_id)->update([
                    'coupon_status' => 0
                ]);
            } else {
                $data['days_left'][] = $days . ' left to expire';
            }
            // echo $diff->format('%d days');

        }

        // return $data;

        return view('backend/coupon/coupon_list', $data);
    }

    public function create_coupons(Request $request)
    {
        if (!$_POST) {

            $data['products'] = ProductModel::all();
            return view('backend/coupon/create_coupon', $data);
        } else {

            $request->validate(
                [
                    'coupon_name' => 'required|max:100',
                    'coupon_code' => 'required|unique:coupons,coupon_code|max:50',
                    'discount_type' => 'required',
                    'discount_amount' => 'required|numeric',
                    'expires_at' => 'required|after:13/06/2024'
                ]
            );

            // return $request;
            CouponModel::create([
                'coupon_name' => $request->coupon_name,
                'coupon_code' => $request->coupon_code,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_amount,
                'expires_at' => $request->expires_at
            ]);


            // $data['coupon_apply_on'][] = CouponApplyOnModel::all();
            // $apply_on_array = $request->apply_on;

            // if (!empty($apply_on_array)) {
            //     foreach ($apply_on_array as $apply_on) {


            //         if (!in_array($apply_on, $data['coupon_apply_on'])) {
            //             $coupon->CouponApplyOn()->create([
            //                 'apply_on' => $apply_on
            //             ]);


            //         }
            //     }
            // }


            return redirect()->to('coupons');
        }
    }
}
