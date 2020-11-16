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
  @if(session('msg'))
  <div class="alert alert-success">
      <h5 style="color:red">{{session('msg')}}</h5>
</div>
  @endif
  <body>
    <div class="x-body">
    <form class="layui-form" action="{{url('/right/rigdo')}}" method="post" lay-filter="example" style="margin-top:20px;" >
    @if ($errors->any())
        <div class="alert alert-danger" style="padding-bottom: 20px;padding-left: 20px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="margin-top:10px; color:#ff0000">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="layui-form-item">
        <label class="layui-form-label">权限</label>
        <div class="layui-input-block">
            <input type="text" name="right_name" lay-verify="title" autocomplete="off"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">URL</label>
        <div class="layui-input-block">
            <input type="text" name="right_url" lay-verify="title" autocomplete="off"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">路由别名</label>
        <div class="layui-input-block">
        <input type="text" name="right_as" lay-verify="title" autocomplete="off"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">Menu</label>
    <div class="layui-input-block">
      <select name="parent_id" lay-filter="aihao">
        <option value="0">顶级分类</option>
        @foreach($reg as $k=>$v)
        <option value="{{$v->parent_id}}">{{str_repeat('—',$v->level*3)}}{{$v->right_name}}</option>
        @endforeach
       
      </select>
    </div>
  </div>
    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <button type="submit" class="layui-btn">添加</button>
        </div>
    </div>
</form>
    </div>
  </body>

</html>