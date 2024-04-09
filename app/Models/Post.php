<?php

// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'category_id', 'cover_photo', 'admin_id', 'author_id', 'view_count',];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
