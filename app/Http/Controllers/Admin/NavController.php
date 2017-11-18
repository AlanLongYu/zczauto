<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Douyasi\Models\Nav;

class NavController extends Controller
{
    	/**
         * 显示导航列表.
         *
         * @return Response
         */
        public function index()
        {
            $navs = Nav::orderBy('sort','ASC')->get();
            foreach($navs->toArray() AS $key => $val){
            	$items[$val['id']] = $val;
        	}
        	$tree =  Nav::generateTree($items);
        	return view('admin.back.nav.index', ['categories' => $navs,'tree'=> $tree]);
        }

        /**
         * 创建新导航表单页面
         *
         * @return Response
         */
        public function create()
        {
            return view('admin.back.nav.create');
        }

        /**
         * 将新创建的导航存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * 显示指定导航
         *
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            //
        }

        /**
         * 显示编辑指定导航的表单页面
         *
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            $data = Nav::find($id);
	        is_null($data) AND abort(404);
	        return view('admin.back.nav.edit', compact('data'));
        }

        /**
         * 在存储器中更新指定导航
         *
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            $inputs =$request->all();
	        $nav = Nav::find($id);
	        $nav->key = e($inputs['key']);
	        $nav->name = e($inputs['name']);
	        $nav->sort = e($inputs['sort']);
	        $nav->url = e(trim($inputs['url']));
	        if($nav->save()) {
	            return redirect()->to(site_path('nav', 'admin'))->with('message', '成功修改导航栏！');
	        } else {
	            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
	        }
        }

        /**
         * 从存储器中移除指定导航
         *
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            $post = Nav::find($id);
			if($nav->delete()){
			    return redirect()->to(site_path('nav', 'admin'))->with('message', '成功删除导航栏！');
			}else{
			    return redirect()->back()->withInput($request->input())->with('fail', '删除导航栏失败');
			}
        }
    }
