<?php

namespace App\Models;

use App\Http\Resources\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority', 'Profile_id', 'categorie_id', 'user_id', 'status'];
    protected $guarded = ['id'];
    protected $table = 'tasks';
    protected $casts = ['status' => 'string'];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'Profile_id');
    }

    // FIXED: Changed method name to match eager loading
    public function categorie(): BelongsTo
{
    return $this->belongsTo(\App\Models\categories::class, 'categorie_id');
}
}