<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

class HelpController extends FrontController
{

    /**
     * 关于我们
     */
    public function about()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.help');
    }
	
	
	/**
     * 维修手册库
     */
    public function start()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.start');
    }
	
	
	/**
     * 维修软件库
     */
    public function softdown()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.softdown');
    }
	
	/**
     * VIP购买
     */
    public function vip()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.vip');
    }
	
	
	/**
     * 加入我们
     */
    public function joinus()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.join');
    }
	
	
	/**
     *联系我们
     */
    public function contact()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.contact');
    }

    /**
     *免责声明
     */
    public function disclaimer()
    {
		#导航
		#轮播
		#静态
		#最新公告
		#友情链接
        return view('desktop.disclaimer');
    }
	
	
}
