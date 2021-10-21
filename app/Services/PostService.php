<?php

namespace App\Services;

use App\Helpers\ImageCorrector;
use App\Interfaces\ContentAction;
use App\Helpers\Validation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PostService implements ContentAction
{
    public static function getAll(int $count, object $model)
    {
        return $model::orderByDesc('id')->paginate($count);
    }

    public static function getChildAll(array $child, int $count, object $model)
    {
        return $model::whereIn('user_id', $child)->orderByDesc('id')->paginate($count);
    }

    public static function getMyAll(int $id, int $count, object $model)
    {
        return $model::where('user_id', $id)->orderByDesc('id')->paginate($count);
    }

    public static function getAuthorAll(int $id, int $count, object $model)
    {
        return $model::where('user_id', $id)->orderByDesc('id')->paginate($count);
    }

    public static function getCategoryChildAll(array $child, int $category_id, int $count, object $model)
    {
        return $model::where('category_id', $category_id)->whereIn('user_id', $child)->orderByDesc('id')->paginate($count);
    }

    public static function getCategoryMyAll(int $user_id, int $category_id, int $count, object $model)
    {
        return $model::whereRow('user_id=? && category_id=?', [$user_id, $category_id])->orderByDesc('id')->paginate($count);
    }

    public static function getId(int $id, object $model)
    {
        return $model::find($id);
    }

    public static function create(object $request, object $model)
    {
        $data = $request->except(['_token', 'image']);
        $validator = Validation::postData($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                if($request->hasFile('image')) {
                    $fileExt = $request->file('image')->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/posts/';
                    $fileName = md5($data['head'].date('Y')) . '.' . $fileExt;
                    $request->file('image')->move($destinationPath, $fileName);
                    ImageCorrector::getAvatar($destinationPath.$fileName, 500, 500);
                    $model->image = '/uploads/posts/'.$fileName;
                }
                $model->head        = $data['head'];
                $model->category_id = $data['category'];
                $model->user_id     = Auth::user()->id;
                $model->save();
                return redirect()->route('admin.posts')->with('status', 'Запись успешно добавлена');
            } catch(ModelNotFoundException $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    public static function update(object $request, object $model)
    {
        $data = $request->except(['_token', 'image']);
        $validator = Validation::postData($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                $post = $model::find($request->id);
                if($request->hasFile('image')) {
                    $fileExt = $request->file('image')->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/posts/';
                    $fileName = md5($data['head'].date('Y')) . '.' . $fileExt;
                    $request->file('image')->move($destinationPath, $fileName);
                    ImageCorrector::getAvatar($destinationPath.$fileName, 500, 500);
                    $image = '/uploads/posts/'.$fileName;
                    $post['image']?unlink($post['image']):$post['image'];
                }
                $post->update([
                    'head'        => $data['head'],
                    'image'       => $image??'',
                    'category_id' => $data['category'],
                    'user_id'     => Auth::user()->id,
                ]);
                return redirect()->route('admin.posts')->with('status', 'Запись успешно обновлена');
            } catch(ModelNotFoundException $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    public static function delete(int $id, object $post)
    {
        try {
            $post->delete();
            unlink($post['image']);
            return redirect()->back()->with('status', 'Запись успешно удалена');
        } catch(ModelNotFoundException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
