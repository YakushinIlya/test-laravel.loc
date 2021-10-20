<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Тестовое задание';

        return view('user._index', $this->data);
    }
}
