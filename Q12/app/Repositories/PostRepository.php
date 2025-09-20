<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function all($filters = [])
    {
        $query = Post::query();

        // 搜尋
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', "%{$filters['search']}%")
                ->orWhere('content', 'LIKE', "%{$filters['search']}%");
            });
        }

        // 排序
        if (!empty($filters['sort']) && $filters['sort'] === 'manual') {
            $query->orderBy('order_no', 'ASC')->orderBy('id', 'DESC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }
    
        return $query->paginate(10);   
    }

    public function find($id)
    {
        return Post::findOrFail($id);   
    }


    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
