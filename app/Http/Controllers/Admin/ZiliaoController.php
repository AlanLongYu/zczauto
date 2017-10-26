<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Douyasi\Models\Ziliao;
use Douyasi\Models\Category;
use App\Http\Controllers\Controller;

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

     public function edit()
    {
    	
    }

     public function store(CategoryRequest $request)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $inputs = $request->all();
        $category = new Category;
        $category->name = e($inputs['name']);
        $category->sort = e($inputs['sort']);
        $category->slug = e(trim($inputs['slug']));
        if($category->save()) {
            return redirect()->to(site_path('category', 'admin'))->with('message', '成功新增分类！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $inputs =$request->all();
        $category = Category::find($id);
        $category->name = e($inputs['name']);
        $category->sort = e($inputs['sort']);
        $category->slug = e(trim($inputs['slug']));
        if($category->save()) {
            return redirect()->to(site_path('category', 'admin'))->with('message', '成功修改分类！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }
}
