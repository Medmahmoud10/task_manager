<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = ['name','phone', 'date_of_birth', 'address', 'bio','user_id'];
    protected $guarded = ['id'];
    protected $table = 'profiles';

    public function tasks()
    {
        return $this->hasMany(categories::class,'Categorie_task');
    }
}
