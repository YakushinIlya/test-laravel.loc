<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $this->data['title'] = 'Пользователи';
        $this->data['users'] = UserService::getAll(10, $this->model);

        return view('admin.users._index', $this->data);
    }

    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        if($request->isMethod('post')){
            return UserService::create($request, $this->model);
        }
        $this->data['title'] = 'Создание пользователя';
        $this->data['roles'] = Roles::all();

        return view('admin.users._create', $this->data);
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', User::class);
        return UserService::delete($request->id, $this->model);
    }
}
