<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostsCategories;

class PostService {

    public function addCategories(int $post_id, array $categories)
    {
        // we must delete all records to pair post->category on table posts_categories
        PostsCategories::where('post_id', $post_id)->delete();

        foreach ($categories as $category) {
            PostsCategories::create(
                [
                    'post_id'  => $post_id,
                    'category_id' => $category
                ]
            );
        }
        return true;
    }

    public function getArrayCategories( $categories ) : array
    {
        $categoriesArray = [];
        foreach ($categories as $singleCat) {
            $categoriesArray[] = $singleCat->id;
        }
        return $categoriesArray;
    }

    public function getAllPosts()
    {
        $posts = Post::all();
      return response()->json($posts, 200);
  }
}
