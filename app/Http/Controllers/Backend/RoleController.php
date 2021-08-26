<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BackendController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageData('Quản lý nhóm tài khoản');
        $roles = Role::with('permissions:id,name')->get();
        return view('backend.pages.role.index', $this->getViewData(['roles' => $roles]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = config('backend.permissions');
        return view('backend.pages.role.create', $this->getViewData(['permissions' => $permissions]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:Spatie\Permission\Models\Role,name',
            'label' => 'required|string|min:3|max:255',
            'permissions' => 'nullable|array'
        ]);

        $role = Role::create([
            'name' => Str::slug($request->name),
            'label' => Str::title($request->label)
        ]);

        if (!$role) {
            return back()->withErrors('Lỗi tạo nhóm');
        }

        if ($permissions = $request->get('permissions', false) ) {
            $ids = $this->createPermissionIfNotExist($permissions);
            $role->syncPermissions($ids);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Tạo nhóm OK!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions:id,name')->firstWhere('id', $id);
        $this->setPageData('Sửa nhóm ' . $role->label);

        $permissions = config('backend.permissions');
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('backend.pages.role.edit', $this->getViewData(['role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:Spatie\Permission\Models\Role,name,' . $role->id,
            'label' => 'required|string|min:3|max:255',
            'permissions' => 'nullable|array'
        ]);
        $role->name = Str::slug($request->name);
        $role->label = Str::title($request->label);
        $role->save();

        if (!$role->save()) {
            return back()->withErrors('Lỗi cập nhật nhóm');
        }

        $ids = $this->createPermissionIfNotExist($request->get('permissions', []));
        $role->syncPermissions($ids);

        return redirect()->route('admin.roles.index')->with('success', 'Tạo cập nhật OK!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::destroy($id)) {
            return back()->with('success', 'Xóa OK');
        }
        return back()->withErrors('Xóa thất bại');
    }

    /**
     *
     */
    public function createPermissionIfNotExist($permissions) {
        $ids = [];

        foreach($permissions as $permission) {
            $ids[] = Permission::query()->firstOrCreate(['name' => $permission]);
        }

        return $ids;
    }

}
