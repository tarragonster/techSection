<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index(){

        $lists = DB::table('searches')->select('list')->distinct()->get();
        return view('lists.index')->with('lists', $lists);
    }

    public function show($list){

        $lists = DB::table('searches')->where('list',$list)->get();
        return view('lists.show')->with('lists',$lists);
    }
}
