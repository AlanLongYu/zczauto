@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            资料库管理
            <small>资料列表</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">资料管理 - 列表</li>
          </ol>
@stop

@section('content')

              @if(session()->has('fail'))
                <div class="alert alert-warning alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
                  {{ session('fail') }}
                </div>
              @endif

              @if(session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                  {{ session('message') }}
                </div>
              @endif

              <a href="{{ _route('admin:carowner.create').'?nav_id='.$navId }}" class="btn btn-primary margin-bottom">新增资料</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">资料列表</h3>
                   @can('user-search')
                  <div class="box-tools">
                    <form action="{{ _route('admin:carowner.index') }}" method="get" class="form-inline">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm" name="subject" value="{{ request('subject') }}" style="width: 150px;" placeholder="搜索标题关键字">
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
                        <th>名称</th>
                        <th width="15%">描述</th>
                        <th>缩略图</th>
                        <th>排序</th>
                        <th>更新时间</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($ziliaos as $cat)
                      <tr>
                        <td>
                            @can('category-write')
                            <a href="{{ _route('admin:carowner.edit',$cat->id) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            @endcan
                            @can('category-show')
                            <a href="{{ $cat->detail_url }}" target="_blank"><i class="fa fa-fw fa-link" title="查看资料详情"></i></a>
                            @endcan
                        </td>
                        <td>{{ $cat->id }}</td>
                        <td class="text-muted">
                          {{ $cat->name }}
                        </td>
                        <td class="text-green">
                          @if(empty($cat->content))
                          -
                          @else
                          {{ $cat->content }}
                          @endif
                        </td>
                        <td class="text-green">
                          @if(empty($cat->thumb))
                          -
                          @else
                          <a href="{{ $cat->thumb }}" target="_blank">{{ $cat->thumb }}</a>
                          @endif
                        </td>
                        <td>{{ $cat->sort_order }}</td>
                        <td>{{ $cat->updated_at }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $ziliaos->render() !!}
                </div>

              </div>
@stop



