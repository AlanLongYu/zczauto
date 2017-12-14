@extends('desktop.layout._main')


@section('mainContent')


<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/login.css')}}">
<script type="text/javascript" src="{{ _asset('/assets/js/register.js')}}"></script>


<!--注册开始-->
<div class="loginpage w-1000">
	<div class="register relative">
		<h1>
			<span class="other">我已经注册，现在就 
			<a href="/user/login">登录</a>
			</span> 
		欢迎注册ZCZAUTO汽车网
		</h1>
		<form id="form_regist" autocomplete="off" name="form_regist" method="post">
			<input type="hidden" id="method" name="method" value="register">
			<table class="regtable">
				<tbody>
					<tr>
						<td class="title">手机号：</td>
						<td>
							<input type="text" class="textcss" id="phone" name="phone" placeholder="请输入手机号" value="{{old(
							'phone')}}">
							<span class="msgs" id="msg_phone">有效的11位手机号码</span>
						</td>
					</tr>
					<tr>
						<td class="title">密码：</td>
						<td>
							<input type="password" class="textcss" id="password" name="password" placeholder="请输入密码">
							<span class="msgs" id="msg_password">6~16位字母加数字</span>   
						</td>
					</tr>
					<tr>
						<td class="title">确认密码：</td>
						<td>
							<input type="password" class="textcss" placeholder="确认密码" id="password2" name="password2">
							<span class="msgs" id="msg_password2">请再次输入相同的密码</span>
						</td>
					</tr>
					<tr>
						<td class="title">&nbsp;</td>
						<td>
							<input type="submit" value="注 册" class="butncss" id="regSubmitButton">
							 @if(session()->has('fail'))
							<p class="msgs" id="msgs" style="color: red;">{{session('fail')}}</p>
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div class="banner">
			<img src="{{ _asset('/assets/images/register_right.png')}}">
		</div>
	</div>
</div>
<!--注册结束-->


<!--弹出层-->
<script src="{{ _asset('/assets/js/jquery.reveal.js')}}"></script>
<link rel="stylesheet" href="{{ _asset('/assets/css/reveal.css')}}">	
<a href="#" id="registerok" data-reveal-id="myModal" style="display:none"></a>
<div id="myModal" class="reveal-modal">
	<h6>恭喜您，注册成功，马上转到登录页！</h6>
	<p>hello！欢迎您成为者车者汽车网一员！</p>
</div>

@endsection