<?php

namespace App\Http\Controllers\Admin;



/**
 * 快捷控制面板
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class DashboardController extends BackController
{

    public function getIndex()
    {	
		$res = [
			'order_num'  => 300,
			'reg_num'	 => 500,
			'soft_num'	 => 200,
			'active_num'	 => 499,
			];
        return view('admin.back.dashboard.index',$res);
    }

}
