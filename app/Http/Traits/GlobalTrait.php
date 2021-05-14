<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait GlobalTrait
{
    public function getDefaultPassword(): string
    {
        $defaultPassword = 'password';
        return $defaultPassword;
    }

    //Uses Spatie Laravel Permission
    public function manageRoles($request, $user)
    {
        $user->syncRoles([$request->role]);
    }

    //Uses Spatie Laravel Permission
    public function managePermissions($request, $role)
    {
        $permissions = $request->permissions;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
    }

    public function managePassword($request, $user)
    {
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();
    }
}
