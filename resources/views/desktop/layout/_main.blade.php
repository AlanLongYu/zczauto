<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>首页-ZCZ汽车网 | 天下没有难修的汽车</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="@section('description') {{ isset($description) ? $description : 'ZCZ汽修网专注于提供汽车维修资料，本站有上千款车型维修手册及电路图在线查询、打印和下载，每日更新，汽车维修企业必备神器！' }} @show{{-- meta描述 --}}" />
    <meta name="keywords" content="汽车维修资料,汽车维修技术,汽车维修论坛,汽车论坛,汽车维修资料免费下载,汽修资料,汽车维修手册,汽车电路图,{{ cache('website_keywords') }}" />
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
			<img src="{{ _asset('assets/images/logo.gif') }}" height="40" width="109">
			<img src="{{ _asset('assets/images/logo.gif') }}" style="display:none;"/>
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
	
				<!--<li><a href="/" class="current">首页</a></li>
				<li class="ziliao-search">资料查询<i class="arrow-icon"></i>
					<div class="submenu">
						<a href="/data/data"><i class="wxsck-icon"></i>维修手册库<span>1500+</span></a>		
						<a href="/soft/index"><i class="wxrjk-icon"></i>维修软件库<span>15+</span></a>
					</div>
				</li>

				<li class="weixiu-search">维修项目<i class="arrow-icon"></i>
					<div class="submenu">
						<a href="/data/data"><i class="wxsck-icon"></i>维修手册库<span>1500+</span></a>		
						<a href="/soft/index"><i class="wxrjk-icon"></i>维修软件库<span>15+</span></a>
					</div>
				</li>

				<li class="baoyang-search">保养项目<i class="arrow-icon"></i>
					<div class="submenu">
						<a href="/data/data"><i class="wxsck-icon"></i>维修手册库<span>1500+</span></a>		
						<a href="/soft/index"><i class="wxrjk-icon"></i>维修软件库<span>15+</span></a>
					</div>
				</li>				
				<!--<li><a href="/vip/vip_index" class="vip">VIP购买</a></li>-->
				<!--<li><a href="/book/index" class="book">汽车书籍</a></li>-->
				<!--<li><a href="/help/about" class="help">帮助</a></li>-->
				<!--<li>技术学习<i class="arrow-icon"></i>
					<div class="submenu">
						<a href=""><i class="kck-icon"></i>基础入门课程<span>100+</span></a>
						<a href=""><i class="zyljt-icon"></i>实战专业课程<span>200+</span></a>
					</div>
				</li>
				<li >技术社区<i class="arrow-icon"></i>
					<div class="submenu">
						<a href="/Question/question"><i class="jswd-icon"></i>技术问答<span>1000+</span></a>
					</div>
				</li>-->
			</ul>
		</nav>
		<!--nav end-->

		<!--login-->
		<div class="icon-box">
			
			@if(Auth::guard('member')->check())
			<span class="login-icon relative loginlist" id="login-icon">
				<dl class="submenu">
					<dd>
												<a href="/Ucenter/user_info" class="username-btn relative">lh_9480<i class="vipbs-icon" style="display:none" title="VIP会员专用标识"></i></a>
						<script type="text/javascript">
							var username='lh_9480';
							//加载登录头像
							$("#login-icon").removeClass("login-icon");
							$.post('/User/getHead',{'username':username},function(data){
								$("#login-icon").css({
									'background': 'url(/Public/Home/img/Avatar/'+data+') 0 0 no-repeat',
									'background-size':'25px',
									'background-position': '0'									
								});
							});
							//如果是VIP，则加载VIP标识							
							$.post('/User/getGroupId',{'username':username},function(data){
								if(data == 2) $(".vipbs-icon").show();
							});
						</script>
					</dd>
					<dd>
						<a href="/user/user_info"><i class="grzl-icon"></i>个人资料</a>
					</dd>
					<dd>
						<a href="/user/user_vip"><i class="wdvip-icon"></i>我的VIP</a>
					</dd>
					<!--<dd>
						<a href="/Ucenter/message"><i class="xxtz-icon"></i>消息通知</a>
					</dd>-->
					<dd>
						<a href="/user/order"><i class="wddd-icon"></i>我的订单</a>
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
				<div class="info">
					<div class="logo-footer">
						<img src="{{ _asset('assets/images/logo-footer.png') }}">
						<p>天下没有难修的汽车！</p>
					</div>
					<dl>
						<dt>资料查询</dt>
						<dd><a target="_blank" href="/Data/data">维修手册库</a></dd>
						<dd><a target="_blank" href="/Soft/soft">维修软件库</a></dd>
						<dd><a target="_blank" href="/Vip/vip_index">VIP会员购买</a></dd>
					</dl>
					<!--<dl>
						<dt>汽修学院</dt>
						<dd><a target="_blank" href="">基础入门课程</a></dd>
						<dd><a target="_blank" href="">实战专业课程</a></dd>
					</dl>-->
					<dl>
						<dt>常见问题</dt>
						<dd><a target="_blank" href="/help/start">手册库使用</a></dd>
						<dd><a target="_blank" href="/help/softdown">软件库使用</a></dd>
						<dd><a target="_blank" href="/help/member">如何购买VIP</a></dd>
					</dl>
					<dl>
						<dt>其他</dt>
						<dd><a target="_blank" href="/help/about">关于我们</a></dd>
					</dl>

					<div class="down">
						<p class="hot-tel">服务热线: 13060020950</p>
						<div class="downCon down-ios">
							<img src="{{ _asset('assets/images/wxgzh.jpg') }}" class="twoCode">微信公众号
						</div>
					</div>
					<div class="csc">
						<a href="#" id="back-to-top" title="回到顶部"><img src="{{_asset('assets/images/csc-top.png') }}"/></a>
						<a target="_blank"  title="点击QQ咨询:903987773" href="http://wpa.qq.com/msgrd?v=3&uin=903987773&site=qq&menu=yes">
							<img src="{{_asset('assets/images/fdsa2312safadsowq.gif')}}" />
						</a>

						<a href="#" class="csc-wx relative" title="扫码微信咨询:zczauto">
						<img src="{{ _asset('assets/images/csc-wx.png') }}"/>
						<img src="{{ _asset('assets/images/csc-wx-code.png') }}" alt="扫描加客户微信" class="csc-wx-code"/>
						</a>
					</div>
				</div>

			</div>
			<div class="copyright">
				<span>Copyright © 2013-2017&nbsp;<strong><a href="http://www.zczauto.com/" target="_blank">zczauto.com</a></strong> All Rights Reversed. </span>粤ICP备75508102号-1号   Version:1.1.0
			</div>
		</div>

@section('afterFooter')
@show{{-- 页脚区域 --}}
</body>
</html>
