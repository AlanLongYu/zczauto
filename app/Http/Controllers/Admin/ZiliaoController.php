<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Douyasi\Models\Ziliao;
use App\Http\Controllers\Controller;

class ZiliaoController extends Controller
{
    //列表
    public function index()
    {
    	$ziliaos = Ziliao::paginate(15);
    	var_dump($ziliaos->items());exit;
        return view('admin.back.ziliao.index', compact('ziliaos'));
    }

     public function add()
    {
    	
    }

     public function edit()
    {
    	
    }

     public function delete()
    {
    	
    }
}
