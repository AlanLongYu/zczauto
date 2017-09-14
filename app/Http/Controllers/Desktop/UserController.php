<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;

class UserController extends FrontController
{
	
	//登录之后个人资料
	public function info()
	{
		
		return view('desktop.user_info');
	}
	
	
	//我的VIP
	public function vip()
	{
		
		return view('desktop.user_vip');
	}
	
	
	//我的订单
	public function order()
	{
		
		return view('desktop.order');
	}
    
    
    //注册
	public function register()
	{
		
		return view('desktop.register');
	}
    
    //登录
	public function login()
	{
		
		return view('desktop.login');
	}
	
	//退出
	public function logout(){
		
		return view('');
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
