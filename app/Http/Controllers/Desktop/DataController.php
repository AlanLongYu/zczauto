<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Article;
use Douyasi\Models\Category;
use Douyasi\Models\Ziliao;

class DataController extends FrontController
{
	
	//VIP购买
	public function data()
	{
		$categories = Category::orderBy('sort','desc')->get();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);
		return view('desktop.data',['categories' =>$tree]);
	}



    //汽车详情
    public function carDetail($catid)
    {
        $cate = Category::where('id',$catid)->get();
        $items = [];
        foreach($cate->toArray() AS $k => $v){
            $items[$v['id']] = $v;
        }
        
        $categories = Category::orderBy('sort','desc')->get();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        foreach($cate AS $vv){
            $parentArr = $items[$vv->p_id];
            $ppArr = $items[$parentArr['p_id']];
        }

        $tree =  Category::generateTree($items);

        $ziliao = Ziliao::where('category_id',$catid)->paginate(15);
        $breadcrumb = $ppArr['name'].'>'.$parentArr['name'].'>'.$items[$catid]['name'];
        return view('desktop.ziliaolist',['ziliao' => $ziliao,'categories' =>$tree,'breadcrumb' => $breadcrumb]);
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
        $fileDir = $base_dir.$afterFix;
        $ziliao = Ziliao::where('id',$id)->get();
        
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
        }
        //echo url('uploads/ziliao').'/'.$afterFix;exit;
        // print_r($xxx);//exit;
        

        return view('desktop.ziliaodetail',['base_path' => url('uploads/ziliao'),'ziliao' => $ziliao,'categories' =>$tree,'breadcrumb' => $breadcrumb,'files'=>$xxx,'afterFix' =>$afterFix]);
    }
	

    public function document(Request $request)
    {
        $file = url('/uploads/ziliao').'/';
        $folder = $request->folder;
        $file_name =  $request->file;
        if(!empty($folder)){
            $file .= $folder.'/'.$file_name;
        }else{
            $file .=$file_name; 
        }
        // echo $file;
        return view('desktop.document',['file' => $file]);
        // return view('desktop.viewer',['file' => $file]);
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
            $f = iconv("GBK","UTF-8",$f);
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
