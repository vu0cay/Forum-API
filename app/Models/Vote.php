<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post(): BelongsTo 
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }
}
