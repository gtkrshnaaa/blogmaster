<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Author extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = ['name', 'email', 'password'];
    
    protected $hidden = ['password'];

    // Definisikan relasi dengan Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
