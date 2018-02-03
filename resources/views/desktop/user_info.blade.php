@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/user.css')}}">

<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="user_info" class="active">个人中心</a></li>
<!--			<li><a href="user_vip" class="">我的VIP</a></li>
			<li><a href="order" class="">我的订单</a></li>-->
		</ul>
	</nav>

    <div class="main right">
		<h2>个人中心</h2>
		<section class="basic">
			<h3>基本信息</h3>
			<form id="basicForm" action="/user/saveprofile" method="post">
				<input type="hidden" name="id" value="{{$userInfo->id}}"/>
				<ul>
					<li>
						<label>手机号</label>
						<div class="inputbox">
							 
								<span>{{ Auth::guard('member')->user()->phone}}</span>
								<span class="ex-tips">不可更改</span> 
							
						</div>
					</li>
					<li>
						<label for="uname">用户名</label>
						<div class="inputbox">
							<input type="text" name="username" value="{{ Auth::guard('member')->user()->nickname}}"/>
							<span class="ex-tips">用户名作为呢称显示</span>
						</div>
					</li>
					<li>
						<label for="email">有效使用期</label>
						<div class="inputbox">
							<span>
							@if(Auth::guard('member')->user()->role ==1)
							{{Auth::guard('member')->user()->start_date ? substr(Auth::guard('member')->user()->start_date,0,10) : '-'}} 到 {{ Auth::guard('member')->user()->end_date ? substr(Auth::guard('member')->user()->end_date,0,10): ''}}
							@else
								- 到 -
							@endif
							</span>
							<span class="ex-tips">账号有效使用期限</span>
						</div>
					</li>
					<li>
						<label for="email">剩余天数</label>
						<div class="inputbox">
							<span>{{ Auth::guard('member')->user()->role==1 ? ceil((strtotime(Auth::guard('member')->user()->end_date) -time())/86400) : 0}}</span>
							<span class="ex-tips">账号使用剩余天数</span>
						</div>
					</li>
					<li>
						<div class="inputbox">
							<input type="hidden" name="truename" value="{{ Auth::guard('member')->user()->realname}}" maxlength="30">
						</div>
					</li>
					
					<li>
						<div class="inputbox">
							<input type="hidden" name="email" value="{{ Auth::guard('member')->user()->email}}" maxlength="30">
						</div>
					</li>
				</ul>
                <button type="submit" class="green-btn">保存</button>
			</form>
		</section>

		<!--<section class="basic p_hide">
			<h3>头像修改</h3>
			<ul>
				<li>
					<label for="">头像</label>
					<div class="inputbox">
						<div class="portrait-box">
							<img class="headpic" src="/Public/Home/img/Avatar/9480.jpg">
						</div>
						
						<form action="/Ucenter/cropImg.html" method="post" id="pic" class="update-pic clearfix">
							<div class="upload-area">
								<input type="file" id="user-pic">
								<div class="file-tips">支持JPG,PNG,GIF，图片小于1MB，尺寸不小于100*100，真实高清头像更受欢迎！</div>
								<div class="preview hidden" id="preview-hidden"></div>
							</div>
							<div class="preview-area">
								<input type="hidden" id="x" name="x" />
								<input type="hidden" id="y" name="y" />
								<input type="hidden" id="w" name="w" />
								<input type="hidden" id="h" name="h" />
								<input type="hidden" id='img_src' name='src'/>
								<div class="tcrop">头像预览</div>
								<div class="crop crop100"><img id="crop-preview-100" src=""></div>
								<a class="uppic-btn save-pic" href="javascript:;">保存</a>
							</div>
						</form>
						
					</div>
				</li>					
			</ul>
		</section>-->

    </div>

</div>

@endsection