<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;
class RoleController extends Controller
{
    public function getRoles(Helper $helper)
    {
        $roles = new \Spatie\Permission\Models\Role;

        if(request()->search !== null){
            $roles = $roles->where('name', 'LIKE', '%'.request()->search.'%')->orWhere('id', request()->search);
        }

        $helper->response()->setHttpCode(200)->send($roles->with('permissions')->orderBy('id', request()->orderBy)->paginate());
    }
    public function getAllPermissions(Helper $helper){

        $permissions = new \Spatie\Permission\Models\Permission;

        $helper->response()->setHttpCode(200)->send($permissions->all());
    }
    public function createRole(Request $request, Helper $helper)
    {

        $helper->runValidation([
            'roleName' => 'bail|required|string|unique:roles,name',
            'permissions' => 'bail|required'
        ]);

        $role = new \Spatie\Permission\Models\Role;

        $role = $role->create([
            'name' => $request->roleName,
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($request->permissions);

        $helper->response()->setMessage('Role created successfully.')->setHttpCode(200)->send('');
    }
    public function editRole(Request $request, Helper $helper)
    {
        $role = new \Spatie\Permission\Models\Role;

        $role = $role->with(['permissions' => function ($query) {
            $query->pluck('id');
        }])->find($request->roleId);

        $permissions = new \Spatie\Permission\Models\Permission;

        $permissions = $permissions->all();

        foreach ($role->permissions as $role_permission) {
            $role_permissions[] = $role_permission->id;
        }

        foreach ($permissions as $permission) {
            if (in_array($permission->id, $role_permissions)) {
                $permission->checked = true;
                continue;
            }
            $permission->checked = false;
        }

        $result = [
            'roleWithPermission' => $role,
            'permissions' => $permissions
        ];

        $helper->response()->setHttpCode(200)->send($result);
    }
    public function updateRole(Request $request, Helper $helper)
    {
        //getting all the ids where checked = true
        $count = 0;

        foreach ($request->permissions as $permission) {
            if (isset($permission['checked']) && $permission['checked'] == true) {
                $permissions[] = $permission['id'];
                $count++;
            }
        }
        if ($count == 0) {
            $helper->response()->setMessage('Please select any permission.')->setHttpCode(200)->send('');
        }

        $helper->runValidation([
            'roleName' => 'bail|required|string|unique:roles,name,' . $request->roleId
        ]);


        $role = new \Spatie\Permission\Models\Role;

        $role = $role->find($request->roleId);

        $role->name = $request->roleName;

        $role->syncPermissions($permissions);

        $role->save();

        $helper->response()->setMessage('Role updated successfully.')->setHttpCode(200)->send('');
    }
    public function deleteRole(Request $request)
    {
        $role = new \Spatie\Permission\Models\Role;

        $role =  $role->withCount('users')->find($request->roleId);

        if($role->users_count > 0){

            GeneralHelper::response('', 'This role is already assigned to a user', 400);

        }else{

            $role->delete();

            GeneralHelper::response('', 'Role remove successfully.');
        }
    }
}
