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
        $tree =  Category::generateTree($items);

        $ziliao = Ziliao::where('category_id',$catid)->paginate(15);

        return view('desktop.ziliaolist',['ziliao' => $ziliao,'categories' =>$tree]);
    }

    //最终线路图详情文章
    public function Detail(Request $data_id)
    {
        $id = $data_id->data_id;
        $ziliao = Ziliao::where('id',$id)->get();
        
        $categories = Category::orderBy('sort','desc')->get();
        $items = [];
        foreach($categories->toArray() AS $key => $val){
            $items[$val['id']] = $val;
        }
        $tree =  Category::generateTree($items);

       //$ziliao = Ziliao::where('category_id',$id)->paginate(15);

        return view('desktop.ziliaodetail',['ziliao' => $ziliao,'categories' =>$tree]);
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
