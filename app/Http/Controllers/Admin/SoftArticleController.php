<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Douyasi\Http\Requests\SoftArticleRequest;
use Douyasi\Models\SoftArticle;
use Douyasi\Models\SoftCategory;
use Gate;


/**
 * 文章控制器
 * 无关核心业务逻辑，直连模型操作
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class SoftArticleController extends BackController
{

    public function __construct()
    {
        parent::__construct();

        if (Gate::denies('@article')) {
            $this->middleware('deny403');
        }
    }


    public function index(Request $request)
    {
        $s_title = $request->input('s_title');
        $s_cid = $request->input('s_cid');

        $categories = SoftCategory::all();
        $articles = SoftArticle::where('title', 'like', '%'.$s_title.'%')
                            ->where('cid', (($s_cid > 0) ? '=' : '<>'), $s_cid)
                            ->orderBy('created_at','desc')
                            ->paginate(15);

        $flags = config('ecms.flag.articles');
        return view('admin.back.softarticle.index', compact('categories', 'articles', 'flags'));
    }

    public function create()
    {
        if (Gate::denies('article-write')) {
            return deny();
        }
        $categories = SoftCategory::all();
        return view('admin.back.softarticle.create', compact('categories'));
    }

    public function store(SoftArticleRequest $request)
    {
        if (Gate::denies('article-write')) {
            return deny();
        }
        $inputs = $request->all();
        $article = new SoftArticle;
        $article->title = e($inputs['title']);
        $article->cid = intval($inputs['cid']);
        $article->language = intval($inputs['language']);
        $article->description = e($inputs['description']);
        $article->size = e($inputs['size']);
        $article->downloadtimes = e($inputs['downloadtimes']);
        $article->content = $inputs['content'];
        $article->url = e($inputs['url']);
        $article->secreat = e($inputs['secreat']);
        $article->slug = $inputs['slug'];
        $article->thumb = empty($inputs['thumb']) ? '' : e($inputs['thumb']);
        $tmp_flag = '';
        /*这里需要对推荐位flag进行处理*/
        if(!empty($inputs['flag']) && is_array($inputs['flag'])) {
            foreach($inputs['flag'] as $flag)
            {
                if(!empty($flag)){
                    $tmp_flag .= $flag.',';
                }
            }
        }
        $article->flag = $tmp_flag;
        if($article->save()) {
            return redirect()->to(site_path('softarticle', 'admin'))->with('message', '成功添加新软件！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function edit($id)
    {
        if (Gate::denies('article-write')) {
            return deny();
        }
        $article = SoftArticle::find($id);
        $categories = SoftCategory::all();
        is_null($article) AND abort(404);
        return view('admin.back.softarticle.edit', compact('article', 'categories'));
    }

    public function update(SoftArticleRequest $request, $id)
    {
        if (Gate::denies('article-write')) {
            return deny();
        }
        $inputs = $request->all();
        $article = SoftArticle::find($id);
        $article->title = e($inputs['title']);
        $article->size = e($inputs['size']);
        $article->language = e($inputs['language']);
        $article->downloadtimes = e($inputs['downloadtimes']);
        $article->is_locked = e($inputs['is_locked']);
        $article->secreat = e($inputs['secreat']);
        $article->url = e($inputs['url']);
        $article->cid = intval($inputs['cid']);
        $article->description = e($inputs['description']);
        $article->content = $inputs['content'];
        $article->slug = $inputs['slug'];
        $article->thumb = empty($inputs['thumb']) ? '' : e($inputs['thumb']);
        $tmp_flag = '';
        /*这里需要对推荐位flag进行处理*/
        if(!empty($inputs['flag']) && is_array($inputs['flag'])) {
            foreach($inputs['flag'] as $flag)
            {
                if(!empty($flag)){
                    $tmp_flag .= $flag.',';
                }
            }
        }
        $article->flag = $tmp_flag;
        if($article->save()) {
            return redirect()->to(site_path('softarticle', 'admin'))->with('message', '成功更新软件！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

}
