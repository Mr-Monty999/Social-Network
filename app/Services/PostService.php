<?php

namespace App\Services;

use App\Models\Post;

/**
 * Class PostService.
 */
class PostService
{


    public static function getAllPosts()
    {
        $posts = Post::with("profile.followings", "profile.followers")->get();

        return $posts;
    }





    public static function getPostById($postId)
    {
        $post = Post::with("profile.followings", "profile.followers")->findOrFail($postId);
        return $post;
    }
}
