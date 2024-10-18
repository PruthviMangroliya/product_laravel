<?php

namespace App\Traits;

use App\Mail\NewUserRegisteredMail;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\User;
use App\Models\UserDisabledPermissionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait RolePermissionTrait
{
    public function permissionPages()
    {

        $role = Auth::user()->role;
        $user_id = Auth::user()->id;
        if ($role != 0) {

            // $role_permissions = RolePermissionModel::join('permissions', 'permissions.id', '=', 'role_permission.permission_id')->where('role_id', $role)->get();

            // $role_permissions = RolePermissionModel::join('permissions', 'permissions.id', '=', 'role_permission.permission_id')
            //     ->join('user_disabled_permission', 'user_disabled_permission.permission_id', '!=', 'role_permission.permission_id')
            //     ->where(['role_id' => $role, 'user_disabled_permission.user_id' => $user_id])->get();

            $role_permissions = RolePermissionModel::where("role_id", $role)
                ->join("permissions", "permissions.id", "role_permission.permission_id")
                ->whereNotIn("role_permission.permission_id", function ($q) use ($user_id) {
                    $q->select("permission_id")->from("user_disabled_permission")->where("user_id", $user_id);
                })
                ->get();

            // dd($role_permissions);

            foreach ($role_permissions as $p) {

                $permissions[] = $p->permission;
            }

            return $permissions;
            // $removed_permissions = UserDisabledPermissionModel::join('permissions', 'permissions.id', '=', 'user_disabled_permission.permission_id')
            // ->where('user_id', $user_id)->get();
            // // print_r($removed_permissions);
            // die;

            //     if (!empty($removed_permissions)) {
            //         foreach ($removed_permissions as $key => $removable_permission) {
            //             if (in_array($removable_permission, $permissions)) {
            //                 $removable_key = array_search($removable_permission, $permissions);
            //                 unset($permissions[$removable_key]);
            //             }
            //         }
            //     }
            // return $permissions;
        }
    }

    public function new_user()
    {
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        if ($role == 0) {
            $SuperAdmin = User::where('role', '1')->get();
            // print_r($SuperAdmin);
            foreach ($SuperAdmin as $admin) {

                echo $AdminEmail = $admin->email;
            }

            $data['user'] = User::find($user_id);


            Mail::to($AdminEmail)->send(new NewUserRegisteredMail([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ]));
            return view('backend/new_registered_user_mail', $data);
        }
    }
}
