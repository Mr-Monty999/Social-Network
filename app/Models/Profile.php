<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ["firstname", "lastname", "profile_id", "avatar", "background_photo", "user_id"];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
