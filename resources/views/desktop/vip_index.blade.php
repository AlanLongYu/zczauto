@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/vip.css')}}">
<!--内容开始-->	
	
<div class="w-1000 vip_box">		

		<h1>ZCZ汽车网，专为汽修人而生！</h1>
		<h2>升级VIP会员！立即拥有海量资料库！修车再也不怕没资料了！</h2>
		<table class="duibi">
				<tr>
					<th width="200">对比项目</th>
					<th width="208" class="focus">精准资料网</th>
					<th width="208">其它资料库</th>
					<th width="208">淘宝资料店</th>
				</tr>
				<tr>
					<td class="center">内容</td>
					<td class="focus">海量维修资料并系统分类</td>
					<td>资料较多但不够专业</td>
					<td>资料较多但散乱</td>
				</tr>
				<tr>
					<td  class="center">更新</td>
					<td class="focus">数据实时更新，每日升级</td>
					<td>数据不定期更新</td>
					<td>升级需要自己找并重新购买</td>
				</tr>
				<tr>
					<td  class="center">价格</td>
					<td class="focus">全网最低价</td>
					<td>品质一般但价格却奇高</td>
					<td>零散资料加起来至少上万</td>
				</tr>
				<tr>
					<td  class="center">使用</td>
					<td class="focus">无需下载软件，简单易用</td>
					<td>需要下载各种软件及程序</td>
					<td>下载和安装非常繁琐</td>
				</tr>
				<tr>
					<td  class="center">限制</td>
					<td class="focus">无电脑限制，可浏览/打印/下载</td>
					<td>仅限某台电脑用，只能浏览/打印</td>
					<td>必须下载还要安装才能用</td>
				</tr>
		</table>

		<!--卡片列表-->
		<div class="card-list clearfix">
			<dl class="cf">
				<dd>
					<div class="vip-time">
						<h4>体验VIP会员</h4>
						<div class="pay-money">
							<em>￥</em>
							<span>0</span> 7天
						</div>
						<p><span class="color-red">每人仅1次机会</span></p>
					</div>
					<ul>
						<li>浏览维修手册库所有资料</li>
						<li>加入普通交流群</li>	
						<li></li>
						<li></li>
					</ul>
					<a href="/Home/Pay/tiyan" class="greenbtn" >立即体验</a>
				</dd>
				<dd>
					<div class="vip-time relative">
						<img src="/Public/Home/img/vip/vip_2.png" class="chaozhi">
						<h4>1年VIP会员</h4>
						<div class="pay-money">
							<em>￥</em>
							<span>120</span> 12个月
						</div>
					</div>
					<ul>
						<li>浏览维修手册库所有资料</li>
						<li>加入VIP交流群</li>
						<li></li>
						<li></li>
					</ul>
					<a href="/Home/Pay/pay_confirm?t=1" target="_blank" class="greenbtn">立即购买</a>
				</dd>		
				<dd>
					<div class="vip-time relative">
						<h4>1年超级会员</h4>
						<div class="pay-money">
							<em>￥</em>
							<span>260</span> 12个月
						</div>
					</div>
					<ul>
						<li>浏览维修手册库所有资料</li>
						<li>下载维修手册库所有资料</li>
						<li>下载维修软件库300G+</li>
						<li>加入VIP交流群</li>
					</ul>
					<a href="/Home/Pay/pay_confirm?t=2" target="_blank" class="greenbtn">立即购买</a>
				</dd>
						
			</dl>
		</div><!--卡片列表 end-->

		<div class="eval">
			<h4>累计评价<em>342</em>
			<span class="right"><span class="m_h">购买后评价，即送30天/90天VIP期限！</span><a href="/Ucenter/user_order" style="color:#ff9900;">立即去评价</a></span>
			</h4>
			<dl>
				<dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>lh_9535</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：未评价！</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/26 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
												</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>lh_9526</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：未评价！</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/25 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
												</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>lh_9429</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：很好用，资料很全</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/22 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						3年超级会员						&nbsp;&nbsp;&nbsp; </span>						
						<span>评价时间：2017/08/22</span>						</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>鸿达汽修</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：非常好的网站，推荐</p>
						<p>解释：谢谢支持，APP已上线，可以下载试用了喔</p>
						<p class="order_info">
						<span>成交时间：2017/08/17 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
						<span>评价时间：2017/08/17</span>						</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>lh_9501</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：未评价！</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/15 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
												</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>lh_9365</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：未评价！</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/14 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
												</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>903987</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：非常不错的网站，第二次买了</p>
						<p>解释：老朋友了，感谢一如即往的支持</p>
						<p class="order_info">
						<span>成交时间：2017/08/13 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
						<span>评价时间：2017/08/13</span>						</p>
					</div>
				</dd><dd class="clearfix">
					<div class="user_info left">
						<img src="/Public/Home/img/Avatar/default.gif" alt="会员头像" />
						<span>xxb</span>
						
						<span class="orange">超级会员</span>					</div>
					<div class="eval_body right">
						<p>评价：未评价！</p>
						<p>解释：未解释！</p>
						<p class="order_info">
						<span>成交时间：2017/08/13 &nbsp;&nbsp;&nbsp;</span>
						<span>购买类型：
						1年超级会员						&nbsp;&nbsp;&nbsp; </span>						
												</p>
					</div>
				</dd>



			</dl>
			<div class="page">
					<div>  <span class="current">1</span><a class="num" href="/Vip/vip_index/p/2.html">2</a><a class="num" href="/Vip/vip_index/p/3.html">3</a><a class="num" href="/Vip/vip_index/p/4.html">4</a><a class="num" href="/Vip/vip_index/p/5.html">5</a><a class="num" href="/Vip/vip_index/p/6.html">6</a><a class="num" href="/Vip/vip_index/p/7.html">7</a><a class="num" href="/Vip/vip_index/p/8.html">8</a><a class="num" href="/Vip/vip_index/p/9.html">9</a><a class="num" href="/Vip/vip_index/p/10.html">10</a><a class="num" href="/Vip/vip_index/p/11.html">11</a> <a class="next" href="/Vip/vip_index/p/2.html">  下一页  </a> <a class="end" href="/Vip/vip_index/p/43.html">43</a></div>			</div>
		</div>

</div>
<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".vip").addClass("current");
});
</script>
<!--内容结束-->	

@endsection