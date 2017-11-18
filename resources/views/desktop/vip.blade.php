@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about" >关于我们</a></li>
			<li><a href="start">维修手册库</a></li>
			<li><a href="softdown">维修软件库</a></li>
			<li><a href="member" class="active">VIP购买</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>
		</ul>
	</nav>
    <div class="main right">
		<h2>VIP购买</h2>
		<section>
			<h3>会员等级</h3>
			<p>1 游客：没有注册，可以浏览维修手册库免费资料，但不能打印和下载</p>
			<p>2 普通会员：已注册，可以浏览维修手册库免费资料，可以打印和下载</p>			
			<p>3 VIP会员：已购买1年/3年VIP，可以浏览、打印、下载全部维修手册库资料</p>
			<p style="color:#ff9900">提示：游客和普通会员只能浏览VIP资料的第1个子目录</p>
		</section>
		<section>
			<h3>购买VIP</h3>
			<p>第1步：进入VIP购买页 <a href="/vip/vip_index">http://www.zczauto.com/vip/vip_index</a></p>
			<p>第2步：选择VIP期限，新会员注册即可免费试用，老会员可购1年或3年VIP，注意已是底价，谢绝讲价，新老客户价格一致。</p>
			<p><img src="/assets/images/member_01.png" width="80%"/></p><br/>
			<p>第3步：选择支付方式，目前有支付宝和微信支付两种方式，任选其一，这个大家都懂的！</p>
			<p><img src="/assets/images/member_02.png"/></p><br/>
			<p>第4步：开通VIP权限，支付完成后自动开通VIP权限，若因网站故障未能开通，请联系管理员人工开通！</p>
			
		</section>
    </div>
</div>

<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".vip").addClass("current");
});
</script>
@endsection