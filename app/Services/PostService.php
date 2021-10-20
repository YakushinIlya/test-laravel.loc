<?php

namespace App\Services;

use App\Helpers\ImageCorrector;
use App\Interfaces\ContentAction;
use App\Helpers\Validation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Categories;

class PostService implements ContentAction
{

    public static function getAll(int $count, object $model)
    {
        return $model::orderByDesc('id')->paginate($count);
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
                $model->head  = $data['head'];
                Categories::find($data['category'])
                    ->posts()
                    ->save($model);
                return redirect()->route('admin.posts')->with('status', 'Запись успешно добавлена');
            } catch(ModelNotFoundException $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    public static function update(int $id, object $request, object $model)
    {
        // TODO: Implement delete() method.
    }

    public static function delete(int $id, object $model)
    {
        try {
            $model::findOrFail($id)->delete();
            return redirect()->back()->with('status', 'Запись успешно удалена');
        } catch(ModelNotFoundException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
