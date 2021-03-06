<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
  <link rel="stylesheet" href="/admin/css/xadmin.css">
  
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>
<div class="x-body">
      <div class="layui-form layui-col-md12 x-so">
       <form>
            <input type="text" name="name" placeholder="请输入管理员名称" autocomplete="off" class="layui-input" value="{{$query['name']??''}}">
           <button class="layui-btn layui-btn-normal">搜索</button>
          </form>
      </div>
      <xblock>
        <button class="layui-btn" ><a href="/admin/addlist">添加</a></button>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
            </th>
            <th>ID</th>
            <th>登录名</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>加入时间</th>
            <th>操作</th>
        </tr></thead>
        <tbody>
          @foreach($data as $k=>$v)
          <tr>
            <td>
            </td>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td>{{$v->email}}</td>
            <td>{{date("Y-m-d H:i:s",$v->admin_time)}}</td>
            <td class="td-manage">
            <button class="layui-btn">编辑</button>
            <a href="javascript:void(0);" id="{{$v->admin_id}}" type="button" class="layui-btn layui-btn-danger">删除</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
         <tr><td colspan="6" >{{ $data->links()}}</td></tr>
        </div>
      </div>

    </div>
    <script type="text/javascript">
      $('.layui-btn-danger').click(function(){
            var id = $(this).attr('id');
            var isdel = confirm('确认删除此管理员？');
            if(isdel == true){
                $.get('/admin/delete/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>