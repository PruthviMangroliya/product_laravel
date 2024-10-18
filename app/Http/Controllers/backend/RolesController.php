<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\RolesModel;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function get_role()
    {
        $data['roles'] = RolesModel::all();
        $data['roles'] = RolePermissionModel::join('permissions', 'permissions.id', '=', 'role_permission.permission_id')
        ->join('roles', 'roles.id', '=', 'role_permission.role_id')
        ->get();

        return view('backend.roles.roles', $data);
    }
    public function set_role(Request $request)
    {
        if (!$_POST) {
            $data['permissions'] = PermissionModel::all();

            return view('backend.roles.set_role', $data);
        } else {
           $role= RolesModel::create([
                'role' => $request->role
            ]);

            $role_id=$role->id;
$permissions=$request->permissions;
            foreach ($permissions as $permission_id) {
                RolePermissionModel::create([
                    'role_id' => $role_id,
                    'permission_id' => $permission_id
                ]);
            }

            return redirect('/roles');
        }
    }

    public function delete_role($id)
    {
        RolesModel::find($id)->delete();
        return redirect('/roles');

    }
}
