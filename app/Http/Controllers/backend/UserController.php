<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\RolesModel;
use App\Models\User;
use App\Models\UserDisabledPermissionModel;
use App\Models\UserDisavledPermissionModel;
use App\Traits\RolePermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use RolePermissionTrait;

    // public function validate_user_role(Request $request)
    // {
    //     $permissions = $this->permissionPages($request->path());
    //     foreach ($permissions as $permission) {
    //         // echo $request->is($permission . '*');
    //         if ($permission != "All") {
    //             if ($request->is($permission . '*')) {
    //                 echo "jhj";
    //             } else {
    //                 abort(404, "You don'nt have permission to this page");
    //             }
    //         }
    //     }
    // }

    // public function __construct(Request $request)
    // {

    //     $permissions = $this->permissionPages($request->path());
    //     foreach ($permissions as $permission) {
    //         // echo $request->is($permission . '*');
    //         if ($permission != "All") {
    //             if ($request->is($permission . '*')) {
    //                 echo "jhj";
    //             } else {
    //                 abort(404, "You don'nt have permission to this page");
    //             }
    //         }
    //     }

    // }

    public function get_user(Request $request)
    {
        // if (!$_POST) {

        $data['users'] = User::all();
        // $data['users'] = User::join('roles','roles.id','=','users.role')->get();
        $data['roles'] = RolesModel::all();

        // Just the path part of the URL
        // $request->path();

        return view('backend.users.user_list', $data);
        // }
    }

    public function change_role(Request $request)
    {
        // echo $request->user_role;
        User::where('id', $request->user_id)->update([
            'role' => $request->user_role
        ]);
        return redirect('users');
    }

    public function user_permissions($user_id)
    {
        $user = User::find($user_id);
        $user_role = $user->role;

        $role_permissions = RolePermissionModel::where('role_id', $user_role)->get();
        foreach ($role_permissions as $permission) {
            $user_permission_ids[] = $permission->permission_id;
        }

        $removed_permissions = UserDisabledPermissionModel::where('user_id', $user_id)->get();
        $removed_permission_ids=array();
        foreach ($removed_permissions as $permissions) {
            $removed_permission_ids[] = $permissions->permission_id;
        }
   
        $data['user_permission'] = PermissionModel::whereIN('id', $user_permission_ids)->get();
        $data['user_id'] = $user_id;
        $data['removed_permissoins'] = $removed_permission_ids;

        return view('backend.users.user_permissions', $data);
    }

    public function remove_permission(Request $request)
    {
        $user_id = $request->user_id;
        $permission_id = $request->permission_id;
        $permission_status = $request->permission_status;

        UserDisabledPermissionModel::create([
            'user_id' => $user_id,
            'permission_id' => $permission_id
        ]);
        return "success";
    }
}
