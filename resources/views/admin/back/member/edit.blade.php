@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            会员管理
            <small>管理员</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:user.index') }}">用户管理 - 会员</a></li>
            <li class="active">修改会员</li>
          </ol>
@stop

@section('content')

            @if(session()->has('fail'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                {{ session('fail') }}
              </div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 警告！</h4>
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
              </div>
            @endif

              <div class="box box-primary">

                <div class="box-header with-border">
                  <h3 class="box-title">修改会员资料</h3>
                  <p>您可修改会员昵称、真实姓名与登录密码等信息。登录密码项留空，则不修改登录密码。</p>
                  <div class="basic_info bg-info">
                     <ul>
                        <li>昵称：<span class="text-primary">{{ $user->nickname }}</span></li>
                        <li>真实姓名：<span class="text-primary">{{ $user->realname }}</span></li>
                        <li>会员等级：<span class="text-primary">{!! $user->role == 1 ? '<span style="color:red;">黄金会员</span>' : '普通会员' !!}</span></li>
                        <li>手机号码：<b>{{ $user->phone }}</b></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->

                <form method="post" action="{{ _route('admin:member.update', $user->id) }}" accept-charset="utf-8">
                {!! method_field('put') !!}
                {!! csrf_field() !!}
                  <div class="box-body">
                    <div class="form-group">
                      <label>昵称 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="nickname" value="{{ old('nickname', isset($user) ? $user->nickname : null) }}" placeholder="昵称">
                    </div>
                    <div class="form-group">
                      <label>真实姓名 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="realname" autocomplete="off" value="{{ old('realname', isset($user) ? $user->realname : null) }}" placeholder="真实姓名">
                    </div>
                    <div class="form-group">
                      <label>手机号 <small class="text-red">*</small></label>
                      <input type="text" class="form-control required" required name="phone" autocomplete="off" value="{{ old('phone', isset($user) ? $user->phone : null) }}" placeholder="手机号">
                    </div>

                    <div class="form-group">
                      <label>用户状态：是否锁定 <small class="text-red">*</small></label>
                      <div class="input-group">
                        <input type="radio" name="is_locked" value="0" {{ ($user->is_locked === 0) ? 'checked' : '' }}>
                        <label class="choice" for="radiogroup">否</label>
                        <input type="radio" name="is_locked" value="1" {{ ($user->is_locked === 1) ? 'checked' : '' }}>
                        <label class="choice" for="radiogroup">是</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>角色(用户组) <small class="text-red">*</small></label>
                      <div class="input-group">
                          <select data-placeholder="选择角色..." class="chosen-select" style="min-width:200px;" name="role">
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ ($own_role->id === $role->id) ? 'selected':'' }}>{{ $role->name }}({{ $role->display_name }})</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>会员开始日期</label>
                      <input type="text" class="form-control" name="start_date" minlength="10" 　maxlength="10" placeholder＝"会员开始日期"="" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'twoer'})" value="{{ old('start_date', isset($user) ? substr($user->start_date,0,10) : null) }}">
                    </div>
                    <div class="form-group">
                      <label>会员截止日期</label>
                      <input type="text" class="form-control" name="end_date" minlength="10" 　maxlength="10" placeholder＝"会员截止日期"="" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'twoer'})" value="{{ old('end_date', isset($user) ? substr($user->end_date,0,10) : null) }}">
                    </div>
                    <div class="form-group">
                      <label>会员24小时内可打印下载的最大次数</label>
                      <input type="text" class="form-control" name="max_number" autocomplete="off" value="{{ old('max_number', isset($user) && $user->role==1 ? $user->max_number : null) }}" placeholder="24小时内最大可打印和下载次数">
                    </div>
                    <div class="form-group">
                      <label>登录密码</label>
                      <input type="password" class="form-control" name="password" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                    <div class="form-group">
                      <label>确认登录密码</label>
                      <input type="password" class="form-control" name="password_confirmation" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">修改个人资料</button>
                  </div>
                </form>

              </div>

@stop


@section('extraPlugin')

  <!--引入iCheck组件-->
  <script src="{{ _asset(ref('icheck.js')) }}" type="text/javascript"></script>
  <!--引入My97DatePicker日期插件-->
  <script src="{{ _asset(ref('my97datepicker.js')) }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('admin.scripts.endChosen')

@stop


@section('filledScript')
        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[name="is_locked"]').iCheck({
          radioClass: 'iradio_flat-blue',
          increaseArea: '20%' // optional
        });
@stop
