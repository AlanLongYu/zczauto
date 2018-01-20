<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MeRequest;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use Douyasi\Cache\DataCache;
use Gate;

/**
 * 系统配置控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class NewsController extends BackController
{
    /**
     * The NewsRepository instance.
     *
     * @var App\Repositories\NewsRepository
     */
    protected $news;

    public function __construct(NewsRepository $news)
    {
        parent::__construct();
        $this->news = $news;
    }

    public function getNews()
    {
        $data = $this->news->getAllnews()[0];
        return view('admin.back.news.index', compact('data'));
    }


    public function putNews(Request $request)
    {
        $data = $request->all();
        if (isset($data) && is_array($data)) {
            $this->news->updateNews($data);
            //更新系统静态缓存
            DataCache::cacheStatic();
            return redirect()->back()->with('message', '成功更新新闻公告！');
        } else {
            return redirect()->back()->with('fail', '提交过来的数据异常！');
        }
    }
}
