<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 导航模型
 */
class Car extends Model
{
    protected $table = 'carmodel';

    protected $primaryKey = 'id';
 
	 public static function generateTree($items){
	    $tree = array();
	    foreach($items as $item){
	    	$items[$item['id']]['pid'] = $item['p_id'];
	        if(isset($items[$item['p_id']])){
	            $items[$item['p_id']]['children'][] = &$items[$item['id']];
	        }else{
	            $tree[] = &$items[$item['id']];
	        }
	    }
	    return $tree;
	}
}
