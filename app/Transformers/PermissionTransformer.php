<?php

namespace App\Transformers;

use App\Permission;

use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
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
     * @param Permission $permission
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'identifier' => (int)$permission->id,
            'name' => (string)$permission->name,
            'displayName' => (string)$permission->display_name,
            'description' => (string)$permission->description,
            'creationDate' => (string)$permission->created_at,
            'lastChange' => (string)$permission->updated_at,
            'deleteDate' => isset($user->deleted_at) ? (string)$permission->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('permissions.show', $permission->id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attribute = [
            'identifier' => 'id',
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
