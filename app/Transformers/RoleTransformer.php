<?php

namespace App\Transformers;

use App\Role;
use App\Traits\ApiResponser;
use App\User;
use League\Fractal\TransformerAbstract;
use phpDocumentor\Reflection\Types\Boolean;

class RoleTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    use ApiResponser;
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Role $role
     * @param Boolean $withAdditionValue
     * @return array
     */
    public function transform(Role $role)
    {
        $users = $this->transformData($role->users, new UserTransformer());
        $users = $users['data'];
        $permissions = $this->transformData($role->permissions, new PermissionTransformer());
        $permissions = $permissions['data'];
        return [
            'identifier' => (int)$role->id,
            'name' => (string)$role->name,
            'permissions' => $permissions,
            'users' => $users,
            'displayName' => (string)$role->display_name,
            'description' => (string)$role->description,
            'creationDate' => (string)$role->created_at,
            'lastChange' => (string)$role->updated_at,
            'deleteDate' => isset($role->deleted_at) ? (string)$role->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('roles.show', $role->id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attribute = [
            'identifier' => 'id',
            'permissions' => 'permissions',
            'users' => 'users',
            'name' => 'name',
            'displayName' => 'display_name',
            'description' => 'description',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deleteDate' => 'deleted_at',

        ];
        return isset($attribute[$index]) ? $attribute[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'permissions' => 'permissions',
            'users' => 'users',
            'name' => 'name',
            'display_name' => 'displayName',
            'description' => 'description',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
