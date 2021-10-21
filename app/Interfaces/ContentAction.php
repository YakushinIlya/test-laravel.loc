<?php

namespace App\Interfaces;

interface ContentAction
{
    public static function getAll(int $count, object $model);
    public static function getId(int $id, object $model);
    public static function create(object $request, object $model);
    public static function update(object $request, object $model);
    public static function delete(int $id, object $model);
}
