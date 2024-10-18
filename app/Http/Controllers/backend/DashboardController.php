<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Traits\RolePermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    use RolePermissionTrait;

    public function dashboard()
    {
        //check if user is new registered 
        //if it is then send mail to super admin to grant role 
        $this->new_user();

        // DB::connection()->getPDO();
        // echo DB::connection()->getDatabaseName();
        $data['category'] = count(DB::table('category')->get());
        $data['subcategory'] = count(DB::table('subcategory')->get());
        $data['product'] = count(DB::table('products')->get());
        $data['orders'] = count(DB::table('orders')->get());
        $data['sales_amount'] = DB::table('orders')->sum('order_total');
        $data['customers'] = count(DB::table('customers')->get());

        $data['permissions'] = $this->permissionPages();

        return view('backend/dashboard/index', $data);

    }
}
