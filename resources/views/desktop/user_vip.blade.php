@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/user.css')}}">

<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="user_info" class="">个人资料</a></li>
			<li><a href="user_vip" class="active">我的VIP</a></li>
			<li><a href="order" class="">我的订单</a></li>
		</ul>
	</nav>

    <div class="main right">
		<h2>我的VIP</h2>
		<section class="basic">
			<h3>VIP信息</h3>
			<form id="vipForm" action="">
				<ul>
									<li>
						<label>会员级别</label>
						<div class="inputbox">							
							<span style="color:#35b558">普通会员</span>
						</div>
						<a  href="/Vip/vip_index" class="green-btn">购买VIP/超级会员</a>
					</li>					
				</ul>
			</form>
		</section>

    </div>

</div>

@endsection