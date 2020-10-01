<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
class AclUserController extends Controller
{
    public function getUsersWithSearch(Helper $helper)
    {
        $user = new \App\User;
        $request = request();

        $user = $user->with('roles')
            ->where('name', '!=', 'admin')
            ->where(function ($query) use ($request) {
                $query->where("name", "LIKE", "%" . $request->SearchQuery . "%");
                $query->orWhere("email", "LIKE", "%" . $request->SearchQuery . "%");
            });

        $helper->response()->setHttpCode(200)->send($user->orderBy('id', request()->orderBy)->paginate());
    }

    public function getAllRoles(Helper $helper)
    {
        $roles = new \Spatie\Permission\Models\Role;

        $helper->response()->setHttpCode(200)->send($roles->with('permissions')->get());
    }

    public function createUser(Helper $helper)
    {
        $request = request();

        $helper->runValidation([
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255|unique:users',
            'password' => 'bail|required|string|min:6|confirmed',
            'selectdRoles' => 'bail|required'
        ]);

        $user = new \App\User;

        $user = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->syncRoles($request->selectdRoles);

        $helper->response()->setMessage('User created successfully!')->setHttpCode(200)->send('');
    }

    public function editUser(Helper $helper)
    {
        $request = request();
        $user = new \App\User;

        $user = $user->with(['roles' => function ($query) {
            $query->select('id', 'name');
        }])->find($request->userId);

        $roles = new \Spatie\Permission\Models\Role;

        $roles = $roles->all();

        $user_roles = [];
        foreach ($user->roles as $user_role) {
            array_push($user_roles, $user_role->id);
        }

        foreach ($roles as $role) {
            if (in_array($role->id, $user_roles)) {
                $role->checked = true;
                continue;
            }
            $role->checked = false;
        }

        $result = [
            'userWithRole' => $user,
            'roles' => $roles
        ];
        $helper->response()->setHttpCode(200)->send($result);
    }

    public function updateUser(Helper $helper)
    {
        $request = request();

        $helper->runValidation([
            'name' => 'bail|required|string|max:255',
            'password' => 'bail|nullable|string|min:6|confirmed',
            'selectdRoles' => 'bail|required',
            'email' => 'bail|required|email|max:255|unique:users,email,' . $request->userId
        ]);

        $user = new \App\User;

        $user = $user->find($request->userId);

        $user->name = $request->name;

        $user->email = $request->email;

        if ($request->has("password") && $request->password) {
            $user->password = Hash::make($request->password);
        }

        if (!isset($request->selectdRoles[0]['id'])) {
            $user->syncRoles($request->selectdRoles);
        }

        $user->save();

        $helper->response()->setMessage('User updated successfully.')->setHttpCode(200)->send('');
    }

    public function deleteUser(Helper $helper)
    {
        $user    = new \App\User;

        $user->find(request()->userId)->delete();

        $helper->response()->setMessage('User removed successfully.')->setHttpCode(200)->send('');
    }
}
