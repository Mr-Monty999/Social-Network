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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function followings()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile1_id", "profile2_id")->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile2_id", "profile1_id")->withTimestamps();
    }
}
