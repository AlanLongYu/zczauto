<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


use Douyasi\Models\Ziliao;
use Douyasi\Models\Category;
use App\Http\Controllers\Controller;
use Douyasi\Http\Requests\ZiliaoRequest;
use Gate;

class CarownerController extends Controller
{
    //列表
    public function index()
    {
    	$navId = 3;//导航id
        $ziliaos = Ziliao::where(['nav_id' =>$navId])->paginate(15);
        return view('admin.back.carowner.index', compact('ziliaos','navId'));
    }

    public function show($id)
    {   $navId = $id;//导航id
        $ziliaos = Ziliao::where(['nav_id' =>$navId])->paginate(15);
        return view('admin.back.carowner.index', compact('ziliaos','navId'));
    }

     public function create(Request $request)
    {   
        $navId = e($request->input('nav_id'));
        if(empty($navId)){
            return redirect()->to(site_path('carowner', 'admin'))->with('fail', '参数错误');
        }
    	$ziliaos = Ziliao::paginate(15);
        $categories = Category::where(['nav_id' => $navId])->get();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
         // print_r($items);exit;
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
        return view('admin.back.carowner.create', ['ziliaos'=> $ziliaos,'categories' => $arr,'navId'=>$navId]);
    }

     public function edit($id)
    {
        $ziliaos = Ziliao::find($id);
        is_null($ziliaos) AND abort(404);
        $navId = $ziliaos -> nav_id;
        $categories = Category::where(['nav_id' => $navId])->get();
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
        
        return view('admin.back.carowner.edit', ['ziliaos'=> $ziliaos,'categories' => $arr,'navId' => $navId]);
    }

     public function store(ZiliaoRequest $request)
    {
        // if (Gate::denies('category-write')) {
        //     return deny();
        // }
        $inputs = $request->all();
        $Ziliao = new Ziliao;
        $Ziliao->category_id = e($inputs['cat_id']);
        $Ziliao->nav_id = e($inputs['navId']);
        $Ziliao->name = e($inputs['name']);
        $Ziliao->content = e($inputs['content']);
        $Ziliao->sort_order = e($inputs['sort']);
        $Ziliao->thumb = e(trim($inputs['thumb']));
        $Ziliao->detail_url  = e(trim($inputs['detail_url']));
        if($Ziliao->save()) {
            return redirect()->to(site_path('carowner/'.e($inputs['navId']), 'admin'))->with('message', '成功新增资料！');
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
        $Ziliao->name = e($inputs['name']);
        $Ziliao->sort_order = e($inputs['sort']);
        $Ziliao->thumb = e(trim($inputs['thumb']));
        $Ziliao->detail_url  = e(trim($inputs['detail_url']));
        if($Ziliao->save()) {
            return redirect()->to(site_path('carowner/'.$inputs['navId'], 'admin'))->with('message', '成功修改资料！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }
}
