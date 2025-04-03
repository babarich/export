<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;

class PageController extends Controller
{
    


    public function term(Request $request){
        return view('terms');
    }

    public function about(Request $request){
        return view('about');
    }

     public function faq(Request $request){
        return view('faq');
    }



      public function contact(Request $request){
        return view('contact');
    }


     public function privacy(Request $request){
        return view('privacy');
    }

    
    
}
