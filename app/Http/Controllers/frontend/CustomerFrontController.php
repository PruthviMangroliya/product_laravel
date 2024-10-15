<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\customer_register_Request;
use App\Mail\OrderShipped;
use App\Models\CustomerModel;
use App\Models\OrdersModel;
use App\Models\OrderTotalModel;
use App\Traits\ExampleTrait;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Stripe\Refund;

class CustomerFrontController extends Controller
{
    use ExampleTrait;
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

    public function customer_login(Request $request)
    {
        if (!session()->get('customer')) {
            if (!$_POST) {

                return view('frontend/customer_login');
            } else {

                $login_email = $request->login_email;
                $login_password = md5($request->login_password);
                $customer = DB::table('customers')->where(['customer_email' => $login_email, 'customer_password' => $login_password])->get();
                // print_r($customer);
                // echo count($customer);

                if (count($customer) == 1) {
                    foreach ($customer as $c) {
                        // echo  $c->customer_firstname;
                    }

                    $customer_session = [
                        'customer_id' => $c->customer_id,
                        'customer_firstname' => $c->customer_firstname,
                        'customer_email' => $c->customer_email
                    ];

                    session()->put('customer', $customer_session);
                    return redirect()->to('/');
                } else {
                    return redirect()->back()->with('login_err', "email id or password is wrong");
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function customer_register_form()
    {
        if (!session()->get('customer')) {

            return view('frontend/customer_register');
        } else {
            return redirect()->to('/');
        }
    }

    public function customer_register(customer_register_Request $request)
    {

        $request->validate([]);

        //============ insert into customers ================
        $customer = DB::table('customers')->insert([

            "customer_firstname" => $request->customer_firstname,
            "customer_lastname" => $request->customer_lastname,
            "customer_email" => $request->customer_email,
            "customer_telephone" => $request->customer_telephone,
            "customer_password" => md5($request->customer_password),
            "customer_con_password" => md5($request->customer_con_password),
        ]);

        $customer_id = DB::getPdo()->lastInsertId();
        // $customer_id = 1;
        $customer = [
            'customer_id' => $customer_id,
            'customer_firstname' => $request->customer_firstname,
            'customer_email' => $request->customer_email
        ];

        session()->put('customer', $customer);

        // ============ insert into customer address ================
        $customer_address = DB::table('customer_address')->insert([

            "address" => $request->customer_address,
            "pincode" => $request->customer_pincode,
            "city" => $request->customer_city,
            "state" => $request->customer_state,
            "country" => $request->customer_country,
            "customer_id" => $customer_id
        ]);

        return redirect()->to('/');

        // //============ insert into orders ================
        // $cart_data = session()->get('cart');
        // foreach ($cart_data as $product_id => $quantity) {
        //     $product = DB::table('products')->where('product_id', $product_id)->get();

        //     // print_r($product);
        //     foreach ($product as $p) {
        //     }

        //     echo $p->product_price;

        //     // return $product;
        //     // echo $product->product_price;
        //     order::create([
        //         "product_id" => $product_id,
        //         "product_quantity" => $quantity,
        //         "product_total" => ($p->product_price * $quantity),
        //         "customer_id" => $customer_id
        //     ]);
        // }
    }

    public function logout()
    {
        session()->forget('customer');
        return redirect()->to('/');
    }

    public function customers_order($order_id = '')
    {
        if (session()->get('customer')) {
            $customer_id = session()->get('customer')['customer_id'];

            $data['order_total'] = OrderTotalModel::all();
            
            if (!empty($order_id)) {
                $data['order_details'] = DB::table('orders')
                    ->join('order_products', 'orders.order_id', '=', 'order_products.order_id')
                    ->where('orders.order_id', $order_id)->get();

                // $customer=CustomerModel::find($customer_id);
                // Mail::to($customer['customer_firstname'])->send(new OrderShipped([
                //     'name' => $customer['customer_firstname'],
                // ]));
                // return view('frontend/order_confirmed_Mail', $data);


            } else {
                $data['orders'] = DB::table('orders')
                    ->where('customer_id', $customer_id)->get();
            }

            //trying trait
            echo $this->exampleMethod();
            return view('frontend/customers_order', $data);

        } else {

            return redirect()->to('/');
        }
    }

    public function cancle_order($order_id)
    {

        $order_data = OrdersModel::find($order_id);
        $order_total = $order_data->order_total;
        $transaction_id = $order_data->transaction_id;

        $cacellation = OrdersModel::find($order_id)->update(['order_status' => 'cacelled']);

        if ($cacellation) {

            if (substr($transaction_id, 0, 4) == "ch_3") {
                // echo "stripe";

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                // $result = $stripe->charges->retrieve($transaction_id, []);

                $result = Refund::create(['charge' => $transaction_id, 'amount' => $order_total * 100]);

                // dd($result);


                if ($result->refunded) {
                    // echo "your order has been canclled";
                    // echo "Refund is done";
                    // echo "<br>";
                    // echo "click here to see refund receipt";
                    // echo "<br>";
                    // echo $result->receipt_url;

                    return redirect()->to(route('my_orders'))->with('cancelled', $result->receipt_url);
                }
            } else {
                // echo "braintree";

                $gateway = new \Braintree\Gateway([
                    'environment' => env('BRAINTREE_ENVIRONMENT'),
                    'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                    'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                    'privateKey' => env("BRAINTREE_PRIVATE_KEY")
                ]);

                $result = $gateway->transaction()->refund($transaction_id);

                if ($result->success) {
                    return redirect()->to(route('my_orders'))->with('cancelled', $result->receipt_url);
                }
                // dd($result);

                echo $result->transaction->id;
            }
        }

        die;
    }
}
