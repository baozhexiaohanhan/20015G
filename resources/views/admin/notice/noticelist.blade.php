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
            <input type="text" name="name" placeholder="请输入添加人" autocomplete="off" class="layui-input" value="{{$query['name']??''}}">
           <button class="layui-btn layui-btn-normal">搜索</button>
          </form>
      </div>
      <xblock>
        <button class="layui-btn" ><a href="/admin/notice">添加</a></button>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
            </th>
            <th>ID</th>
            <th>公告</th>
            <th>添加人</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr></thead>
        <tbody>
          @foreach($data as $k=>$v)
          <tr>
            <td>
            </td>
            <td>{{$v->notice_id}}</td>
            <td>{{$v->notice_name}}</td>
            <td>{{$v->notice_fullname}}</td>
            <td>{{date("Y-m-d H:i:s",$v->notice_time)}}</td>
            <td class="td-manage">
            <button class="layui-btn">编辑</button>
            <a href="javascript:void(0);" id="{{$v->notice_id}}" type="button" class="layui-btn layui-btn-danger">删除</a>
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
            var isdel = confirm('确定删除这条公告吗？');
            if(isdel == true){
                $.get('/admin/destr/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>