<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];


    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }
}
