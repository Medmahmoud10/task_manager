<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categories extends Model // ← Changed to PascalCase
{
    protected $fillable = ['name'];
    
    // FIXED: Import correct Task model and use proper relationship
    public function tasks(): HasMany
    {
        return $this->hasMany(\App\Models\Task::class, 'categorie_id');
    }
}