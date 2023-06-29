<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Article;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'username',
        'article_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
