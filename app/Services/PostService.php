<?php

namespace App\Services;

use App\Models\PostsCategories;

class PostService {

    public function addCategories(int $post_id, array $categories)
    {
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
}
