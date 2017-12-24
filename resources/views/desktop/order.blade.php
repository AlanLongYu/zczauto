@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/user.css')}}">

<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="user_info" class="">个人资料</a></li>
<!--			<li><a href="user_vip" class="">我的VIP</a></li>
			<li><a href="order" class="active">我的订单</a></li>-->
		</ul>
	</nav>

    <div class="main right">
		<h2>我的订单</h2>
		<section class="basic">
			<h3>订单记录</h3>
			<p>提示：成功交易后评价可赠送VIP期限！1年VIP送30天、3年VIP送90天！</p>
			<table class="order_table">
				<tbody>
					<tr>
						<th width="25%">下单时间</th>
						<th width="20%">购买类型</th>						
						<th width="25%">成交时间</th>
						<th width="20%">交易状态</th>
						<th width="10%">评价管理</th>
					</tr>
									</tbody>
			</table>
			<div class="noorder">
				<img src="/Public/Home/img/user/noorder.png">
				<p>您还没有订单哦，马上去 <a href="/Vip/vip_index">购买VIP >></a></p>
			</div>			
		</section>

    </div>

</div>





<script type="text/javascript">	
	//验证并提交评价内容
	$("#eval_submit").click(function(){
		var eval_text=$("#inp").val();
		var order_id=$(this).parent().prev('span').text();

		if(eval_text.length < 10){
			$("#msg").text("请输入10个字以上的评价内容喔");
		}else if(eval_text.length > 200){
			$("#msg").text("字数超过200字，请减少字数");
		}else{
			$.post('user_order',{'evaluate':eval_text,'order_id':order_id},function(data){
				if(data){
					$("#msg").text("评价成功，并已赠送您VIP期限，将跳转到评价结果页");
					setTimeout(function () {
						window.location.href='../Vip/vip_index';
					}, 2000);
				}else{
					$("#msg").text("评价失败");
				}
			});
		}
	});


</script>


@endsection