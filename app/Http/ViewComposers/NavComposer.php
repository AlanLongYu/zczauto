<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Douyasi\Models\Nav;
use App\News;

class NavComposer
{
    /**
     * 用户仓库实现.
     *
     * @var UserRepository
     */
    protected $navs;
    protected $news;

    /**
     * 创建一个新的属性composer.
     *
     * @param UserRepository $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $navs = Nav::orderby('sort')->get();
        $news = News::first();
        $this->navs = $navs;
        $this->news = $news;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {   $this->news->content = str_replace("\r\n","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$this->news->content);
        $view->with('navs', $this->navs);
        $view->with('news', $this->news);
    }
}