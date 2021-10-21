<?php

namespace App\Services;

use App\Helpers\Validation;
use App\Interfaces\ContentAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements ContentAction
{

    public static function getAll(int $count, object $model)
    {
        return $model::orderByDesc('id')->paginate($count);
    }

    public static function getId(int $id, object $model)
    {
        // TODO: Implement getId() method.
    }

    public static function create(object $request, object $model)
    {
        $data = $request->except('_token');
        $validator = Validation::userData($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                $user = $model::create([
                    'email'    => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
                $user->role()->attach($data['role']);
                $user->child()->attach(Auth::user()->id);
                return redirect()->route('admin.users')->with('status', 'Пользователь успешно добавлен');
            } catch(ModelNotFoundException $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    public static function update(object $request, object $model)
    {
        // TODO: Implement update() method.
    }

    public static function delete(int $id, object $model)
    {
        try {
            $user = $model::findOrFail($id);
            $user->role()->detach();
            $user->child()->detach();
            $user->delete();
            return redirect()->back()->with('status', 'Пользователь успешно удален');
        } catch(ModelNotFoundException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
