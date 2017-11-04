<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Douyasi\Http\Requests\SoftRequest;
use Douyasi\Models\SoftCategory;
use Gate;


/**
 * 分类控制器
 * 无关核心业务逻辑，直连模型操作
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class SoftController extends BackController
{

    public function __construct()
    {
        parent::__construct();

        if (Gate::denies('@category')) {
            $this->middleware('deny403');
        }
    }

    public function index(Request $request)
    {
        $categories = SoftCategory::orderBy('sort', 'asc')->paginate(15);
        return view('admin.back.soft.index', compact('categories'));
    }

    public function create(Request $request)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        return view('admin.back.soft.create');
    }

    public function edit($id)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $data = SoftCategory::find($id);
        is_null($data) AND abort(404);
        return view('admin.back.soft.edit', compact('data'));
    }


    public function store(SoftRequest $request)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $inputs = $request->all();
        $category = new SoftCategory;
        $category->sort = e($inputs['sort']);
        $category->slug = e(trim($inputs['slug']));
        $category->name = !isset($inputs['name']) ? $category->slug : e($inputs['name']);
        if($category->save()) {
            return redirect()->to(site_path('soft', 'admin'))->with('message', '成功新增软件分类！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function update(SoftRequest $request, $id)
    {
        if (Gate::denies('category-write')) {
            return deny();
        }
        $inputs =$request->all();
        $category = SoftCategory::find($id);
        $category->sort = e($inputs['sort']);
        $category->slug = e(trim($inputs['slug']));
        $category->name = !isset($inputs['name']) ? $category->slug : e($inputs['name']);
        if($category->save()) {
            return redirect()->to(site_path('soft', 'admin'))->with('message', '成功修改软件分类！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

}
