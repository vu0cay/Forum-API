<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    } 

    public function comment(): BelongsTo {
        return $this->belongsTo(Comment::class);
    }
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }

    public function child() {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

}
