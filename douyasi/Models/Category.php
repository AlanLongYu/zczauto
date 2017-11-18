<?php

	namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 分类模型
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
    						'id',
                            'name',
                            'sort',
                            'p_id',
                            'slug',
                        ];
 
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
