<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Post;

class PostService
{
    protected $repo;

    public function __construct(PostRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list($filters)
    {
        return $this->repo->all($filters);
    }

    public function get($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->repo->find($id);
        return $this->repo->update($post, $data);
    }

    public function delete($id)
    {
        $post = $this->repo->find($id);
        return $this->repo->delete($post);
    }

    public function activate($id)
    {
        $post = $this->repo->find($id);
        return $this->repo->update($post, ['is_active' => 1]);
    }

    public function deactivate($id)
    {
        $post = $this->repo->find($id);
        return $this->repo->update($post, ['is_active' => 0]);
    }

    public function setOrder($id, $orderNo)
    {
        $post = $this->repo->find($id);
        return $this->repo->update($post, ['order_no' => $orderNo]);
    }
}
