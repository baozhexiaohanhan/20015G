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
            <input type="text" name="name" placeholder="请输入名称" autocomplete="off" class="layui-input" value="{{$query['name']??''}}">
           <button class="layui-btn layui-btn-normal">搜索</button>
          </form>
      </div>
      <xblock>
        <button class="layui-btn" ><a href="/birthday/create">添加</a></button>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
            </th>
            <th>ID</th>
            <th>姓名</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>身份证号</th>
            <th>生日时间</th>
            <th>操作</th>
        </tr></thead>
        <tbody>
          @foreach($data as $k=>$v)
          <tr>
            <td>
            </td>
            <td>{{$v->birthday_id}}</td>
            <td>{{$v->birthday_name}}</td>
            <td>
            @php 
            echo substr($v->birthday_tel,0,3)."****".substr($v->birthday_tel,7,4);
            @endphp
          </td>
            <td>{{$v->birthday_email}}</td>
            <td>
            @php 
            echo substr($v->birthday_shenfen,0,8)."******".substr($v->birthday_shenfen,14,18);
            @endphp
            </td>
            <td>{{date("Y-m-d H:i:s",$v->birthday_time)}}</td>
            <td class="td-manage">
            <a href="{{url('/birthday/edit/'.$v->birthday_id)}}" class="layui-btn layui-btn-warm">修改</a>
            <a href="javascript:void(0);" id="{{$v->birthday_id}}" type="button" class="layui-btn layui-btn-danger">删除</a>
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
            var isdel = confirm('确认删除生日用户？');
            if(isdel == true){
                $.get('/birthday/destroy/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>