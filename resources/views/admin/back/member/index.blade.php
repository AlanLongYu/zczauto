@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            会员管理
            <small>管理员</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">会员管理 - 管理员</li>
          </ol>
@stop

@section('content')

              @if(session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                  {{ session('message') }}
                </div>
              @endif

              @can('user-write')
              <a href="{{ _route('admin:member.create') }}" class="btn btn-primary margin-bottom">新增会员(用户)</a>
              @endcan

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">会员列表</h3>
                  @can('user-search')
                  <div class="box-tools">
                    <form action="{{ _route('admin:member.index') }}" method="get" class="form-inline">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm" name="s_phone" value="{{ request('s_phone') }}" style="width: 150px;" placeholder="搜索用户手机号">
                      </div>
                      <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                    </form>
                  </div>
                  @endcan
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>操作</th>
                        <th>编号</th>
                        <th>手机号</th>
                        <th>真实姓名</th>
                        <th>角色</th>
                        <th>状态</th>
                        <th>最后一次登陆时间</th>
                      </tr>
                      <!--tr-th end-->
                      @foreach ($users as $user)
                      <tr>
                        <td>
                          @can('user-write')
                          <a href="{{ _route('admin:member.edit', $user->id) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                          @endcan
                        </td>
                        <td>{{ $user->id }}</td>
                        <td class="text-muted">{{ $user->phone }} </td>
                        <td class="text-green">
                          {{ $user->realname }}
                        </td>
                        <td class="text-red">
                         
                        </td>
                        <td class="text-yellow">
                          @if($user->is_locked)
                          锁定
                          @else
                          正常
                          @endif
                        </td>
                        <td>{{ $user->updated_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $users->appends(['phone' => request('s_phone')])->render() !!}
                </div>

              </div>
@stop

@section('extraSection')
  <!--引入layer插件-->
  <script src="{{ _asset(ref('layer.js')) }}"></script>
@stop

@section('filledScript')
        $('a.layer_open').on('click', function(evt){
            evt.preventDefault();
            var src = $(this).attr("href");
            var title = $(this).data('title');
            layer.open({
                type: 2,
                title: title,
                shadeClose: true,
                shade: 0.8,
                area: ['800px', '720px'],
                content: src //iframe的url
            });
        });
@stop