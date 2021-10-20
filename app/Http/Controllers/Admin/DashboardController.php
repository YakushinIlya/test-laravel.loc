<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Панель управления';

        return view('admin._index', $this->data);
    }
}
