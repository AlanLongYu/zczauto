<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>首页-精准资料网 | 天下没有难修的汽车</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="@section('description') {{ isset($description) ? $description : '精准资料网专注于个人收集汽车资料学习交流，本站有上千款车型精准资料在线查询、打印和下载，每日更新，汽车爱好者学习交流必备神器！' }} @show{{-- meta描述 --}}" />
    <meta name="keywords" content="汽车资料学习,汽车维修技术探讨,汽车资料下载,汽车爱好者学习资料查询{{ cache('website_keywords') }}" />
    <meta name="author" content="{{ cache('system_author_website', 'http://www.zczauto.com/') }}" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="{{ _asset('assets/css/main.css') }}" />
	<script type="text/javascript" src="{{ _asset('assets/js/jquery-1.8.1.min.js') }}"></script>
    @section('htmlHead')
    @show{{-- head区域 --}}
</head>
<body class="paper">



        <div id="header">
	<div class="w-1000 relative">
		<!--logo-->
		<a href="http://www.zczauto.com/" class="logo">
			<img src="{{ _asset('assets/images/logo.png') }}" height="40" width="109">
			<img src="{{ _asset('assets/images/logo.png') }}" style="display:none;"/>
		</a>

		<!--nav-->
		<nav>
			<ul class="header-nav">
				
				@foreach($navs AS $nav)
					@if($nav->p_id == 0)
						<li>
							<a href="{{$nav->url}}" class="current">{{$nav->name}}</a>
							@if(in_array($nav->id,[2,5,9]))
								<i class="arrow-icon"></i>
								<div class="submenu">
									@foreach($navs AS $secondNav)
										@if($secondNav->p_id == $nav->id)
											<a href="{{$secondNav -> url}}"><i class="wxsck-icon"></i>{{$secondNav->name}}<span></span></a>		
										@endif
									@endforeach
								</div>
							@endif
						</li>
					@endif
				@endforeach
			</ul>
		</nav>
		<!--nav end-->
		<script type="text/javascript">
			$(document).ready(function(){
				$(".hoverwx").hover(
						function(){
							$(".wximg").show();	
						}
					,function(){
						$(".wximg").hide();	
					}	
				);
			});
			
		</script>
		<!--login-->
		<div class="icon-box">
			
			@if(Auth::guard('member')->check())
			<span class="login-icon relative loginlist" id="login-icon">
				<dl class="submenu">
					<dd>
					</dd>
					<dd>
						<a href="/user/user_info"><i class="grzl-icon"></i>个人资料</a>
					</dd>
					<dd>
<!--						<a href="/user/user_vip"><i class="wdvip-icon"></i>我的VIP</a>-->
					</dd>
					<dd>
						<!--<a href="/user/order"><i class="wddd-icon"></i>我的订单</a>-->
					</dd>
										<dd>
						<a href="/user/logout"><i class="tcdl-icon"></i>退出登录</a>
					</dd>				</dl>
			</span>
			@else
				<a href="/user/register" class="reg-btn">注册</a>
						&nbsp;|&nbsp;
				<a href="/user/login" class="login-btn">登录</a>
			@endif

		</div>
		<!--login-->
		
		
	</div>
</div>
        
        @section('mainContent')
        @show{{-- 主体内容 --}}


        <div id="footer">
			<div class="info-block">
				<div class="info" style="background-color:black;padding:0 auto;color:#fff;">
					<dl>
						<dt><a target="_blank" href="/help/about">关于我们</a></dt>
					</dl>

					<dl>
						<dt><a target="_blank" href="/help/start">网站帮助</a></dt>
					</dl>

					<dl>
						<dt><a target="_blank" href="/help/disclaimer">免责声明</a></dt>
					</dl>
					<dl>
						<dt><a target="_blank" href="/help/joinus">加入我们</a></dt>
					</dl>
					<dl>
						<dt><a target="_blank" href="/help/contact">联系我们</a></dt>
					</dl>

					<div class="down">
						<div class="downCon down-ios">
							<img src="{{ _asset('assets/images/wxgzh.jpg') }}" class="twoCode">微信公众号
						</div>
					</div>
					<div class="csc">
						<a href="#" id="back-to-top" title="回到顶部"><img src="{{_asset('assets/images/csc-top.png') }}"/></a>
						<a target="_blank"  title="点击QQ咨询:1824839790" href="http://wpa.qq.com/msgrd?v=3&uin=1824839790&site=qq&menu=yes">
							<img src="{{_asset('assets/images/fdsa2312safadsowq.gif')}}" />
						</a>

						<a href="#" class="csc-wx relative" title="扫码微信咨询交流:zczauto">
						<img class="hoverwx" src="{{ _asset('assets/images/csc-wx.png') }}"/>
						<img src="{{ _asset('assets/images/csc-wx-code.png') }}" alt="扫描加微信" class="wximg csc-wx-code"/>
						</a>
					</div>
				</div>

			</div>
			<div class="copyright">
				<span>Copyright © 2017-2020&nbsp;<strong><a href="http://www.zczauto.com/" target="_blank">zczauto.com</a></strong> All Rights Reversed. </span>粤ICP备xxx号-x号   Version:1.1.0
			</div>
		</div>

@section('afterFooter')
@show{{-- 页脚区域 --}}
</body>
</html>
