<?php
  
  namespace App\Http\Controllers;
  
  use Illuminate\Http\Request;
  
  class HelloController extends Controller
  {
    public function index()
    {
        return view('hello');
    }

    

    public function show($id)
    {
        return view('hello' , compact('id'));
    }
  }