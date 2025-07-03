<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = ['title', 'description', 'priority','Profile_id',];
    protected $guarded = ['id'];
    protected $table = 'tasks';

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'Profile_id');
    }

    public function categories()
    {
        return $this->BelongsToMany(categorie::class, 'Categorie_task');
    }

    // public function category()
    // {
    //     return $this->belongsTo(categorie::class, 'categorie_id');
    // }
}
