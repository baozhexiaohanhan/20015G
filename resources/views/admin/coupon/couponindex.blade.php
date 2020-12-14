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

<div class="x-body">
    <table class="layui-table layui-form">
        <thead>
        <tr>
            <th>优惠活动ID</th>
            <th>优惠活动名称</th>
            <th>优惠开始时间</th>
            <th>优惠结束时间</th>
            <th>享受优惠会员等级</th>
            <th>金额下限</th>
            <th>金额上限</th>
            <th>优惠方式</th>
            <th>优惠范围</th>
            <th>优惠金额</th>
            <th>操作</th>
        </tr>
        </thead>
        @foreach($data as $v)
        <thead>
        <tr>
            <td>{{$v->coupon_id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->start_time}}</td>
            <td>{{$v->end_time}}</td>
            <td>@if($v->user_rank==0)非会员 @elseif($v->user_rank==1)VIP @elseif($v->user_rank==2)注册用户 @elseif($v->user_rank==3)代销用户@endif</td>
            <td>{{$v->min_amount}}</td>
            <td>{{$v->max_amount}}</td>
            <td>@if($v->type==0)享受现金减免@endif</td>
            <td>{{$v->range}}</td>
            <td>{{$v->type_ext}}</td>
            <td>
                <a href="{{url('coupon/edit/'.$v->coupon_id)}}"><i class="layui-icon">&#xe642;</i>编辑</a>
                <a href="{{url('coupon/destroy/'.$v->coupon_id)}}"><i class="layui-icon">&#xe640;</i>删除</a>
            </td>
        </tr>
        </thead>
        @endforeach
    </table>
</div>
</body>
</html>
