<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 新闻模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class News extends Model
{

    protected $table = 'news';
    
    protected $fillable = ['id', 'title','content'];

}
