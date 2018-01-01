@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about">关于我们</a></li>
			<li><a href="start" >维修手册库</a></li>
			<li><a href="softdown"   class="active">维修软件库</a></li>
			<li><a href="disclaimer">免责申明</a></li>
<!--			<li><a href="member">VIP购买</a></li>-->
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>
		</ul>
	</nav>

    <div class="main right">
		<h2>对不起，网站模块建设中，请稍后查看！</h2>


    </div>

	<!-- /popup -->
</div>


<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".help").addClass("current");
});
</script>
@endsection