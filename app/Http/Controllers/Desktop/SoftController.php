<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\SoftArticle;
use Douyasi\Models\SoftCategory;

class SoftController extends FrontController
{
	
	//维修软件库
	public function soft_index(Request $request)
	{
		$s_title = $request->input('s_title');
        $s_cid = $request->input('s_cid');

        $categories = SoftCategory::orderby('sort','asc')->get();
        $articles = SoftArticle::where('title', 'like', '%'.$s_title.'%')
                            ->where('cid', (($s_cid > 0) ? '=' : '<>'), $s_cid)
                            ->orderBy('created_at','desc')
                            ->paginate(15);

        $flags = config('ecms.flag.articles');
        $catArr = [];
        foreach($categories AS $k => $v){
            $catArr[$v->id] = $v->name;
        }
		return view('desktop.soft_index',compact('categories', 'articles', 'flags','s_cid','catArr'));
	}


    //维修详情页面
    public function detail(Request $request)
    {
        $id = e($request ->id);
        $categories = SoftCategory::orderby('sort','asc')->get();
        $articles = SoftArticle::where('id', $id)->first();

        $flags = config('ecms.flag.articles');
        $catArr = [];
        foreach($categories AS $k => $v){
            $catArr[$v->id] = $v->name;
        }
        // print_r($articles);exit;
        return view('desktop.soft_detail',compact('categories', 'articles', 'flags','s_cid','catArr'));
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
