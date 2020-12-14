@include('admin.lay.top')
     @section('tops')
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
            <td>
            @php 
            echo substr($v->admin_tel,0,3)."******".substr($v->admin_tel,7,4);
            @endphp
            </td>
            <td>{{$v->email}}</td>
            <td>{{date("Y-m-d H:i:s",$v->admin_time)}}</td>
            <td class="td-manage">
             <a href="{{url('/admin/edit/'.$v->admin_id)}}" class="layui-btn layui-btn-warm">修改</a>
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
                $.get('/admin/destroy/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>