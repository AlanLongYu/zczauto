@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about" >关于我们</a></li>
			<li><a href="start">维修手册库</a></li>
			<li><a href="softdown">维修软件库</a></li>
			<li><a href="member">VIP购买</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact" class="active">联系我们</a></li>
		</ul>
	</nav>
    <div class="main right">
		<h2>联系我们</h2>
		<section>
			<h3>聊天工具</h3>
			<p>微信：langhuanauto（推荐）</p>
			<p>旺旺：langhuangroup</p>			
			<p>QQ：903987773</p>
			<p>手机：13060020950</p>
		</section>
		<section>
			<h3>微信公众号</h3>
			<p>关注本站官方微信公众号，获取更多有用的信息</p>
			<p><img src="/assets/images/wxgzh.jpg"/></p>
		</section>
    </div>
</div>





<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".help").addClass("current");
});
</script>
@endsection