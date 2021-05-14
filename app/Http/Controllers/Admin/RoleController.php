<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct('role');
    }
    
    public function index()
    {
        $data['roles'] = Role::latest()->paginate(10);
        return view('admin.role.index', $data);
    }

    public function create()
    {
        $data['user'] = Auth::user();
        $data['allPermissions'] = Permission::all();
        $data['permissionGroups'] = User::getPermissionGroups();

        return view('admin.role.create', $data);
    }

    public function store(RoleRequest $request)
    {
        try{
            $role = Role::create($request->all());
            $this->managePermissions($request, $role);

            $notification = array(
                'message' => 'Role saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.roles.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('admin.roles.index')->with($notification);
        }
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $data['role'] = $role;
        $data['user'] = Auth::user();
        $data['allPermissions'] = Permission::all();
        $data['permissionGroups'] = User::getPermissionGroups();
        
        return view('admin.role.edit', $data);
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role->update($request->all());
            $this->managePermissions($request, $role);

            $notification = array(
                'message' => 'Role saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.roles.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.roles.index')->with($notification);
        }
    }

    public function destroy(Role $role)
    {
        try{
            Role::find($role->id)->delete();

            $notification = array(
                'message' => 'Role deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.roles.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.roles.index')->with($notification);
        }
    }
}
