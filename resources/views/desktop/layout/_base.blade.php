<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>首页-精准资料网 | 用车养车修车的好帮手</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="@section('description') {{ isset($description) ? $description : '精准资料网专注于提供汽车维修资料学习和讨论交流，本站有上千款车型维修手册及电路图在线查询、打印和下载，每日更新，汽车爱好者的必备神器！' }} @show{{-- meta描述 --}}" />
    <meta name="keywords" content="精准资料网,精准资料,汽车维修,汽车维修论坛,汽车维修资料免费下载,汽修资料,汽车维修手册,汽车电路图,{{ cache('website_keywords') }}" />
    <meta name="author" content="{{ cache('system_author_website', 'http://www.zczauto.com/') }}" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{ _asset('assets/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ _asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ _asset('assets/css/icomoon_style.css') }}" />
    <link rel="stylesheet" href="{{ _asset('assets/css/markdown_style.css') }}" />
    @section('htmlHead')
    @show{{-- head区域 --}}
</head>
<body class="paper">


<div id="con_wrapper">
    <div id="r_con">
        <div class="header">
            <a href="/"><h1>芽丝轻博客</h1></a>
        </div>
        
        @section('mainContent')
        @show{{-- 主体内容 --}}


        <div class="footer">
            <p class="slogan">designed &amp; developed by <a href="https://raoyc.com">raoyc</a>  设计崇简</p>
            <p>&copy; 2016 <a href="/">芽丝轻博客</a> 版权所有 -  <a href="http://www.miibeian.gov.cn/">{{ cache('website_icp', '鄂ICP备15014910号-3') }}</a></p>
        </div>
    </div>
</div>

@section('afterFooter')
@show{{-- 页脚区域 --}}
</body>
</html>
