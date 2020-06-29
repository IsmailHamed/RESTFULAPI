<?php

namespace App;

use App\Transformers\PermissionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustPermission;

/**
 * @property mixed id
 */
class Permission extends LaratrustPermission
{
    use SoftDeletes;
    public $transformer = PermissionTransformer::class;
    protected $hidden = ['pivot'];



    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
