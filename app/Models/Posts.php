<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'head', 'image', 'categories_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
