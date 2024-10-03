<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Relationship: A category has many announcements
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
