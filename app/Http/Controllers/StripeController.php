<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use App\Models\OrderTotalModel;
// use App\Models\StripeCustomerModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;

class StripeController extends Controller
{
    public function showPaymentForm(Request $request)
    {
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
        $data['order_total'] = $order_total;

        if (!$_POST) {

            return view('stripe', $data);

        } else {

            // return $request->all();
            // die;
            OrdersModel::create([
                "order_products" => $order_products,
                "order_total" => $order_total,
                "customer_id" => $customer_id,
                "transaction_id" =>  'Payment Pending',
                "created_at" => date('Y-m-d')
            ]);

             //============ insert into order Total ================
             OrderTotalModel::create([
                "order_amount" => $order_total,
                // "discount_amount" => $discount_amount,
                // "discounted_amount" => $discounted_total
            ]);

            $order_id = DB::getPdo()->lastInsertId();
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

            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $prepare_charge = array(
                    'amount'     => $order_total * 100,
                    'metadata' => array(
                        'order_id' => $order_id,
                    ),
                    'currency' => "USD",
                );

                $prepare_customer = array(
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'source' => $request->stripeToken
                );

                $customer = new Customer();
                $customerDetails = $customer->create($prepare_customer);
                $stripe_customer_id = $customerDetails->id;

                $prepare_charge['customer'] = $stripe_customer_id;
                $result = Charge::create($prepare_charge);

                OrdersModel::find($order_id)->update(['transaction_id' => $result->id,'order_status' => 1]);

                session()->forget('cart');
                return redirect()->to(Route('my_orders'))->with('message', '');

            } catch (\Exception $e) {

                var_dump($e);
                echo "failure";
                // return redirect()->to(Route('my_orders'))->with('failure', '');

                // return redirect()->route('payment.failure')->with('error', $e->getMessage());

            }
        }
    }

    // public function stripe(Request $request)
    // {
    //     $customer_id = session()->get('customer')['customer_id'];

    //     $cart_data = session()->get('cart');

    //     $order_products = 0;
    //     $order_total = 0;

    //     foreach ($cart_data as $product_id => $quantity) {

    //         $product = DB::table('products')->where('product_id', $product_id)->get();
    //         foreach ($product as $p) {
    //         }

    //         $order_products += $quantity;
    //         $order_total += ($p->product_price * $quantity);
    //     }

    //     // OrdersModel::create([
    //     //     "order_products" => $order_products,
    //     //     "order_total" => $order_total,
    //     //     "customer_id" => $customer_id,
    //     //     "transaction_id" =>  '$details->id',
    //     //     "created_at" => date('Y-m-d')
    //     // ]);

    //     // $order_id = DB::getPdo()->lastInsertId();
    //     // foreach ($cart_data as $product_id => $quantity) {
    //     //     $product = DB::table('products')->where('product_id', $product_id)->get();

    //     //     // print_r($product);
    //     //     foreach ($product as $p) {
    //     //     }

    //     //     DB::table('order_products')->insert([
    //     //         'order_id' => $order_id,
    //     //         'product_id' => $product_id,
    //     //         'product_title' => $p->product_title,
    //     //         'product_price' => $p->product_price,
    //     //         'product_quantity' => $quantity,
    //     //         'product_total' => ($p->product_price * $quantity)
    //     //     ]);
    //     // }

    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         $prepare_charge = array(
    //             'amount'     => $order_total * 100,
    //             'metadata' => array(
    //                 'order_id' => 5,
    //             ),
    //             'currency' => "USD",
    //         );

    //         $prepare_customer = array(
    //             'name' => $request->last_name,
    //             'phone' => $request->phone,
    //             'email' => $request->email,
    //             'source' =>  $request->stripeToken
    //         );

    //         // Stripe::setApiKey($stripeSecret);
    //         Stripe::setApiKey(env('STRIPE_SECRET'));


    //         $customer = new Customer();
    //         $customerDetails = $customer->create($prepare_customer);
    //         $stripe_customer_id = $customerDetails->id;


    //         $prepare_charge['customer'] = $stripe_customer_id;
    //         $result = Charge::create($prepare_charge);

    //         // dd($result);
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //         $details = $stripe->paymentIntents->create([
    //             // $details = $stripe->charges->create([

    //             'amount' => $order_total,
    //             'currency' => 'usd',
    //             'automatic_payment_methods' => ['enabled' => true],
    //         ]);

    //         // OrdersModel::find($order_id)->update('transaction_id', $result->id);


    //         session()->forget('cart');
    //         return redirect()->to(Route('my_orders'))->with('message', '');
    //     } catch (\Exception $e) {
    //         var_dump($e);
    //         echo "failure";
    //         // return redirect()->route('payment.failure')->with('error', $e->getMessage());
    //     }

    //     // try {
    //     //     Charge::create([
    //     //         'amount' => 1000, // Amount in cents
    //     //         'currency' => 'usd',
    //     //         'source' => $request->stripeToken,
    //     //         'description' => 'Test Payment',
    //     //     ]);

    //     //     $data = array(
    //     //         'amount' => 1000, // Amount in cents
    //     //         'currency' => 'usd',
    //     //         'source' => $request->stripeToken,
    //     //         'description' => 'Test Payment',
    //     //     );
    //     //     echo "success";
    //     //     return $data;
    //     //     // return redirect()->route('payment.success')->with('success', 'Payment successful!');
    //     // } catch (\Exception $e) {
    //     //     var_dump($e);
    //     //     echo "failure";
    //     //     // return redirect()->route('payment.failure')->with('error', $e->getMessage());
    //     // }
    // }
}
