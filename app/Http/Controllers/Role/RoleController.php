<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\ApiController;
use App\Role;
use App\Transformers\RoleTransformer;
use App\User;
use Illuminate\Http\Request;

class RoleController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('client.credentials')->only(['store', 'resend']);
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . RoleTransformer::class)->only(['store', 'update']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->showAll($roles, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name|max:255'
//            'description' => 'required',
        ];
        $this->validate($request, $rules);
        $newRole=Role::create($request->all());
        $permissions = $request->get('permissions');
        $users = $request->get('users');
        if (!is_null($permissions)) {
            $newRole->attachPermissions($permissions);
        }
        if (!is_null($permissions)) {
            $newRole->users()->attach($users);
        }
        $newRole->save();
        return $this->showOne( $newRole, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->showOne($role, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->allowedAdminAction();
        $role->fill($request->only([
            'display_name',
            'description',
        ]));
//        if ($role->isClean()) {
//            return $this->errorResponse('You need to specify any different value to update', 422);
//        }
        $permissions = $request->get('permissions');
        $users = $request->get('users');
        if (!is_null($permissions)) {
            $role->syncPermissions($permissions);
        }
        if (!is_null($permissions)) {
            $role->users()->sync($users);
        }
        $role->save();
        return $this->showOne($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->forceDelete();
        return $this->showOne($role, 200);
    }

    public function checkRoleName(Request $request)
    {

//        $rules = [
//            'name' => 'required|unique:roles,name|max:255'
//        ];
//        $this->validate($request, $rules);
        $roleName = $request->input('name');
        $res = false;
        if (!is_null($roleName)) {
            $role = Role::where('name', $roleName)->first();
            if ($role != null) {
                $res = true;
            }
        }
        return $this->successResponse($res, 200);
    }
}
