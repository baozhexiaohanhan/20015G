<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button clas(s="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/role/create')"><i class="layui-icon"></i>添加</button>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>角色名</th>
            <th>描述</th>
            <th>时间</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($data as $k=>$v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->role_id}}</td>
            <td>{{$v->role_name}}</td>
            <td>{{$v->role_desc}}</td>
            <td>{{date("Y-m-d H:i:s",$v->role_time)}}</td>

            <td class="td-manage">
            <button class="layui-btn"><a href="{{url('/role/roedit/'.$v->role_id)}}">编辑</a></button>
              <a href="javascript:void(0);" id="{{$v->role_id}}" type="button" class="layui-btn layui-btn-danger">删除</a>
              <button type="button" class="layui-btn"><a href="/role/right/{{$v->role_id}}">权限添加</a></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
        <tr><td colspan="6">{{ $data->links()}}</td></tr>
        </div>
      </div>

    </div>
    <script type="text/javascript">
      $('.layui-btn-danger').click(function(){
            var id = $(this).attr('id');
            var isdel = confirm('确认删除？');
            if(isdel == true){
                $.get('/role/rodel/'+id,function(rest){
                    if(rest.error_no == '2'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>
  </body>

</html>