@include('admin.lay.top')
     @section('tops')
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <script>alert('{{ $error }}')</script>
                @endforeach
            </ul>
        </div>
    @endif
<div class="layui-card">
    <div class="layui-card-body">
        <form class="layui-form" action="" lay-filter="component-form-element">
        <input type="hidden" name="cate_id" value="{{$data->cate_id}}">
            <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                    <label class="layui-form-label">分类名称：</label>
                    <div class="layui-input-block">
                        <input type="text" name="cate_name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$data->cate_name}}">
                    </div>
                </div>
            </div>
                <div class="layui-col-lg6">
                    <label class="layui-form-label">所属分类：</label>
                    <div class="layui-input-block">
                        <select name="pid" lay-filter="aihao">
                            <option value="0">请选择</option>
                            @foreach($Category as $k=>$vv)
                                <option value="{{$data->pid}}" @if($data->pid==$vv->cate_id) selected @endif>{{str_repeat('--',$vv->level*3)}}{{$vv->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否显示：</label>
                <div class="layui-input-block">
                    是：<input type="radio" name="cate_show" value="1" title="" @if($data->cate_show == 1)checked @endif>
                    否：<input type="radio" name="cate_show" value="2" title="" @if($data->cate_show == 2)checked @endif>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否显示在导航栏：</label>
                <div class="layui-input-block">
                    是：<input type="radio" name="cate_new_show" value="1" title="是" @if($data->cate_new_show == 1)checked @endif>
                    否：<input type="radio" name="cate_new_show" value="2" title="否" @if($data->cate_new_show == 2)checked @endif>
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
</form>
</body>

</html>