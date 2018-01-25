@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/data.css')}}">
<!--内容开始-->	
<script src="{{ _asset('/assets/js/roll.js')}}"></script>
<script src="{{ _asset('/assets/js/data.js')}}"></script>

<!--内容开始-->	
<div class="w-1000 relative clearfix">
	<div class="aside left">

		<div class="aside-allCategory">

			<!--分类头-->
			<div class="hd">
				<h2><i class="icon-course-curr"></i><a href="/data/data/{{$navId}}">{{$currentName}}</a></h2>
			</div>

			<!--分类体-->
			<div class="bd">
				<ul class="aside-cList">
					@foreach($categories AS $cat)
					<li> 
						<div>
							<a href="#" class="country">{{ $cat['name'] }}</a>
							<div class="list-show">
								<div>
									@if(isset($cat['son']))
									@foreach($cat['son'] AS $cc)
									<dl>
										<dt><a href="#" class="factory">{{ $cc['name'] }}</a></dt>
										<dd>
										@if(isset($cc['son']))
											@foreach($cc['son'] AS $ccc)
												<a href="/data/cardetail/{{$ccc['id']}}/{{$navId}}" class="car">{{$ccc['name']}}</a>
											@endforeach
										@endif
										</dd>
									</dl>
									@endforeach
									@endif
									</div>
							</div><!-- list-show -->
						</div>
					</li>
					@endforeach
				</ul>
			</div> 
			<!-- /bd -->
			<div class="aside-search">
				<div class="hd">
					<h2><i class="icon-search"></i>搜索车型</h2>
				</div>
				<div class="bd">
					<form class="bigsearch" onsubmit="return false;">
						<input type="hidden" name="navId" value="{{$navId}}" id="navId">
						<input type="text" placeholder="请输入车型" class="stext" id="search_inp">
						<input type="button" class="sbtn" value="" title="点击搜索" id="search_btn">
					</form>
				</div>
			</div>                    
		</div>
		<div class="aside-search">
			<!--<div class="hd">
				<h2><i class="icon-search"></i>搜索车型></h2>
			</div>
			<div class="bd">
				<form class="bigsearch">
					<input type="text" placeholder="请输入车型" class="stext"  id="search_inp" >
					<input type="button" class="sbtn" value="" title="点击搜索" id="search_btn">
				</form>
			</div>-->
		</div>

	</div>
	
	<div class="main right">
		<!--<div id="info">
			<h1>温馨提示</h1>
			<p>1、模块功能：本模块可在线浏览、打印、下载维修手册电路图！请在左侧菜单栏选择国家、厂家、车型！也可直接搜索车型！</p>
			<p>2、硬件要求：电脑浏览需要WIN7以上操作系统，IE浏览器要求9.0以上！推荐使用谷歌Chrome浏览器效果最佳！若是XP老电脑则使用360浏览器！手机浏览推荐UC浏览器！</p>			
		</div>					
		<h2>最新车型</h2> 
		<div id="roll">
			<ul class="car">
			<li>
				<a href="">2014-2017宝马X5(F15)</a>
				<span>0浏览</span>
				</li>
				<div class="clearfix"></div>
			</ul>
		</div>

		<h2>浏览历史</h2> 				
		<ul class="car">
			<li><a href="">2014-2017宝马X5(F15)</a></li>
			<li><a href="">2004广汽本田飞度FIT</a></li>
			<li><a href="">2015-2017奥迪R8</a></li>
			<li><a href="">2012-2016一汽奥迪新A6L</a></li>			
			<div class="clearfix"></div>
		</ul>
		-->

	</div>

	
</div>
<!--内容结束-->	
<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".ziliao-search").addClass("current");
});
</script>

@endsection