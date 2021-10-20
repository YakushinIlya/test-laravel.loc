<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostsController extends Controller
{
    public function __construct(Posts $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $this->data['title'] = 'Записи';
        $this->data['posts'] = PostService::getAll(10, $this->model);

        return view('admin.posts._index', $this->data);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Posts::class);
        if($request->isMethod('post')){
            return PostService::create($request, $this->model);
        }

        $this->data['title']      = 'Создание записи';
        $this->data['categories'] = Categories::all();

        return view('admin.posts._create', $this->data);
    }

    public function delete(Request $request)
    {
        return PostService::delete($request->id, $this->model);
    }
}
