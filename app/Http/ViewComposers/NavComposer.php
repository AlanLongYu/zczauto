<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Douyasi\Models\Nav;

class NavComposer
{
    /**
     * 用户仓库实现.
     *
     * @var UserRepository
     */
    protected $navs;

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
        $this->navs = $navs;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navs', $this->navs);
    }
}