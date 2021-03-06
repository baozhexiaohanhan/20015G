<!doctype html>
<html lang="en">
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
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="index.html">L-admin v2.0</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd>
                  <a onClick="x_admin_show('资讯','http://www.baidu.com')">
                    <i class="iconfont">&#xe6a2;</i>
                    <ul>
                      @php  $name=Route::currentRouteName();@endphp
                      @if(isset($aaaaa))
                      @foreach($aaaaa as $k=>$v)
                          <li @if(strpos($name,$v->right_as)!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item"@endif>
                          <a class="" href="javascript:;">{{$v->right_name}}</a>
                          @if($v->son)
                          <dl class="layui-nav-child" >
                              @foreach($v->son as $key=>$val)
                              <dd @if($name==$val->right_as) class='layui-this' @endif><a href="{{$val->right_url}}">{{$val->right_name}}</a></dd>
                              @endforeach
                          </dl>
                          @endif
                          </li>
                      @endforeach
                      @endif
                  </ul>
                  
                  
                  
                  </a>
              </dd>
              <dd><a onClick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onClick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">欢迎{{session('login')->admin_name}}登录</a>
                      <!-- 二级菜单 -->
            <dl class="layui-nav-child"> 
              <dd><a onClick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
              <dd><a onClick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
              <dd><a href="/loginapp">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="#">前台首页</a></li>
        </ul>


    </div>
@section('tops')
    