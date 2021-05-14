<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Exception;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct('permission');
    }
        

    public function index()
    {
        $data['permissions'] = Permission::latest()->paginate(10);
        return view('admin.permission.index', $data);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        try{
            $permission = Permission::create($request->all());

            $notification = array(
                'message' => 'Permission saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.permissions.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('admin.permissions.index')->with($notification);
        }
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        $data['permission'] = $permission;
        return view('admin.permission.edit', $data);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission = $permission->update($request->all());

            $notification = array(
                'message' => 'Permission saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.permissions.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.permissions.index')->with($notification);
        }
    }

    public function destroy(Permission $permission)
    {
        try{
            Permission::find($permission->id)->delete();

            $notification = array(
                'message' => 'Permission deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.permissions.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.permissions.index')->with($notification);
        }
    }
}
