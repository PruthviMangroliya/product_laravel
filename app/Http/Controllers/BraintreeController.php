<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BraintreeController extends Controller
{
    // public function token(Request $request)
    // {

    //     $gateway = new \Braintree\Gateway([
    //         'environment' => env('BRAINTREE_ENVIRONMENT'),
    //         'merchantId' => env("BRAINTREE_MERCHANT_ID"),
    //         'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
    //         'privateKey' => env("BRAINTREE_PRIVATE_KEY")
    //     ]);
    //     $clientToken = $gateway->clientToken()->generate();

    //     if($request->input('nonce') != null){
    //         var_dump($request->input('nonce'));
    //         $nonceFromTheClient = $request->input('nonce');

    //         $gateway->transaction()->sale([
    //             'amount' => '10.00',
    //             'paymentMethodNonce' => $nonceFromTheClient,
    //             'options' => [
    //                 'submitForSettlement' => True
    //             ]
    //         ]);
    //         return view ('dashboard');
    //     }
    //     return view('braintree', ['token' => $clientToken]);

    // }


    public function token(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $customer_id = session()->get('customer')['customer_id'];

        $cart_data = session()->get('cart');

        $order_products = 0;
        $order_total = 0;

        foreach ($cart_data as $product_id => $quantity) {

            $product = DB::table('products')->where('product_id', $product_id)->get();
            foreach ($product as $p) {
            }

            $order_products += $quantity;
            $order_total += ($p->product_price * $quantity);
        }


        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $status = $gateway->transaction()->sale([
                'amount' => $order_total,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            // $status = array(
            //     'amount' => $order_total,
            //     'paymentMethodNonce' => $nonceFromTheClient,
            //     'options' => [
            //         'submitForSettlement' => True
            //     ]
            // );

            if ($status->success) {
                // print_r($status->transaction);

                echo $transaction_id = $status->transaction->id;
                //============ insert into orders ================

                // payment and order succsefully thay jay che but payment mathi j data return thay che temathi transaction id fetch karvi che te nahi thati


                $order = DB::table('orders')->insert([
                    // order::create([
                    "order_products" => $order_products,
                    "order_total" => $order_total,
                    "customer_id" => $customer_id,
                    "transaction_id" => $transaction_id

                ]);
                // $data[] = array(
                //     "order_products" => $order_products,
                //     "order_total" => $order_total,
                //     "customer_id" => $customer_id,
                //     "transaction_id" => $transaction_id
                // );

                $order_id = DB::getPdo()->lastInsertId();

                foreach ($cart_data as $product_id => $quantity) {
                    $product = DB::table('products')->where('product_id', $product_id)->get();

                    // print_r($product);
                    foreach ($product as $p) {
                    }
                    // return $product;
                    // echo $product->product_price;

                    DB::table('order_details')->insert([
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'product_title' => $p->product_title,
                        'product_price' => $p->product_price,
                        'product_quantity' => $quantity,
                        'product_total' => ($p->product_price * $quantity)
                    ]);

                    // $data[] = array(
                    //     'order_id' => $order_id,
                    //     'product_id' => $product_id,
                    //     'product_title' => $p->product_title,
                    //     'product_price' => $p->product_price,
                    //     'product_quantity' => $quantity,
                    //     'product_total' => ($p->product_price * $quantity)
                    // );
                }

                session()->forget('cart');
                return view('dashboard');
                
            } else {
                // Handle errors
            }

            // return redirect()->to('frontend/customers_order');


            //==========================================================================================
            //https://admissions.nic.in/GUJ/Applicant/CommonProfile/Registration.aspx//acpc
            //https://gcasstudent.gujgov.edu.in/applicants/QuickRegistration.aspx//Gcas


            // return $data;

            //==========================================================================================





        } else {

            $clientToken = $gateway->clientToken()->generate();
            return view('braintree', ['token' => $clientToken]);
        }
    }
}
