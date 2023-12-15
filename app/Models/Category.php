<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];

    // Relationship: Each category may have many child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relationship: Each category may belong to a parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
