<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::get('/', function () {
    return url('/');
});
/*-----
文档站点路由群组 START
-----*/
Route::group(['prefix' => config('site.route.prefix.doc', 'docs'), 'middleware' => ['block:doc', 'web']], function () {

    Route::get('index', function() {
        return redirect(config('site.route.prefix.doc', 'docs').'/readme.md');
    });
    Route::get('{path}.md', 'MarkdownController@getMarkdownDoc')->where('path', '[A-Za-z0-9_/\-]+');

});
/*-----
文档站点路由群组 END
-----*/


/*-----
API站点路由群组 START
-----*/
$_mp = config('site.route.prefix.api', 'api');
Route::group(['prefix' => $_mp, 'namespace' => 'API', 'middleware' => ['block:api', 'web']], function () {

    Route::get('/', 'HomeController@getIndex');

    //IP查询服务
    Route::get('ip', 'HomeController@getIP');

    //身份证查询服务
    Route::get('identity-card', 'HomeController@getIdentityCard');

    //汉字转拼音
    Route::get('pinyin', 'HomeController@getPinyin');
});
/*-----
API站点路由群组 END
-----*/


/*-----
管理后台站点路由群组 START
-----*/
$_ap = config('site.route.prefix.admin', 'admin');
Route::group(['prefix' => $_ap, 'namespace' => 'Admin', 'middleware' => ['block:admin', 'web']], function () {

    Route::get('/', function() {
        return redirect(config('site.route.prefix.admin', 'admin').'/auth/login');
    });

    Route::group(['prefix' => 'auth'], function () {
        $Authority = 'AuthorityController@';
        # 退出
        Route::get('logout', $Authority.'getLogout');
        # 登录
        Route::get('login', $Authority.'getLogin');
        Route::post('login', $Authority.'postLogin');
    });



    Route::group(['prefix' => '', 'middleware' => ['multi-site.auth:admin']], function () {
        #multi-site.auth \App\Http\Middleware\MultiSiteAuthenticate::class

        Route::get('dashboard', 'DashboardController@getIndex');

        //重建缓存
        Route::get('cache', 'AssistantController@getRebuildCache');

        //开发演示
        Route::get('demo/form', 'DemoController@getForm');
        Route::get('demo/icon', 'DemoController@getIcon');

        //文件上传
        Route::get('upload/picture', 'AssistantController@getUploadPicture');
        Route::get('upload/document', 'AssistantController@getUploadDocument');
        Route::post('upload/picture', 'AssistantController@postUploadPicture');
        Route::post('upload/document', 'AssistantController@postUploadDocument');

            /*
             * ----------------------------------------
             * 自定义二次开发区域 START
             * ----------------------------------------
             */

             #资料管理
            Route::resource('ziliao', 'ZiliaoController');
            Route::resource('carowner', 'CarownerController');
            Route::resource('soft', 'SoftController');



            //内容管理
            #导航
            Route::resource('nav', 'NavController');
            #分类
            Route::resource('category', 'CategoryController');
            #文章
            Route::resource('article', 'ArticleController');
            Route::resource('softarticle', 'SoftArticleController');
            #图链
            Route::resource('picture', 'PictureController');

            //自定义模型管理
            
            /*
             * ----------------------------------------
             * 自定义二次开发区域 END
             * ----------------------------------------
             */
        //会员管理
        //Route::get('member', 'MemberController@index');
        Route::post('member', 'MeController@getMe');

        Route::resource('member','MemberController');

        //用户管理
        Route::get('me', 'MeController@getMe');
        Route::put('me', 'MeController@putMe');

        Route::resource('user', 'UserController');
        Route::get('user/purview/{rid}', 'UserController@getPurview');
        Route::resource('role', 'RoleController');
        Route::resource('permission', 'PermissionController');

        //系统管理
        Route::get('option', 'OptionController@getOption');
        Route::put('option', 'OptionController@putOption');
        Route::resource('log', 'LogController');
    });

});
/*-----
管理后台站点路由群组 END
-----*/


/*-----
桌面站点路由群组 START
-----*/
$_dp = config('site.route.prefix.desktop', '');
Route::group(['prefix' => $_dp, 'namespace' => 'Desktop', 'middleware' => ['block:desktop', 'web']], function () {
    //桌面站主页
    Route::get('/', 'HomeController@getIndex');
    
    //设置语言版本
    Route::get('lang', 'HomeController@getLang');

    # 展示分类
    Route::get('{category}', 'HomeController@getCategory');

    # 展示文章
    Route::get('{category}/{article}.html', 'HomeController@getArticle');
	
	
	
    //Route::get('/data/document?file={file_path}','DataController@document');
	
	#维修软件库
    Route::get('/soft/index', 'SoftController@soft_index');
    Route::get('/soft/detail/{id}', 'SoftController@detail');
	
	#VIP购买
    Route::get('/vip/vip_index', 'VipController@vip_index');
	
	
	#帮助页面
    Route::get('/help/about', 'HelpController@about');
	
	#维修手册库
    Route::get('/help/start', 'HelpController@start');
	
	#维修软件库
    Route::get('/help/softdown', 'HelpController@softdown');
	
	#帮助-VIP购买
    Route::get('/help/member', 'HelpController@vip');
	
	#加入我们
    Route::get('/help/joinus', 'HelpController@joinus');
	
	#联系我们
    Route::get('/help/contact', 'HelpController@contact');
    
    #注册
    Route::get('/user/register', 'UserController@register');
	Route::post('/user/register', 'UserController@doregister');
    
    #注册
	Route::get('/user/login', 'UserController@login');

    # 登录处理函数
    Route::post('/user/login', 'UserController@dologin');

    # 退出逻辑
    Route::get('/user/logout', 'UserController@logout');
    
    #需要登录验证的路由组
    Route::group(['prefix' => 'user', 'middleware' => ['multi-site.auth:desktop']],function(){
        //Route::auth();
         #会员中心
        Route::get('user_info', 'UserController@info');
        #会员中心-我的VIP
        Route::get('user_vip', 'UserController@vip');
        
        #会员中心-我的订单
        Route::get('order', 'UserController@order');

        #会员中心-我的VIP
        Route::get('book', 'BookController@index');
    });


    #需要登录验证的其他路由组
    Route::group(['middleware' => ['multi-site.auth:desktop']],function(){
        //Route::auth();
        #维修手册库
        Route::get('/data/data', 'DataController@data');
        Route::post('/data/detail', 'DataController@detail');
        Route::get('/data/cardetail/{catid}', 'DataController@carDetail');

        Route::get('/data/document/{folder?}/{file}','DataController@document');
        Route::get('/data/document/{file}','DataController@document')->where('file', '.*$');

        #汽车书籍
        Route::get('/book/index', 'BookController@index');
        Route::get('/book/info/{file}','BookController@detail')->where('file', '.*$');

    });
	

});
/*-----
桌面站点路由群组 END
-----*/