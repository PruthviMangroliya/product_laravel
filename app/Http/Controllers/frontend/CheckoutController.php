<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\CouponModel;
use App\Models\CouponOrderModel;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrdersModel;
use App\Models\OrderTotalModel;
use DateTime;


class CheckoutController extends Controller
{
    // public function header()
    // {
    //     $data['categories'] = DB::table('category')->get();
    //     $data['subcategories'] = DB::table('subcategory')->get();

    //     $data['cart_data'] = session()->get('cart');

    //     if (!empty($data['cart_data'])) {
    //         foreach ($data['cart_data'] as $product_id => $quantity) {
    //             $cart_product_ids[] = $product_id;
    //         }

    //         // $product_ids=implode(',',$cart_product_ids);
    //         // $data['cart_products'] = DB::table('products')->where('product_id','IN',$product_ids)->get();

    //         $data['cart_products'] = DB::table('products')->whereIn('product_id', $cart_product_ids)->get();
    //         $data['product_images'] = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
    //     }


    //     echo view('frontend/header', $data);
    // }

    public function token(Request $request)
    {
        $order_total = $request->order_total;
        // return $request->all();

        $request->coupon_id;
        $order_total;
        $coupon_id = $request->coupon_id;
        $discount_amount = $request->discount_amount;
        $discounted_total = $request->discounted_total;

        $data['order_total'] = array(
            'order_total' => $order_total,
            'discount_amount' => $discount_amount,
            'discounted_total' => $discounted_total,
        );

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $customer_id = session()->get('customer')['customer_id'];

        $cart_data = session()->get('cart');

        $order_products = 0;
        

        foreach ($cart_data as $product_id => $quantity) {

            $product = DB::table('products')->where('product_id', $product_id)->get();
            foreach ($product as $p) {
            }

            $order_products += $quantity;
            // $order_total += ($p->product_price * $quantity);
        }

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            // return $request->all(); 

            OrdersModel::create([
                "order_products" => $order_products,
                "order_total" => $order_total,
                "customer_id" => $customer_id,
                "transaction_id" => 'Payment Pending',
                "created_at" => date('Y-m-d')
            ]);
            $order_id = DB::getPdo()->lastInsertId();

            //============ insert into Coupon order ================
            if (isset($request->coupon_id)) {
                CouponOrderModel::create([
                    'order_id' => $order_id,
                    'coupon_id' => $request->coupon_id
                ]);
                // $data['coupon+order'] = [
                //     'order_id' => $order_id,
                //     'coupon_id' => $request->coupon_id
                // ];
            }

            
            //============ insert into order Total ================
            OrderTotalModel::create([
                "order_amount" => $order_total,
                'order_id' => $order_id,
                "discount_amount" => $discount_amount,
                "discounted_amount" => $discounted_total
            ]);

            //============ insert into order Products ================
            foreach ($cart_data as $product_id => $quantity) {
                $product = DB::table('products')->where('product_id', $product_id)->get();

                // print_r($product);
                foreach ($product as $p) {
                }

                DB::table('order_products')->insert([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'product_title' => $p->product_title,
                    'product_price' => $p->product_price,
                    'product_quantity' => $quantity,
                    'product_total' => ($p->product_price * $quantity)
                ]);
            }

            $status = $gateway->transaction()->sale([
                'amount' => $order_total,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            if ($status->success) {

                $transaction_id = $status->transaction->id;

                OrdersModel::find($order_id)->update(['transaction_id' => $transaction_id, 'order_status' => 1]);

                session()->forget('cart');
                $this->sendEmail(); //send the mail
                return redirect(route('my_orders'));
            } else {
                // return "error"; 
                // Handle errors
                echo "error";
            }
        } else {

            $clientToken = $gateway->clientToken()->generate();
            return view('braintree', [
                'token' => $clientToken,
                'coupon_id' => $coupon_id,
                'order_total' => $order_total,
                'discount_amount' => $discount_amount,
                'discounted_total' => $discounted_total
            ]);
        }
    }


    public function checkout(Request $request)
    {
        if (session()->get('customer')) {

            // if (!$_POST) {

            // $data['coupons'] = CouponModel::all();
            // foreach ($data['coupons'] as $coupon) {
            //     $expiry_date = $coupon->expires_at;

            //     $expiry_date = new DateTime($expiry_date);
            //     $current_date = new DateTime(date('Y-m-d'));

            //     if ($expiry_date == $current_date) {
            //         $data['days_left'][] = "The Coupon is expired";
            //         // echo "The Coupon is expired";
            //     } else {
            //         $diff = date_diff($expiry_date, $current_date);
            //         $data['days_left'][] = $diff->format('%d days') . ' left to expire';
            //         // echo $diff->format('%d days');
            //     }
            // }

            $data['cart_data'] = session()->get('cart');

            if (!empty($data['cart_data'])) {
                foreach ($data['cart_data'] as $product_id => $quantity) {
                    $cart_product_ids[] = $product_id;
                }

                $data['cart_products'] = DB::table('products')->whereIn('products.product_id', $cart_product_ids)->get();

                $data['cart_product_option_data'] = $request->session()->get('cart_product_option');
                $data['options'] = DB::table('options')->get();
            }

            // return $data;

            return view('frontend/checkout', $data);


            // } else {

            //     //============ insert into orders ================
            //     $customer_id = session()->get('customer')['customer_id'];

            //     $order = DB::table('orders')->insert([
            //         // order::create([
            //         "order_products" => $request->order_products,
            //         "order_total" => $request->order_total,
            //         "customer_id" => $customer_id
            //     ]);
            //     $order_id = DB::getPdo()->lastInsertId();

            //     $cart_data = session()->get('cart');

            //     foreach ($cart_data as $product_id => $quantity) {
            //         $product = DB::table('products')->where('product_id', $product_id)->get();

            //         // print_r($product);
            //         foreach ($product as $p) {
            //         }
            //         // return $product;
            //         // echo $product->product_price;

            //         DB::table('order_details')->insert([
            //             'order_id' => $order_id,
            //             'product_id' => $product_id,
            //             'product_title' => $p->product_title,
            //             'product_price' => $p->product_price,
            //             'product_quantity' => $quantity,
            //             'product_total' => ($p->product_price * $quantity)
            //         ]);
            //     }

            //     session()->forget('cart');
            //     return redirect()->to('frontend/customers_order')->with('message',"Your Order has been booked successfully");
            // }

        } else {
            return redirect()->to('customer_login');
        }
    }

    //mail using job and queue
    public function sendEmail()
    {
        $customer_id = session()->get('customer')['customer_id'];
        $customer = CustomerModel::find($customer_id);

        $details = array(
            'email' => $customer['customer_email'],
            'name' => $customer['customer_firstname'],
        );

        /* This method will call SendEmailJob Job */
        if (dispatch(new SendEmailJob($details))) {

            dd('done');
        }
    }

    public function get_coupon()
    {
        $data['coupons'] = CouponModel::where('coupon_status', 1)->get();
        foreach ($data['coupons'] as $coupon) {
            $expiry_date = $coupon->expires_at;

            $expiry_date = new DateTime($expiry_date);
            $current_date = new DateTime(date('Y-m-d'));

            if ($expiry_date == $current_date) {
                $data['days_left'][] = "The Coupon is expired";
                // echo "The Coupon is expired";
            } else {
                $diff = date_diff($expiry_date, $current_date);
                $data['days_left'][] = $diff->format('%d days') . ' left to expire';
                // echo $diff->format('%d days');
            }
        }
        return view('frontend/available_coupon', $data);
    }

    public function validate_coupon(Request $request)
    {
        // $data = CouponModel::where("coupon_code", "$coupon_code")->get();
        $data = CouponModel::where(['coupon_code' => $request->coupon_code, 'coupon_status' => 1])->get();
        // CouponModel::find("coupon_code", "$coupon_code");
        // print_r($data);

        if (empty($data[0])) {
            return "false";
        } else {
            return "true";
        }
    }
}
