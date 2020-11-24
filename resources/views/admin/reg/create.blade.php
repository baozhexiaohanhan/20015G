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
        @if (session('msg'))
          <div class="alert alert-success">
           <h5 style="color:red">{{ session('msg') }}</h5>
            </div>
          @endif
    <div class="x-body">
    <form class="layui-form" action="{{url('/admin/rstore')}}" method="post" lay-filter="example" style="margin-top:20px;" >
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
        <label class="layui-form-label">管理员名称</label>
        <div class="layui-input-block">
            <input type="text" name="admin_name" lay-verify="title" autocomplete="off" placeholder="请输入管理员名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">管理员密码</label>
        <div class="layui-input-block">
            <input type="password" name="admin_pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">管理员电话</label>
        <div class="layui-input-block">
            <input type="text" name="admin_tel" placeholder="请输入手机号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
           @foreach($data as $k=>$v)
            <input type="checkbox" name="role[]" lay-skin="primary" value="{{$v['role_id']}}" title="{{$v['role_name']}}" >
            @endforeach
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