@include('admin.lay.top')
     @section('tops')
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
  @if(session('msg'))
  <div class="alert alert-success">
      <h5 style="color:red">{{session('msg')}}</h5>
</div>
  @endif
  <body>
    <div class="x-body">
    <form class="layui-form" action="{{url('/role/roup/'.$data->role_id)}}" method="post" lay-filter="example" style="margin-top:20px;" >
       <div class="layui-form-item">
        <label class="layui-form-label">角色名称</label>
        <div class="layui-input-block">
            <input type="text" name="role_name" lay-verify="title" value="{{$data->role_name}}" autocomplete="off"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色简介</label>
        <div class="layui-input-block">
        <textarea name="role_desc" cols="30" rows="10">{{$data->role_desc}}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <button type="submit" class="layui-btn">修改</button>
        </div>
    </div>
</form>
    </div>
  </body>

</html>