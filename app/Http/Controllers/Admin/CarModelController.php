<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Douyasi\Models\Car;
use Douyasi\Http\Requests\CarRequest;

class CarModelController extends Controller
{
    	/**
         * 显示车型列表.
         *
         * @return Response
         */
        public function index()
        {
            $cars = Car::orderBy('sort','ASC')->get();
            $items = [];
            foreach($cars->toArray() AS $key => $val){
            	$items[$val['id']] = $val;
        	}
        	$tree =  Car::generateTree($items);
             // print_r(json_encode($cars->toArray()));exit;
        	return view('admin.back.car.index', ['categories' => json_encode($cars->toArray()),'tree'=> json_encode($tree)]);
        }

        /**
         * 创建新车型表单页面
         *
         * @return Response
         */
        public function create()
        {
        	$Cars = Car::all();
        	$topCar = [];
        	$secondCar = [];
        	$Car = [];
        	if(!is_null($Cars)){
        		foreach($Cars AS $k => $v){
        			if($v['p_id'] == 0){
        				$topCar[] = $v['id'];
        			}
        			if(in_array($v['p_id'],$topCar)){
        				$secondCar[] = $v['id'];
        			}
        			$Car[$v['id']] = $v;
        		}
        	}
            return view('admin.back.car.create',compact('topCar','secondCar','Car'));
        }

        /**
         * 将新创建的车型存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function store(CarRequest $request)
        {
            $inputs = $request->all();
	        $Car = new Car;
	        $Car->name = e($inputs['name']);
	        $Car->sort = e($inputs['sort']);
	        $Car->p_id = e(trim($inputs['p_id']));
	        if($Car->save()) {
	            return redirect()->to(site_path('car', 'admin'))->with('message', '成功新增车系！');
	        } else {
	            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
	        }
        }

        /**
         * ajax新创建的车型存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxAdd(CarRequest $request)
        {
            $inputs = $request->all();
            $Car = new Car;
            $Car->name = e($inputs['name']);
            $Car->p_id = e(trim($inputs['p_id']));
            try{
                $insertId = $Car->save();
                return response()->json(['code' => 200,'msg' => '新增车型成功','data' => $Car->id]);

            }catch(\Exception $e){
                return response()->json(['code' => 110,'msg' => '新增车型失败']);
            }
        }

        /**
         * ajax修改新创建的车型存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxEdit(CarRequest $request)
        {
            $inputs = $request->all();
            // $Car = Car::where(["id" => trim($inputs['id'])])->get();
            $Car = Car::find(trim($inputs['id']));
            $Car->name = e($inputs['name']);
            try{
                $insertId = $Car->save();
                return response()->json(['code' => 200,'msg' => '修改车型成功','data' => $Car->id]);

            }catch(\Exception $e){
                echo $e->getMessage();
                return response()->json(['code' => 110,'msg' => '修改车型失败']);
            }
        }


        /**
         * ajax修改新创建的车型存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function ajaxDel(CarRequest $request)
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
         * 显示指定车型
         *
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            //
        }

        /**
         * 显示编辑指定车型的表单页面
         *
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            $data = Car::find($id);
	        is_null($data) AND abort(404);
	        return view('admin.back.Car.edit', compact('data'));
        }

        /**
         * 在存储器中更新指定车型
         *
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            $inputs =$request->all();
	        $Car = Car::find($id);
	        $Car->key = e($inputs['key']);
	        $Car->name = e($inputs['name']);
	        $Car->sort = e($inputs['sort']);
	        $Car->url = e(trim($inputs['url']));
	        if($Car->save()) {
	            return redirect()->to(site_path('car', 'admin'))->with('message', '成功修改车型栏！');
	        } else {
	            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
	        }
        }

        /**
         * 从存储器中移除指定车型
         *
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            $Car = Car::find($id);
			if($Car->delete()){
			    return redirect()->to(site_path('car', 'admin'))->with('message', '成功删除车型栏！');
			}else{
			    return redirect()->back()->withInput($request->input())->with('fail', '删除车型栏失败');
			}
        }
    }
