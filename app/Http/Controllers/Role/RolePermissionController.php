<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\ApiController;
use App\Permission;
use App\Role;
use App\Transformers\PermissionTransformer;
use App\Transformers\RoleTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

class RolePermissionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {

//        $rolePermissions = $role->permissions()->get(['id']);
//        $rolePermissions = fractal($rolePermissions, new PermissionTransformer());
//        $rolePermissions = $rolePermissions->toArray();
//        $permissions = Permission::all();
//        $permissions = fractal($permissions, new PermissionTransformer());
//        $permissions = $permissions->toArray();
//        $result = ['rolePermissions' => $rolePermissions['data'], 'permissions' => $permissions['data']];
        $permissions = $role->permissions;
        return $this->showAll($permissions);


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
