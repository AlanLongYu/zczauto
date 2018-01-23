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
        return view('desktop.help',['title' => '关于我们']);
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
        return view('desktop.start',['title' => '网站帮助']);
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
        return view('desktop.join',['title' => '加入我们']);
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
        return view('desktop.contact',['title' => '联系我们']);
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
        return view('desktop.disclaimer',['title' => '免责声明']);
    }
	
	
}
