<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Douyasi\Models\Nav;
use Douyasi\Models\Car;
use Douyasi\Models\Category;
use Douyasi\Http\Requests\NavRequest;

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
        	$navs = Nav::all();
        	$topNav = [];
        	$secondNav = [];
        	$Nav = [];
        	if(!is_null($navs)){
        		foreach($navs AS $k => $v){
        			if($v['p_id'] == 0){
        				$topNav[] = $v['id'];
        			}
        			if(in_array($v['p_id'],$topNav)){
        				$secondNav[] = $v['id'];
        			}
        			$Nav[$v['id']] = $v;
        		}
        	}
            $items = [];
            $cars = Car::orderBy('id','ASC')->get();
            foreach($cars->toArray() AS $key => $val){
                $items[$val['id']] = $val;
            }
            //ztree 车系数据
            $tree =  json_encode(Car::generateTree($items));

            return view('admin.back.nav.create',compact('topNav','secondNav','Nav','cars','tree'));
        }

        /**
         * 将新创建的导航存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function store(NavRequest $request)
        {
            $inputs = $request->all();
	        $nav = new Nav;
	        $nav->name = e($inputs['name']);
	        $nav->sort = e($inputs['sort']);
	        $nav->p_id = e(trim($inputs['p_id']));
            $nav->url = e(trim($inputs['url']));
	        $nav->content = $inputs['content'];

	        if($nav->save()) {
	            return redirect()->to(site_path('nav', 'admin'))->with('message', '成功新增导航栏目！');
	        } else {
	            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
	        }
        }


        /**
         * 异步将新创建的导航存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxStore(Request $request)
        {
            $inputs = $request->all();
            $params = $inputs['params'];
            $checkedNodes = isset($inputs['checkedNodes']) ? $inputs['checkedNodes'] : [];
            foreach (explode('&',$inputs['params']) as $value) {
                $keyVal = explode('=', $value);
                $paramsArr[$keyVal[0]] = $keyVal[1];
            }

            //执行Nav新增
            if(empty($paramsArr['name'])){
                return response()->json(['msg' => '导航名称不能为空','code' => 600]);
            }
            $nav = new Nav;
            $nav->name = e(urldecode($paramsArr['name']));
            $nav->sort = e($paramsArr['sort']);
            $nav->p_id = e(trim($paramsArr['p_id']));
            $nav->url = e(trim($paramsArr['url'])) ? e(trim($paramsArr['url'])) : '/data/data/'.$nav->id;
            $nav->content = $inputs['content'];
            $nav->save();

            $insetNav = Nav::find($nav->id);
            $insetNav->url = '/data/data/'.$nav->id;
            $insetNav->save();

            //导航ID
            $navId = $nav->id;
            $inserts = [];
            if(!empty($checkedNodes)){//有选择节点
                foreach ($checkedNodes as $node) {
                    //第一层
                    $inserts[] = ['slug' => time()*mt_rand(1,10000),'nav_id' => $navId,'p_id' => e(trim($node['p_id'])),'id' => $node['id'],'name' => $node['name']];
                }
            }
            if(!empty($inserts)){
            	$res = DB::table('categories')->insert(
             		$inserts
            	);
            }else{
            	$res =true;
            }
            
            if($nav->save() && $res) {
                Session::flash('message', '成功新增导航栏目！');
                return response()->json(['msg' => '成功新增导航栏目！','code' => 200,'redirectUrl' => site_path('nav', 'admin')]);
            } else {
                return response()->json(['code' => 606,'msg' => '数据库操作返回异常！']);
            }
        }

        /**
         * ajax删除导航
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxDel(Request $request)
        {
            $inputs = $request->all();
            $Car = Car::find(trim($inputs['id']));
            if(!$Car->exists){
                throw new Exception("数据不存在", 110);
            }
            try{
                $deleteId = $Car->delete();
                return response()->json(['code' => 200,'msg' => '删除车型成功','data' => $Car->id]);

            }catch(\Exception $e){
                return response()->json(['code' => $e->getCode(),'msg' => $e->getMessage()]);
            }
        }

        /**
         * ajax保存修改车型
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxEdit(Request $request)
        {
            $inputs = $request->all();
            $inserts = [];
            $Category = Category::where(['nav_id' => e($inputs['navId'])])->get();
            try{
                //$deleteId = $Category->delete();
                DB::delete('delete from yascmf_categories where nav_id = '.e($inputs['navId']));
                //插入新车型车系
				$checkedNodes = isset($inputs['checkedNodes']) ? $inputs['checkedNodes'] : [];
				if(!empty($checkedNodes)){//有选择节点
                foreach ($checkedNodes as $node) {
                    //第一层
                    $inserts[] = ['slug' => time()*mt_rand(1,10000),'nav_id' => e($inputs['navId']),'p_id' => e(trim($node['p_id'])),'id' => $node['id'],'name' => $node['name']];
                }
            }
	        if(!empty($inserts)){
	        	$res = DB::table('categories')->insert(
	         		$inserts
	        	);   
	        }
                         
                return response()->json(['code' => 200,'msg' => '删除车型成功']);

            }catch(\Exception $e){
                return response()->json(['code' => $e->getCode(),'msg' => $e->getMessage()]);
            }
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
            $allNavs = Nav::all();
            $topNav = [];
            $secondNav = [];
            $pNavs = [];
            $topNavIds = [];
            if(!is_null($allNavs)){
                foreach($allNavs AS $k => $v){
                    if($v['p_id'] == 0){
                        $topNav[] = $v;
                        $topNavIds[] = $v['id'];
                    }
                    if(in_array($v['p_id'],$topNavIds)){
                        $secondNav[] = $v;
                        $secondNavIds[] = $v['id'];
                    }
                }
            }
            $Nav = Nav::find($id);


            $items = [];
            $cars = Car::orderBy('id','ASC')->get();
            foreach($cars->toArray() AS $key => $val){
                $items[$val['id']] = $val;
            }
            //ztree 车系数据
            $tree =  Car::generateTree($items);

            $checkedTree = Category::where(['nav_id' => $id])->get();
            $checked = [];
            foreach ($checkedTree as  $v) {
            	$checked[] = $v['name'];
            }
	        foreach ($tree as &$value) {
	        	if(isset($value['children']) && is_array($value['children'])){
	        		foreach ($value['children'] as &$vv) {
	        			if(in_array($vv['name'], $checked)){
	        				$vv['checked'] = true;
	        			}

	        			if(isset($vv['children']) && is_array($vv['children'])){
	        				foreach ($vv['children'] as &$vvv) {
			        			if(in_array($vvv['name'], $checked)){
			        				$vvv['checked'] = true;
			        			}
	        				}
	        			}
	        		}
	        	}
	        	if(in_array($value['name'], $checked)){
	        		$value['checked'] = true;
	        	}
            }
            is_null($Nav) AND abort(404);
            $tree = json_encode($tree);
	        return view('admin.back.nav.edit', compact('pNavs','allNavs','Nav','tree','topNav','secondNav'));
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
	        $nav->key = isset($inputs['key']) ? $inputs['key'] : md5(e($inputs['name']));
	        $nav->name = e($inputs['name']);
	        $nav->sort = e($inputs['sort']);
	        $nav->p_id = e($inputs['p_id']);
	        $nav->url = e(trim($inputs['url']));
            $nav->content = $inputs['content'];
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
