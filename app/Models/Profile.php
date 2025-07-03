<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = ['name','email','phone', 'date_of_birth', 'address', 'bio'];
    protected $guarded = ['id'];
    protected $table = 'profiles';

    public function tasks()
    {
        return $this->hasMany(categorie::class,'Categorie_task');
    }
}
