<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesDataController extends Controller
{
    public function barChart(Request $request)
    {
        // $data['sales'] = OrdersModel::select('created_at as duration', 'order_total')->groupBy('created_at', 'order_total')->get();
        $data['sales'] = OrdersModel::select([
            DB::raw('created_at as duration'),
            DB::raw('count(order_id) as quantity'),
            DB::raw('sum(order_total) as order_total')
        ])->groupBy('duration')->get();

        if ($request->duration == 'daily') {

            // $data['sales'] = OrdersModel::select('created_at as duration', 'order_total')->groupBy('created_at', 'order_total')->get();
            $data['sales'] = OrdersModel::select([
                DB::raw('created_at as duration'),
                DB::raw('count(order_id) as quantity'),
                DB::raw('sum(order_total) as order_total')
            ])->groupBy('duration')->get();
            //chart date Day wise

        } else
        if ($request->duration == 'weekly') {

            $data['sales'] = OrdersModel::select([
                DB::raw('week(created_at) as duration'),
                DB::raw('count(order_id) as quantity'),
                DB::raw('sum(order_total) as order_total')
            ])->groupBy('duration')->get();
            //weekly chart data

        } elseif ($request->duration == 'monthly') {

            $data['sales'] = OrdersModel::select([
                DB::raw('Month(created_at) as duration'),
                DB::raw('count(order_id) as quantity'),
                DB::raw('sum(order_total) as order_total')
            ])->groupBy('duration')->get();
            //month chart data

        }

        foreach ($data['sales'] as $sales) {

            $created_at[] = $sales->duration;

            $order_total[] = $sales->order_total;

            $data['data'] = [
                'labels' => $created_at,
                'data' => $order_total
            ];
        }

        // Replace this with your actual data retrieval logic
        // $data['data'] = [
        //         'labels' => ['January', 'February', 'March', 'April', 'May'],
        //         'data' => [65, 59, 80, 81, 56],
        //     ];

        // return $data;


        if (isset($_GET['from']) && isset($_GET['to'])) {
            $data['sales_data'] = OrdersModel::
                // join('customers', 'orders.customer_id', 'customers.customer_id')->
                where('orders.created_at', '>=', $_GET['from'])
                ->where('orders.created_at', '<=', $_GET['to'])
                ->get();

            // ->count('order_id');

            // $data['sales_data'] = OrdersModel::where('created_at', '>', now()->subWeek()->startOfWeek())
            //     ->where('created_at', '<=', now()->subWeek()->endOfWeek())
            //     ->get(); // Lastweek 
            // ->count();

            // $data['sales_data'] = OrdersModel::all()->map(function ($item) {
            //     $item->week = $item->created_at->weekOfYear;
            //     $item->year = $item->created_at->year;
            //     return $item;
            // });
            //     ->groupBy(['year', 'week'])
            //     ->map
            //     ->map(function ($week) {
            //         return $week->count();
            //     });


            // return $data;
        }


        return view('backend/sales/sales_data', $data);
    }
}
