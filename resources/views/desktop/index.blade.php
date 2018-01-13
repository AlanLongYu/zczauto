@extends('desktop.layout._main')


@section('mainContent')

<script type="text/javascript">
	function IsPC() {
		var userAgentInfo = navigator.userAgent;
		var Agents = ["Android", "iPhone",
					"SymbianOS", "Windows Phone",
					"iPad", "iPod"];
		var flag = true;
		for (var v = 0; v < Agents.length; v++) {
			if (userAgentInfo.indexOf(Agents[v]) > 0) {
				flag = false;
				break;
			}
		}
		return flag;
	}
	if(!IsPC()){
		$(".header-nav li,#login-icon").click(function(){
			$(this).children(".submenu").toggle();
		});
	}
</script>


 
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/css/index.css') }}">
<script type="text/javascript" src="{{ _asset('assets/js/index.js') }}"></script>
<script type="text/javascript" src="{{ _asset('assets/js/roll.js') }}"></script>



<!--flash开始-->
<div class="flash relative">
	<ul class="picbox">	
		<li class="fbg1 current" style="display:list-item;">
			<div class="w-1000">
				<img src="{{ _asset('assets/images/flash_a.png')}}"/>
				<div class="right">
					<h1>第6代汽修资料库更新</h1>
					<p>精准资料网，致力于汽修技术资料学习交流！第6代汽修资料库，集在线浏览、打印、下载三位一体，超1000+车型原厂权威资料，适用于电脑、平板、电脑多终端!</p>
					<a href="/user/register">立即注册学习</a>
				</div>
			</div>			
		</li>

		<li class="fbg2" style="display:list-item;">
			<div class="w-1000">
				<img src="{{ _asset('assets/images/flash_a.png')}}"/>
				<div class="right">
					<h1>第6代汽修资料库更新</h1>
					<p>精准资料网，致力于汽修技术资料学习交流！第6代汽修资料库，集在线浏览、打印、下载三位一体，超1000+车型原厂权威资料，适用于电脑、平板、电脑多终端!</p>
					<a href="/user/register">立即注册学习</a>
				</div>
			</div>			
		</li>

	</ul>
	<ul class="switch">
		<li class="current"><a href="javascript:void(0)"></a></li>
		<li class=""><a href="javascript:void(0)"></a></li>
		<!--<li class=""><a href="javascript:void(0)"></a></li>-->
	</ul>
</div>
<!--flash结束-->

<!--卖点开始-->
<div class="card">
	<h2><span>核心特性</span></h2>
	<div class="div-card w-1000 clearfix">
		<img src="{{ _asset('assets/images/core1.png')}}" alt="" />
		<img src="{{ _asset('assets/images/core2.png')}}" alt="" />
		<img src="{{ _asset('assets/images/core3.png')}}" alt="" />
	</div>
</div>
<!--卖点结束-->
@endsection