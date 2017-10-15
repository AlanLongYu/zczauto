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
    	$ziliao = Ziliao::paginate(15);
        return view('admin.back.ziliao.index', compact('ziliao'));
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
