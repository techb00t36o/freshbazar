<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

public function welcome()
{
return view('welcome');
}


public function index()
{
return view('home');
}


}