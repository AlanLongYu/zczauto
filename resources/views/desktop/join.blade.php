@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about" >关于我们</a></li>
			<li><a href="start">维修手册库</a></li>
			<li><a href="softdown">维修软件库</a></li>
<!--			<li><a href="member">VIP购买</a></li>-->
			<li><a href="join"  class="active">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>
		</ul>
	</nav>
    <div class="main right">
		<h2>加入我们</h2>
		<section>
			<h3>我们希望你</h3>
			<p>热衷分享，热爱汽车维修</p>
			<p>有两年以上一线汽车维修经验</p>
			<p>最好是4S店员工，或者有获取汽修资料资源的途径</p>
		</section>
		<section>
			<h3>你的收获</h3>
			<p>额外收入</p>
			<p>技术的沉淀与分享</p>
			<p>迅速增长的粉丝及业内知名度</p>
		</section>
		<section>
			<h3>你的角色</h3>
			<p>提供更多更新汽车维修资料</p>
			<p>回答会员技术问题并交流</p>
			<p>作为本站技术顾问或讲师</p>
			<p>本站初建，像个步履蹒跚的孩子，我们不是富二代，或许你加入我们，不能获得许多金钱，但至少，利用业余时间，你能学到更多知识，更多经验，或许有一天我们成长了，你就是元老之一！我们一起努力吧！</p>
			<p><img src="/assets/images/join.jpg"/></p>
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