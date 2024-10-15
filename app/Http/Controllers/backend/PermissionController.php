<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionModel;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function get_permission()
    {
        $data['permissions'] = PermissionModel::all();
        return view('backend.permission.permission', $data);
    }
    public function set_permission(Request $request)
    {
        if (!$_POST) {
            return view('backend.permission.set_permission');
        } else {
            PermissionModel::create([
                'permission' => $request->permission
            ]);
            return redirect('/permission');

        }
    }
}
