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
<div class="x-nav">
    <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
</div>
<div class="x-body">
    {{--<blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>--}}
    <table class="layui-table layui-form">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th width="50">优惠券名称</th>
            <th width="50">发行总量</th>
            <th width="50">优惠形式</th>
            <th width="50">优惠金额</th>
            <th width="50">使用门槛</th>
            <th width="50">每人限领</th>
            <th width="50">使用范围</th>
            <th width="50">有效期</th>
            <th width="50">开始时间</th>
            <th width="50">结束时间</th>
            <th width="50">使用说明</th>
            <th width="280">操作</th>
        </tr>
        </thead>
        @foreach($data as $v)
        <thead>
        <tr>
            <th width="50">{{$v->coupon_id}}</th>
            <th width="50">{{$v->name}}</th>
            <th width="50">{{$v->total}}</th>
            <th width="50">@if($v->shape==1)指定现金 @elseif($v->shape==2)折扣@endif</th>
            <th width="50">{{$v->shape_pic}}</th>
            <th width="50">@if($v->condition==1)不限制 @elseif($v->condition==2)满{{$v->condition_pic}}@endif</th>
            <th width="50">{{$v->number}}</th>
            <th width="50">@if($v->shape==1)全部商品 @elseif($v->shape==2)指定商品@endif</th>
            <th width="50">@if($v->state==1)固定日期 @elseif($v->shape==2)领到优惠券当日开始2天有效 @elseif($v->shape==3)领到优惠券次日开始2天有效@endif</th>
            <th width="50">{{$v->start_time}}</th>
            <th width="50">{{$v->end_time}}</th>
            <th width="50">{{$v->explain}}</th>
            <th width="280">
                <a href="{{url('coupon/edit/'.$v->coupon_id)}}"><i class="layui-icon">&#xe642;</i>编辑</a>
                <a href="{{url('coupon/destroy/'.$v->coupon_id)}}"><i class="layui-icon">&#xe640;</i>删除</a>
            </th>
        </tr>
        </thead>
        @endforeach
    </table>
</div>
</body>
</html>
