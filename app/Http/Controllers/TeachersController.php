<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachersController extends Controller
{
   
    public function index()
    {

        return view('admin.view-teachers');
    }
}
