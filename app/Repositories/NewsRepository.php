<?php

namespace App\Repositories;
/**
 * 新闻相关仓库NewsRepository
 * [包括对系统配置与系统日志模型操作]
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
use App\News;
class NewsRepository extends BaseRepository
{

    /**
     * The SystemOption instance.
     *
     * @var App\SystemOption
     */
    protected $option;

    /**
     * Create a new RolePermissionRepository instance.
     *
     * @param  App\SystemLog $log
     * @param  App\SystemOption $option
     * @return void
     */
    public function __construct(
        News $news)
    {
        $this->news = $news;
    }

    /**
     * 获取所有新闻
     *
     * @return Illuminate\Support\Collection
     */
    public function getAllnews()
    {
        $news = $this->news->all();
        return $news;
    }

    public function index($data, $extra, $size){

    }

    /**
     * 更新新闻
     *
     * @param  array $data
     * @return void
     */
    public function updateNews($data)
    {
        $news = $this->news->find(1);
        return $news->update(['title' => $data['title'],'content' => e($data['content'])]);
    }

    #********
    #* 空写未使用的接口函数update与edit START
    #********
    public function edit($id = 0, $extra = '') {
        return;
    }
    public function update($id = 0, $inputs = [], $extra = '') {
        return;
    }
    public function store($inputs = [], $extra = '') {
        return;
    }
    #********
    #* 空写未使用的接口函数update与edit END
    #********

}
