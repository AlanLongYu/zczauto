<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;
use Douyasi\Models\Nav;
use Douyasi\Models\Ziliao;

class DataController extends FrontController
{
	
	//VIP购买
	public function data($catId)
	{   
        if(empty($catId)){
            echo 'alert("对不起，参数错误")';
            return ;
        }
		$categories = Category::where(['nav_id' => $catId]) ->orderBy('sort','desc')->get();
        $nav = Nav::find(['id',$catId]);
        foreach ($nav as  $n) {
            $currentName = $n->name;
        }
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);
		return view('desktop.data',['categories' =>$tree,'navId' => $catId,'currentName' => $currentName]);
	}



    //汽车详情
    public function carDetail($catid,$navId)
    {
        $cate = Category::where('nav_id',$navId)->get();
        $items = [];
        foreach($cate->toArray() AS $k => $v){
            $items[$v['id']] = $v;
        }
        // print_R($items);exit;
        //$categories = Category::orderBy('sort','desc')->get();
        /*$items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }*/
        $nav = Nav::find(['id',$navId]);
        foreach ($nav as  $n) {
            $currentName = $n->name;
        }
        $cate2 = Category::where('nav_id',$navId)->where('id',$catid)->get();

         foreach($cate2 AS $vv){
                 $parentArr = $items[$vv->p_id];
                 $ppArr = $items[$parentArr['p_id']];
         }

        $tree =  Category::generateTree($items);
// print_r($cate2);exit;
        $ziliao = Ziliao::where('category_id',$catid)->where('nav_id',$navId)->paginate(15);
        $breadcrumb = $ppArr['name'].'>'.$parentArr['name'].'>'.$items[$catid]['name'];
        return view('desktop.ziliaolist',['currentName' => $currentName,'navId' => $navId,'ziliao' => $ziliao,'categories' =>$tree,'breadcrumb' => $breadcrumb]);
    }

    //最终线路图详情文章
    public function Detail(Request $data)
    {   
        //获取上传的资料目录
        // $base_dir = str_replace('\\','/',public_path('uploads')).'/ziliao/';
        $base_dir = public_path('uploads').'/ziliao/';
        $id = $data->data_id;
        $breadcrumb = $data->breadcrumb;
        $tmpArr = explode('>',$breadcrumb);
        $afterFix = join('/',$tmpArr);
        $ziliao = Ziliao::where('id',$id)->get();
        foreach ($ziliao as $z) {
            $navId = $z->nav_id;
        }
        $navfix = $navId ? $navId.'/' : '';
        $fileDir = $base_dir.$navfix.$afterFix;
        $categories = Category::orderBy('sort','desc')->get();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);
        //foreach()
        //print_r($tree);exit;
        
        $filess = self::recurDir($fileDir);
        $lastFileTree = self::beautifulTree($filess);
        $xxx = [];
        //if(!empty($filess))
            //$arr = self::arr_foreach ($filess);
        //print_r($arr);exit;
        // foreach($filess AS $kkk => $vvv){
        //     if(is_array($vvv)){
        //         foreach ($vvv as $kkkk => $vvvv) {
        //             $tmp_key = substr($kkk,strrpos($kkk,'/')+1);
        //              // $xxx[$tmp_key][$kkkk]['name'] = substr($vvvv,strrpos($vvvv,'/')+1,-4);
        //               $xxx[$tmp_key][$kkkk] = substr($vvvv,strrpos($vvvv,'/')+1,-4);
        //              //$xxx[$tmp_key][$kkkk]['url'] = url('uploads/ziliao').'/'.$tmp_key.'/'.$afterFix.'/'.$xxx[$tmp_key][$kkkk]['name'].'.pdf';
        //         }
        //     }else{
        //         $xxx[$kkk] = substr($vvv,strrpos($vvv,'/')+1,-4);
        //         // $xxx[$kkk]['name'] = substr($vvv,strrpos($vvv,'/')+1,-4);
        //         //$xxx[$kkk]['url'] = url('uploads/ziliao').'/'.$afterFix.'/'.$xxx[$kkk]['name'].'.pdf';
        //     }
        // }
        //echo url('uploads/ziliao').'/'.$afterFix;exit;
        // print_r($xxx);//exit;
        

        return view('desktop.ziliaodetail',['base_path' => url('uploads/ziliao'),'navId' => $navId,'ziliao' => $ziliao,'categories' =>$tree,'breadcrumb' => $breadcrumb,'files'=>$filess,'afterFix' =>$afterFix]);
    }
	

    public static function arr_foreach($arr){
        if(!is_array($arr)){
            return [];
        }
        foreach ($arr as $key => $val ){
            $tmpArr = explode('/',$key);
            $firstPath = $tmpArr[count($tmpArr) -1];
            if(is_array($val)){
                $tmp_key = substr($key,strrpos($key,'/')+1);
                $xxx[$tmp_key][$key] = substr($val,strrpos($val,'/')+1,-4);
                self::arr_foreach ($val);
            }else{
                $xxx[$key] = substr($val,strrpos($val,'/')+1,-4);
            }
        }

        return $xxx;

    }

    public function document(Request $request)
    {   
        $navFix = !empty($request->navId) ? e(trim($request->navId)).'/' : '';
        $file = url('/uploads/ziliao').'/'.$navFix;
        // echo $file;exit;
        $folder = str_replace('//','/',$request->folder);
        $file_name =  explode('&',$request->file)[0];
        if(!empty($folder)){
            $file .= $folder.'/'.$file_name;
        }else{
            $file .=$file_name; 
        }
        //$file = str_replace('//','/',$file);
        //echo $file;exit;
        return view('desktop.document',['file' => $file]);
        // return view('desktop.viewer',['file' => $file]);
    }

    public function file(Request $request)
    {
        $navFix = !empty($request->navId) ? e(trim($request->navId)).'/' : '';
        $file = url('/uploads/ziliao').'/'.$navFix;
        //echo $file;exit;
        $folder = str_replace('//','/',$request->folder);
        $file_name =  explode('&',$request->file)[0];
        if(!empty($folder)){
            $file .= $folder.'/'.$file_name;
        }else{
            $file .=$file_name; 
        }
        return view('desktop.document',['file' => $file]);
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
    if(!empty($arr))
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
