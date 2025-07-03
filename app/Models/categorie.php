<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Model;

class categorie  extends Model
{
    public function tasks()
    {
        return $this->belongsToMany(Task::class,'Categorie_tasks');
    }
    
}