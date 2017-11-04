<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


use Douyasi\Models\Ziliao;
use Douyasi\Models\Category;
use App\Http\Controllers\Controller;
use Douyasi\Http\Requests\ZiliaoRequest;
use Gate;

class ZiliaoController extends Controller
{
    //列表
    public function index()
    {
    	$ziliaos = Ziliao::paginate(15);
        return view('admin.back.ziliao.index', compact('ziliaos'));
    }

     public function create()
    {
    	$ziliaos = Ziliao::paginate(15);
        $categories = Category::all();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);
        $arr = [];
        foreach ($tree as $k => $v) {
            if(isset($v['son'])){
                foreach ($v['son'] as $kk => $vv) {
                    if(isset($vv['son'])){
                        foreach ($vv['son'] as $kkk => $vvv) {
                           $arr[$vv['id']]['name'] = $vv['name'];
                           $arr[$vv['id']]['son'][$vvv['id']] = $vvv['name'];
                        }
                    }
                    
                }
            }
        }
        // print_r($arr);exit;
        return view('admin.back.ziliao.create', ['ziliaos'=> $ziliaos,'categories' => $arr]);
    }

     public function edit($id)
    {
        $ziliaos = Ziliao::find($id);
        $categories = Category::all();
        is_null($ziliaos) AND abort(404);
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);
        $arr = [];
        foreach ($tree as $k => $v) {
            if(isset($v['son'])){
                foreach ($v['son'] as $kk => $vv) {
                    if(isset($vv['son'])){
                        foreach ($vv['son'] as $kkk => $vvv) {
                           $arr[$vv['id']]['name'] = $vv['name'];
                           $arr[$vv['id']]['son'][$vvv['id']] = $vvv['name'];
                        }
                    }
                    
                }
            }
        }//print_r($arr);
        
        return view('admin.back.ziliao.edit', ['ziliaos'=> $ziliaos,'categories' => $arr]);
    }

     public function store(ZiliaoRequest $request)
    {
        // if (Gate::denies('category-write')) {
        //     return deny();
        // }
        $inputs = $request->all();
        $Ziliao = new Ziliao;
        $Ziliao->category_id = e($inputs['cat_id']);
        $Ziliao->name = e($inputs['name']);
        $Ziliao->content = e($inputs['content']);
        $Ziliao->sort_order = e($inputs['sort']);
        $Ziliao->thumb = e(trim($inputs['thumb']));
        $Ziliao->detail_url  = e(trim($inputs['detail_url']));
        if($Ziliao->save()) {
            return redirect()->to(site_path('ziliao', 'admin'))->with('message', '成功新增资料！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function update(ZiliaoRequest $request, $id)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $inputs =$request->all();
        $Ziliao = Ziliao::find($id);
        $Ziliao->category_id = e($inputs['cat_id']);
        $Ziliao->content = e($inputs['content']);
        $Ziliao->sort_order = e($inputs['sort']);
        $Ziliao->thumb = e(trim($inputs['thumb']));
        $Ziliao->detail_url  = e(trim($inputs['detail_url']));
        if($Ziliao->save()) {
            return redirect()->to(site_path('ziliao', 'admin'))->with('message', '成功修改资料！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }
}
