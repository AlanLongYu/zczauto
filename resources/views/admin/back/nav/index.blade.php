@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            导航栏管理
            <small>导航</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">导航栏管理 - 导航</li>
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

              <a href="{{ _route('admin:nav.create') }}" class="btn btn-primary margin-bottom">新增导航</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">导航列表</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>操作</th>
                        <th>编号</th>
                        <th>名称</th>
                        <th>地址</th>
                        <th>排序</th>
                        <th>更新时间</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($tree as $cat)
                      <tr>
                        <td>
                            @can('category-write')
                            <a href="{{ _route('admin:nav.edit', $cat['id']) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            @endcan
                        </td>
                        <td>{{ $cat['id'] }}</td>
                        <td class="text-muted">
                          {{ $cat['name'] }}
                        </td>
                        <td class="text-muted">
                          {{ $cat['url'] }}
                        </td>
                        <td>{{ $cat['sort'] }}</td>
                        <td>{{ $cat['updated_at'] }}</td>
                      </tr>
                      @if(isset($cat['son']))
                        @foreach ($cat['son'] as $cat)
                      <tr>
                        <td>
                            @can('category-write')
                            <a href="{{ _route('admin:nav.edit', $cat['id']) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            @endcan
                        </td>
                        <td>{{ $cat['id'] }}</td>
                        <td class="text-muted">
                            &nbsp;&nbsp;&nbsp;&nbsp;├ {{ $cat['name'] }}
                        </td>
                        <td class="text-muted">
                          {{ $cat['url'] }}
                        </td>
                        <td>{{ $cat['sort'] }}</td>
                        <td>{{ $cat['updated_at'] }}</td>
                      </tr>
                      @endforeach
                      @endif

                      @if(isset($cat['son']))
                        @foreach ($cat['son'] as $cat)
                      <tr>
                        <td>
                            @can('category-write')
                            <a href="{{ _route('admin:nav.edit', $cat['id']) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            @endcan
                        </td>
                        <td>{{ $cat['id'] }}</td>
                        <td class="text-muted">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ {{ $cat['name'] }}
                        </td>
                        <td class="text-muted">
                          {{ $cat['url'] }}
                        </td>
                        <td>{{ $cat['sort'] }}</td>
                        <td>{{ $cat['updated_at'] }}</td>
                      </tr>
                      @endforeach
                      @endif
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>

              </div>
@stop



