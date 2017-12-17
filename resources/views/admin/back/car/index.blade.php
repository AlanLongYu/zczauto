@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            车型管理
            <small>车型</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">车型管理 - 车型</li>
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

              <a href="{{ _route('admin:car.create') }}" class="btn btn-primary margin-bottom">新增车系</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">车型列表</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                      <ul id="treeDemo" class="ztree"></ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>

              </div>
@stop

@section('extraPlugin')
<link href="{{ _asset('/assets/css/metroStyle/metroStyle.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.core.js') }}"></script>
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.excheck.js') }}"></script>
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.exedit.js') }}"></script>
<script>
  //Ztree插件js
    <!--
    var setting = {
      async: {
        enable: false,
        url:"/admin/car/type",
        autoParam:["id", "name=n", "level=lv"],
        otherParam:{"otherParam":"zTreeAsyncTest"},
        dataFilter: filter
      },
      view: {expandSpeed:"",
        addHoverDom: addHoverDom,
        removeHoverDom: removeHoverDom,
        showLine: true,
        selectedMulti: false
      },
      check: {
        enable: false
      },
      edit: {
        enable: true,
        editNameSelectAll : true

      },
      
      data: {
        simpleData: {
          enable: true
        }
      },
      callback: {
        beforeRemove: beforeRemove,
        beforeRename: beforeRename,
        onRename : editSuccess,
        onRemove : onRemove,
      }
    };

    function filter(treeId, parentNode, childNodes) {
      if (!childNodes) return null;
      for (var i=0, l=childNodes.length; i<l; i++) {
        childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
      }
      return childNodes;
    }
    function beforeRemove(treeId, treeNode) {
      var zTree = $.fn.zTree.getZTreeObj("treeDemo");
      zTree.selectNode(treeNode);
      return confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
    }   
    function beforeRename(treeId, treeNode, newName) {
      if (newName.length == 0) {
        setTimeout(function() {
          var zTree = $.fn.zTree.getZTreeObj("treeDemo");
          zTree.cancelEditName();
          alert("节点名称不能为空.");
        }, 0);
        return false;
      }
      return true;
    }

    var newCount = 1;
    function addHoverDom(treeId, treeNode) {
      var sObj = $("#" + treeNode.tId + "_span");
      if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
      var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
        + "' title='add node' onfocus='this.blur();'></span>";
      sObj.after(addStr);
      var btn = $("#addBtn_"+treeNode.tId);
      if (btn) btn.bind("click", function(){
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        var newName = "新车系"+treeNode.id;
        //弹出窗点击确认后添加到数据库，回调展示到树上
        $.ajax({
          url:"/admin/car/ajaxAdd",
          type:"post",
          data:{p_id:treeNode.id,name:newName},
          dataType:"json",
          success:function(data){
            if(data.code == 200){
              var newNode = zTree.addNodes(treeNode, {id:data.data, pId:treeNode.id, name:newName});
              zTree.selectNode(newNode[0]);
              $("#"+newNode[0].tId+"_edit").click();
              return true;
            }else{
              alert(data.msg);
              return false;
              
            }
          }

        });
        
        return false;
      });
    };

    function removeHoverDom(treeId, treeNode) {
      $("#addBtn_"+treeNode.tId).unbind().remove();
    };

    //删除数据库节点
    function onRemove(event, treeId, treeNode){
          $.ajax({
          url:"/admin/car/ajaxDel",
          type:"post",
          data:{id:treeNode.id},
          dataType:"json",
          success:function(data){
            if(data.code == 200){
              return true;
            }else{
              alert(data.msg);
              return false;
              
            }
          }

        });
    }

    function editSuccess(event,treeId,treeNode,isCancle){
      //ajax请求到后端保存数据库
          $.ajax({
          url:"/admin/car/ajaxEdit",
          type:"post",
          data:{id:treeNode.id,name:treeNode.name},
          dataType:"json",
          success:function(data){
            if(data.code == 200){
              return true;
            }else{
              alert(data.msg);
              return false;
              
            }
          }

        });
      //console.log(treeNode);
      //alert(treeNode.tId + ", " + treeNode.name);
    }

    $(document).ready(function(){
      $.fn.zTree.init($("#treeDemo"), setting,{!! $tree !!} );
    });
    //-->
</script>
</script>
@stop



