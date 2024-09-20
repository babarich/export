<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;

class PageController extends Controller
{
    


    public function index(Request $request){
        return view('welcome');
    }

    public function about(Request $request){
        return view('about');
    }

     public function service(Request $request){
        return view('services');
    }



     public function contact(Request $request){
        return view('contact');
    }



    
    
}
