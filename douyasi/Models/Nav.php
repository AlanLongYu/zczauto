<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 导航模型
 */
class Nav extends Model
{
    protected $table = 'navs';

    protected $primaryKey = 'id';
 
	 public static function generateTree($items){
	    $tree = array();
	    foreach($items as $item){
	        if(isset($items[$item['p_id']])){
	            $items[$item['p_id']]['son'][] = &$items[$item['id']];
	        }else{
	            $tree[] = &$items[$item['id']];
	        }
	    }
	    return $tree;
	}
}
