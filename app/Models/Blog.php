<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['userid','image', 'title', 'author','description', 'created_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
