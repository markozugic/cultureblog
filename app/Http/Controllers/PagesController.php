<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){

        $title = "Welcome to Culture!";
        //Passing args to views - two ways
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);


    }

    public function about(){
        $title = "About Us";
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Web Development', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
