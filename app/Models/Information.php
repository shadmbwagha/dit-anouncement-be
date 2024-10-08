<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'expiration_date', 'is_active'];

    // Relationship: Information belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
