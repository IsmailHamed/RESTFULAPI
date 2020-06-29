<?php

namespace App;

use App\Transformers\RoleTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use SoftDeletes;
    public $transformer = RoleTransformer::class;
    protected $dates = ['deleted_at'];
    protected $hidden = ['pivot'];
    protected $fillable = ['name', 'display_name', 'description']; //<---- Add this line

    //Many To Many
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

}
