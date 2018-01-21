<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;
use Douyasi\Models\Ziliao;
use App\Events\UserLogin;
use App\Events\UserLogout;

class BookController extends FrontController
{
	
    /**
     * 添加路由过滤中间件
     */
    public function __construct()
    {
        // $this->middleware('multi-site.guest:desktop', ['except' => ['index','info','vip','order']]);
    }
    
	//汽车书籍
	public function index(Request $data)
	{
        
		 //获取上传的资料目录
        // $base_dir = str_replace('\\','/',public_path('uploads')).'/ziliao/';
        $base_dir = public_path('uploads').'/book/';
        $breadcrumb = '其他资料';
        $fileDir = $base_dir;
        $categories =[];
        $items = [];
        
        $tree =  [];
        
        $filess = self::recurDir($fileDir);
        $lastFileTree = self::beautifulTree($filess);
        /*$xxx = [];
        if(!empty($filess))
        foreach($filess AS $kkk => $vvv){
            if(is_array($vvv)){
                foreach ($vvv as $kkkk => $vvvv) {
                    $tmp_key = substr($kkk,strrpos($kkk,'/')+1);
                     // $xxx[$tmp_key][$kkkk]['name'] = substr($vvvv,strrpos($vvvv,'/')+1,-4);
                      $xxx[$tmp_key][$kkkk] = substr($vvvv,strrpos($vvvv,'/')+1,-4);
                     //$xxx[$tmp_key][$kkkk]['url'] = url('uploads/ziliao').'/'.$tmp_key.'/'.$afterFix.'/'.$xxx[$tmp_key][$kkkk]['name'].'.pdf';
                }
            }else{
                $xxx[$kkk] = substr($vvv,strrpos($vvv,'/')+1,-4);
                // $xxx[$kkk]['name'] = substr($vvv,strrpos($vvv,'/')+1,-4);
                //$xxx[$kkk]['url'] = url('uploads/ziliao').'/'.$afterFix.'/'.$xxx[$kkk]['name'].'.pdf';
            }
        }*/
        //echo url('uploads/ziliao').'/'.$afterFix;exit;
        // print_r($xxx);//exit;
        

        return view('desktop.book',['base_path' => url('uploads/book'),'ziliao' => [],'categories' =>$tree,'breadcrumb' => $breadcrumb,'files'=>$filess,'afterFix' =>'','login'=>Auth::guard('member')->check()]);
	}
	
	
	//我的VIP
	public function detail(Request $request)
	{
		
		
        $file =  $request->file;
        return view('desktop.document',['file' => $file]);
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



    public static function recurDir($pathName)
{
    $pathName = strtoupper(substr(PHP_OS,0,3))==='WIN' ? iconv("UTF-8","GBK",$pathName) : $pathName;
    //将结果保存在result变量中
    $result = array();
    $temp = array();
    //判断传入的变量是否是目录
    if(!is_dir($pathName) || !is_readable($pathName)) {
        return null;
    }
    //取出目录中的文件和子目录名,使用scandir函数
    $allFiles = scandir($pathName);
    //遍历他们
    foreach($allFiles as $fileName) {
        //判断是否是.和..因为这两个东西神马也不是。。。
        if(in_array($fileName, array('.', '..'))) {
            continue;
        }
        //路径加文件名
        $fullName = $pathName.'/'.$fileName;
        //如果是目录的话就继续遍历这个目录
        
        if(is_dir($fullName)) {
            //将这个目录中的文件信息存入到数组中
            $fullName = strtoupper(substr(PHP_OS,0,3))==='WIN' ? iconv("GBK","UTF-8",$fullName) : $fullName;
             $result[$fullName] = self::recurDir($fullName);
            // $result[iconv("GBK","UTF-8",$fullName)] = self::recurDir(iconv("GBK","UTF-8",$fullName));
            //$result[$fullName] = recurDir($fullName);
        }else {
            //如果是文件就先存入临时变量
            $temp[] = $fullName;
        }
    }
    //取出文件
    if($temp) {
        foreach($temp as $f) {
            $f = strtoupper(substr(PHP_OS,0,3))==='WIN' ? iconv("GBK","UTF-8",$f) : $f;
            $result[] = $f;
        }
    }
    return $result;
}


public static function beautifulTree($arr, $l = '-|')
{
    static $l = '';
    static $str = '';
    //遍历刚才得到的目录树
    if(empty($arr)) return '';
    foreach($arr as $key=>$val) {
        //如果是个数组，也就代表它是个目录，那么就在它的子文件中加入-|来表示是下一级吧
        if(is_array($arr[$key])) {
            $str.=$l.$key."<br/>";
            $l.='-|';
            self::beautifulTree($arr[$key], $l);
        }else {
            $str.=$l.$val."<br/>";
        }
    }
    $l = '';
    return $str;
}

}
