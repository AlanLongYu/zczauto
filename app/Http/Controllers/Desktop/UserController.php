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
	
    /**
     * 添加路由过滤中间件
     */
    public function __construct()
    {
        $this->middleware('multi-site.guest:desktop', ['except' => ['logout','info','vip','order']]);
    }
    
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

	//注册处理
	public function doregister(Request $request)
	{
		$phone = $request->input('phone');
		$password = $request->input('password');
		$passwordConfirm = $request->input('password2');

		if(empty($phone)){
			return redirect()->back()->withInput($request->input())->with('fail', '手机号不能为空');
		}

		$exists = \App\Member::where('phone',$phone)->get();
		if(!$exists->isEmpty()){
			return redirect()->back()->withInput($request->input())->with('fail', '手机号已注册');
		}
		
		if(empty($password)){
			return redirect()->back()->withInput($request->input())->with('fail', '密码不能为空');
		}

		if($password != $passwordConfirm){
			return redirect()->back()->withInput($request->input())->with('fail', '两次密码不一致');
		}


		try{
			$memberModel = new \App\Member;
			$memberModel->phone = e($phone);
			$memberModel->password = md5(trim($password));
			if(!$memberModel->save()){
				throw new Exception("注册失败,请联系管理员", 100110);
			}
			return redirect()->to(site_path('user/login', 'web'))->with('message', '注册成功');
		}catch(Exception $e){
			return redirect()->back()->withInput($request->input())->with('fail', $e->getMessage());
		}	
	}
    
    //登录
	public function login(Request $request)
	{	
		return view('desktop.login');
	}

	//执行登录
	public function dologin(Request $request)
	{
		$redirectTo = '/';
		//会员登录认证凭证
        $credentials = [
            'phone'  => '18682317653',//$request->input('phone'),
            'password'  => 'admin',//$request->input('password'),
            'is_locked' => 0,
        ];
        $flag = Auth::guard('member')->attempt($credentials, $request->has('remember'));
        if ($flag) {
            //event(new UserLogin(auth()->user()));  //触发登录事件
            return redirect()->intended($redirectTo);
        } else {
            // 登录失败，跳回
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['attempt' => '“用户名”、“密码”错误或帐号已被锁定，请重新登录或联系超管！']);  //回传错误信息
        }
	}
	
	//退出
	public function logout(){
		
		//@event(new UserLogout(auth()->user()));  //触发登出事件
		Auth::guard('member')->logout();
		return redirect()->intended('/');
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