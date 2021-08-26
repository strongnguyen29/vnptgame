<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageData('Quản lý tài khoản');
        $users = User::with('roles:id,name,label')->get();
        return view('backend.pages.user.index', $this->getViewData(['users' => $users]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageData('Thêm tài khoản');

        $roles = Role::all(['id', 'name', 'label'])->pluck('label', 'name')->toArray();

        return view('backend.pages.user.create', $this->getViewData(['roles' => $roles]));
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:App\Models\User,email',
            'password'      => 'required|string|confirmed|min:6|max:255',
            'roles'         => 'required|array',
            'active'        => 'nullable|boolean',
        ]);

        $attrs = $request->only(['name', 'email']);
        $attrs['password'] = bcrypt($request->password);
        $attrs['active'] = $request->get('active', true);

        $user = User::create($attrs);
        if (!$user) {
            return back()->withErrors('Lỗi tạo tài khoản');
        }

        $user->assignRole($request->roles);
        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản OK!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles:id,name')->firstWhere('id', $id);

        $this->setPageData('Sửa tài khoản ' . $user->name);

        $roles = Role::all(['id', 'name', 'label'])->pluck('label', 'name')->toArray();

        return view('backend.pages.user.edit', $this->getViewData(['roles' => $roles, 'user' => $user]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:App\Models\User,email,' . $user->id,
            'password'      => 'nullable|string|confirmed|min:6|max:255',
            'roles'         => 'required|array',
            'active'        => 'nullable|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) $user->password = bcrypt($request->password);
        $user->active = $request->active ? 1 : 0;

        if (!$user->save()) {
            return back()->withErrors('Lỗi update tài khoản');
        }

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Update tài khoản OK!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::destroy($id)) {
            return back()->with('success', 'Xóa OK');
        }
        return back()->withErrors('Xóa thất bại');
    }
}
