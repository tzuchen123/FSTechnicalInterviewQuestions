<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService; 

class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'sort']);
        return response()->json($this->service->list($filters));
    }

    public function show($id)
    {
        $post = $this->service->get($id);

        if (!$post) {
            return response()->json([
                'message' => '文章未啟用或不存在'
            ], 200); // 或 204 No Content，看你需求
        }

        return response()->json($post);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        return response()->json($this->service->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'string|max:255',
            'image' => 'nullable|string|max:255',
            'content' => 'string',
        ]);
        return response()->json($this->service->update($id, $data));
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Deleted']);
    }

    public function setActive($id)
    {
        return response()->json($this->service->activate($id));
    }

    public function setInactive($id)
    {
        return response()->json($this->service->deactivate($id));
    }

    public function setOrder(Request $request, $id)
    {
        $data = $request->validate(['order_no' => 'required|integer']);
        return response()->json($this->service->setOrder($id, $data['order_no']));
    }
}
