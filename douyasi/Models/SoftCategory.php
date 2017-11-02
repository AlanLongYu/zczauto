<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

class SoftCategory extends Model
{
    //
    protected $table = 'soft_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'name',
                            'sort',
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
