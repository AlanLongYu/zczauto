<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;
use App\Events\UserLogin;
use App\Events\UserLogout;

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
		$userInfo = Auth::guard('member')->user();
		// print_r($userInfo);exit;
		return view('desktop.user_info',['userInfo' => $userInfo]);
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

	public function checkReg(Request $request){
		$phone = $request->input('phone');
		$exists = \App\Member::where('phone',$phone)->get();
		$res = ['data' => $exists->isEmpty()];
		return response()->json($res);
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
			return redirect()->back()->withInput($request->input())->with('fail', '手机号
				已注册');
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
			$memberModel->password = bcrypt(trim($password));
			if(!$memberModel->save()){
				throw new Exception("注册失败,请联系管理员", 100110);
			}
			return redirect()->to(site_path('user/login', 'web'))->with('message', '注册成功');
		}catch(Exception $e){
			return redirect()->back()->withInput($request->input())->with('fail', $e->getMessage());
		}	
	}

	//注册处理
	public function registerajax(Request $request)
	{
		$phone = $request->input('phone');
		$password = $request->input('password');
		$exists = \App\Member::where('phone',$phone)->get();
		if(!$exists->isEmpty()){
			throw new Exception("注册失败,手机号已经注册", 100110);
		}
		
		if(empty($password)){
			throw new Exception("注册失败,密码不能为空", 100110);
		}

		try{
			$memberModel = new \App\Member;
			$memberModel->phone = e($phone);
			$memberModel->password = bcrypt(trim($password));
			if(!$memberModel->save()){
				throw new Exception("注册失败,请联系管理员", 100110);
			}
			return response()->json(['code' => 200200,'msg' => '注册成功！']);
		}catch(Exception $e){
			return response()->json(['code' => $e->getCode(),'msg' => $e->getMessage()]);
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
            'phone'  => e($request->input('username')),
            'password'  => e($request->input('password')),
            'is_locked' => 0,
        ];
        $flag = Auth::guard('member')->attempt($credentials, $request->has('remember'));
        if ($flag) {
            event(new UserLogin(Auth::guard('member')->user()));  //触发登录事件
            return redirect()->intended($redirectTo);
        } else {
            // 登录失败，跳回
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['attempt' => '“用户名”、“密码”错误或帐号已被锁定，请重新登录或联系超管！']);  //回传错误信息
        }
	}

	public function loginAjax(request $request)
	{
		//会员登录认证凭证
        $credentials = [
            'phone'  => e($request->input('username')),
            'password'  => e($request->input('password')),
            'is_locked' => 0,
        ];
        $flag = Auth::guard('member')->attempt($credentials, $request->has('remember'));
        if ($flag) {
            event(new UserLogin(Auth::guard('member')->user()));  //触发登录事件
            return response()->json(['code' => 20200,'msg' => '登录成功']);
        }else{
        	return response()->json(['code' => 20120,'msg' => '“用户名”、“密码”错误或帐号已被锁定']);
        }
	}
	
	//退出
	public function logout(){
		if(Auth::check()){ 
            Auth::logout();
        }
		@event(new UserLogout(Auth::guard('member')->user()));  //触发登出事件
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
