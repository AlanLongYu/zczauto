<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
* 
*/
class ViewServiceProvider extends ServiceProvider
{
	
	function __construct()
	{
		# code...
	}


	/**
     * 在容器中注册绑定.
     *
     * @return void
     * @author http://laravelacademy.org
     */
    public function boot()
    {
    	
        // 使用基于类的composers...
        View::composer(
            '*', 'App\Http\ViewComposers\NavComposer'
        );

    }

    /**
     * 注册服务提供者.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}