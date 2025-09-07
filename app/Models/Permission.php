<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    public function Roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
