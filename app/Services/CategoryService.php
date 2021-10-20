<?php

namespace App\Services;

use App\Interfaces\ContentAction;
use App\Models\Categories;

class CategoryService implements ContentAction
{
    public function getAll(int $count)
    {
        return Categories::orderByDesc('id')->paginate($count);
    }

    public static function getId(int $id, object $model)
    {
        // TODO: Implement getId() method.
    }

    public static function create(array $data, object $model)
    {
        // TODO: Implement create() method.
    }

    public static function update(int $id, array $data, object $model)
    {
        // TODO: Implement update() method.
    }

    public static function delete(int $id, object $model)
    {
        // TODO: Implement delete() method.
    }
}
