<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('/cate/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('/cate/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('/cate/css/xadmin.css')}}">
    <script src="{{asset('/cate/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/cate/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('/cate/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<form action="{{url('/cate/update')}}" method="post">
    @foreach($data1 as $v)
    <input type="hidden" name="cate_id" value="{{$v->cate_id}}">
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form" action="" lay-filter="component-form-element">
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">分类名称：</label>
                        <div class="layui-input-block">
                            <input type="text" name="cate_name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$v->cate_name}}">
                        </div>
                    </div>
                </div>
                <div class="layui-col-lg6">
                    <label class="layui-form-label">所属分类：</label>
                    <div class="layui-input-block">
                        <select name="pid" lay-filter="aihao">
                            <option value="0">请选择</option>
                            @foreach($cate as $vv)
                                <option value="{{$vv->cate_id}}" @if($v->pid==$vv->cate_id) selected @endif>{{$vv->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示：</label>
                    <div class="layui-input-block">
                        是：<input type="radio" name="cate_show" value="1" title="" @if($v->cate_show == 1)checked @endif>
                        否：<input type="radio" name="cate_show" value="2" title="" @if($v->cate_show == 2)checked @endif>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示在导航栏：</label>
                    <div class="layui-input-block">
                        是：<input type="radio" name="cate_new_show" value="1" title="是" @if($v->cate_new_show == 1)checked @endif>
                        否：<input type="radio" name="cate_new_show" value="2" title="否" @if($v->cate_new_show == 2)checked @endif>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="component-form-element">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        @endforeach
</form>
</body>

</html>