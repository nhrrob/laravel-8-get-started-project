<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct('user');
    }

    public function index()
    {
        $data['users'] = User::latest()->paginate(10);
        return view('admin.user.index', $data);
    }

    public function create()
    {
        $data['defaultPassword'] = $this->getDefaultPassword();
        $data['roles'] = Role::get();
        return view('admin.user.create', $data);
    }

    public function store(UserRequest $request)
    {
        try{
            $defaultPassword = $this->getDefaultPassword();
            $request['password'] = Hash::make("$defaultPassword");
            
            $user = User::create($request->except(['role']));
            $this->manageRoles($request, $user);

            $notification = array(
                'message' => 'User saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.users.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('admin.users.index')->with($notification);
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['defaultPassword'] = $this->getDefaultPassword();
        $data['roles'] = Role::get();
        
        return view('admin.user.edit', $data);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->except(['password', 'role']));
            $this->manageRoles($request, $user);
            $this->managePassword($request, $user);

            $notification = array(
                'message' => 'User saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.users.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.users.index')->with($notification);
        }
    }

    public function destroy(User $user)
    {
        try{
            User::find($user->id)->delete();

            $notification = array(
                'message' => 'User deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.users.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.users.index')->with($notification);
        }
    }
}
