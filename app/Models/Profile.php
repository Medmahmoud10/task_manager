<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['phone', 'date_of_birth', 'address', 'bio'];
    protected $guarded = ['id'];
    protected $table = 'profiles';

    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
}
