<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Exception;
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
        return view('admin.role.create');
    }

    public function store(RoleRequest $request)
    {
        try{
            $role = Role::create($request->all());

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
        return view('admin.role.edit', $data);
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role = $role->update($request->all());

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
