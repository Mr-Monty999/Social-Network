<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ["content", "photo", "profile_id"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
