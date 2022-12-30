<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke()
    {
        if((int) auth()->user()->role !==User::ROLE_ADMIN){
            abort(404);
        }
        return view('admin.main.index');
    }
}
