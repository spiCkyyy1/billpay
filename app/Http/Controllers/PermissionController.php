<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;
class PermissionController extends Controller
{
    public function __construct()
    {
        if (!request()->ajax()) {
            abort(404);
        }
    }

    public function index(Helper $helper)
    {
        $permissions = new \Spatie\Permission\Models\Permission;

        if(request()->searchQuery != null){
            $permissions = $permissions->where('name', 'LIKE', '%'.request()->searchQuery.'%');
        }

        $helper->response()->setHttpCode(200)->send($permissions->orderBy('id', request()->orderBy)->paginate());
    }
    public function create(Request $request, Helper $helper)
    {
        $helper->runValidation([
            'permissionName' => 'bail|required|string|unique:permissions,name'
        ]);

        $permission = new \Spatie\Permission\Models\Permission;

        $permission->create([
            'name' => $request->permissionName,
            'guard_name' => 'web'
        ]);

        $helper->response()->setMessage('Permission created successfully.')->setHttpCode(200)->send('');
    }
    public function edit(Request $request, Helper $helper)
    {
        $permission = new \Spatie\Permission\Models\Permission;

        $permission = $permission->find($request->permissionId);

        $helper->response()->setHttpCode(200)->send($permission);
    }
    public function update(Request $request, Helper $helper)
    {
        $helper->runValidation([
            'permissionName' => 'bail|required|string|unique:permissions,name,' . $request->permissionId
        ]);

        $permission = new \Spatie\Permission\Models\Permission;

        $permission = $permission->find($request->permissionId);

        $permission->name = $request->permissionName;

        $permission->save();

        $helper->response()->setHttpCode(200)->setMessage('Permission updated successfully.')->send('');
    }
    public function delete(Request $request, Helper $helper)
    {
        $permission = new \Spatie\Permission\Models\Permission;

        $permission = $permission->withCount('roles')->find($request->permissionId);

        if($permission->roles_count > 0){
            $helper->response()->setMessage('This permission is already assigned to a role.')->setHttpCode(400)->send('');
        }else{
            $permission->delete();

            $helper->response()->setMessage('Permission removed successfully.')->setHttpCode(200)->send('');
        }
    }
}
