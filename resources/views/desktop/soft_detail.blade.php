@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/soft.css')}}">

<!--内容开始-->	
<div class="w-1000 relative clearfix">
	<div class="aside left">

		<div class="aside-allCategory">

			<!--分类头-->
			<div class="hd">
				<h2><i class="icon-course-curr"></i><a href="/soft/index">维修软件库</a></h2>
			</div>

			<!--分类体-->
			<div class="bd">
				<ul class="aside-cList">
					<li>
					@foreach($categories AS $cat)
						<div><a href="/soft/index?s_cid={{$cat->id}}" class="{{$cat->id == $articles->cid ? 'active' : ''}}">{{$cat->name}}</a></div>
					@endforeach
					</li>
				</ul>
			</div> 
			<!-- /bd -->                    
		</div>
	</div>
	
	<div class="main right">
		<h2><a href="/soft/index">维修软件库</a> > 
			<a href="/soft/index?s_cid={{$articles->cid}}">{{isset($articles->cid) ?  $catArr[$articles->cid]: '所有'}}</a> > {{$articles->title}}		
		</h2>
		<section>
			<h3>软件详情</h3>
			<p id="notice_content">
			{!! $articles->content !!}
			</p>
		</section>
		<section>
			<h3>下载地址</h3>
			<p>
				注意事项：<br>
				1、年VIP可以直接查看下载地址。<br>
				2、软件采用百度网盘存储。<br>
				3、请使用百度盘客户端下载，<a href="/help/softdown">不知如何下载点这里！</a><br>
				4、软件内附详细安装教程，亲们请自行安装！
			</p>
			<p class="add">
				 {!! Auth::guard('member')->check()  && Auth::guard('member')->user()->role==1 ? $articles->url : '对不起！年费VIP会员登录后才能查看下载地址喔！' !!}
								
			</p>
		</section>
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