<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct(Posts $model, Categories $modelCategory)
    {
        $this->model         = $model;
        $this->modelCategory = $modelCategory;
    }

    public function index()
    {
        $user  = Auth::user();
        $role  = $user->role[0]->id;
        $child = $user->child->toArray();
        if((int)$role===1) {
            $arrId = [$user->id];
            foreach($child as $arr) {
                $arrId[] = $arr['id'];
            }
            $this->data['posts'] = PostService::getChildAll($arrId,10, $this->model);
        } else {
            $this->data['posts'] = PostService::getMyAll($user->id, 10, $this->model);
        }
        $this->data['title'] = 'Записи';

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

    public function update(Request $request)
    {
        $this->data['title']      = 'Редактировать статью';
        $this->data['post']       = PostService::getId($request->id, $this->model);
        $this->data['categories'] = $this->modelCategory->all();
        if($request->isMethod('put')){
            return PostService::update($request, $this->model);
        }
        return view('admin.posts._update', $this->data);
    }

    public function delete(Request $request)
    {
        return PostService::delete($request->id, $this->model);
    }
}
