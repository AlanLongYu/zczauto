<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;

class HomeController extends FrontController
{

    /**
     * ZCZAUTO首页
     */
    public function getIndex()
    {
        $articles = Article::orderBy('created_at', 'desc')->simplePaginate(3);
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        \App\Member::where('end_date','<=',date('Y-m-d H:i:s'))->update(['role' => 2,'max_number' => 0]);
        return view('desktop.index', compact('articles'));
    }

    /**
     * 博客文章
     */
    public function getArticle($cslug, $slug)
    {
        $category = Category::where('slug', '=', $cslug)->first();
        if ($category) {
            $article = Article::where('cid', '=', $category->id)
                            ->where('slug', '=', $slug)
                            ->first();
            if ($article) {
                return view('desktop.detail', compact('article', 'category'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * 博客分类
     */
    public function getCategory($slug)
    {
        $category = Category::where('slug', '=', $slug)->first();
        if ($category) {
            $query = Article::where('cid', '=', $category->id)
                            ->orderBy('created_at', 'desc');
            $count = $query->count();
            $articles = $query->simplePaginate(6);
            return view('desktop.category', compact('articles', 'category', 'count'));
        } else {
            return abort(404);
        }
    }

    /**
     * YASCMF landing page
     */
    public function getLandingPage()
    {
        return view('desktop.landing-page');
    }

    /**
     * Change Language
     */
    public function getLang(ChangeLocale $changeLocale)
    {
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
