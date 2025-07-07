<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = ['title', 'description', 'priority','Profile_id'];
    protected $guarded = ['id'];
    protected $table = 'tasks';

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'Profile_id');
    }

    public function categories()
    {
        // return $this->belongsToMany(categories::class, 'categorie_task', 'task_id', 'categorie_id');
        return $this->belongsToMany(
        \App\Models\categories::class, // Full namespace
        'categorie_task', // pivot table name
        'task_id',       // foreign key on pivot table
        'categorie_id'   // related key on pivot table
    )->withPivot('task_id', 'categorie_id');
    }







    

}
