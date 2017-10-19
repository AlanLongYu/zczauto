
@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/login.css')}}">
<script type="text/javascript" src="{{ _asset('/assets/js/login.js')}}"></script>

<!--登录结束-->
<div class="loginpage w-1000">
	<div class="login relative">
		<h1>
			<span class="other">还没有帐号？现在就 
			<a href="/user/register">注册</a>
			</span> 
		欢迎登录ZCZ汽车网
		</h1>
		<form action="/user/login" id="form_login" autocomplete="off" name="form_regist" method="post">
			<table class="regtable">
				<tbody>	
					
					<tr>
						<td class="title">手机：</td>
						<td>
							<input type="text" class="textcss" id="username" name="username" placeholder="请输入手机号">
							<span class="msgs" id="msg_username">请输入您的手机号</span>
						</td>
					</tr>
					<tr>
						<td class="title">密码：</td>
						<td>
							<input type="password" autocomplete="off" class="textcss" id="password" name="password" placeholder="请输入密码">
							<span class="msgs" id="msg_password">您的登录密码</span>   
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="nopass">
							<input type="checkbox" id="txtAutologin" name="txtAutologin" checked>7天内免登录&nbsp; |&nbsp; 
							<a href="findpwd" id="findpwd">忘记密码</a>
						</td>
					</tr>
					<tr>
						<td class="title">&nbsp;</td>
						<td>
							<p class="msgs" id="msgs" style="display: none;"></p>
							<input type="submit" value="登 录"  class="butncss" id="loginSubmitButton">						
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div class="banner_login">
			<img src="{{ _asset('/assets/images/login_img.gif')}}">
		</div>
	</div>
</div>
<!--登录结束-->


<!--弹出层-->
<script src="{{_asset('/assets/js/jquery.reveal.js')}}"></script>
<link rel="stylesheet" href="{{_asset('/assets/css/reveal.css')}}">	
<a href="#" id="loginok" data-reveal-id="myModal" style="display:none"></a>
<div id="myModal" class="reveal-modal">
	<h6>恭喜您，登录成功，马上回到首页！</h6>
	<p>见证奇迹的时候到了，开始您的ZCZ之旅吧！</p>
</div>

@endsection