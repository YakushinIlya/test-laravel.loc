<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Categories;

class PostController extends Controller
{
    public function __construct(Posts $model)
    {
        $this->model = $model;
    }

    public function view($id)
    {
        $post = PostService::getId($id, $this->model);
        $this->data['title'] = $post['head'];
        $this->data['post']  = $post;

        return view('admin.posts._view', $this->data);
    }

    public function category($id)
    {
        $user  = Auth::user();
        $role  = $user->role[0]->id;
        $child = $user->child->toArray();
        if((int)$role===1) {
            $arrId = [$user->id];
            foreach($child as $arr) {
                $arrId[] = $arr['id'];
            }
            $this->data['posts'] = PostService::getCategoryChildAll($arrId, $id,10, $this->model);
        } else {
            $this->data['posts'] = PostService::getCategoryMyAll($user->id, $id, 10, $this->model);
        }
        $category            = Categories::find($id);
        $this->data['title'] = 'Категория: '.$category['head'];

        return view('admin.posts._index', $this->data);
    }

    public function author($id)
    {
        $author              = User::find($id);
        $this->data['posts'] = PostService::getAuthorAll($id, 10, $this->model);
        $this->data['title'] = 'Автор: '.$author['email'];

        return view('admin.posts._index', $this->data);
    }
}
