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
<form action="{{url('/coupon/store')}}" method="post">
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form" action="" lay-filter="component-form-element">
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">优惠券名称：</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-card-body layui-row layui-col-space10">
                    <label class="layui-form-label">优惠范围：</label>
                    <div class="layui-col-md6">
                        <select name="range" lay-verify="">
                            <option value="0">全部商品</option>
                            @foreach($goods as $v)
                                <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-card layui-form" lay-filter="component-form-element">
                    <div class="layui-card-body layui-row layui-col-space10">
                        <div class="layui-col-md12">
                            <label class="layui-form-label">享受优惠的会员等级：</label>
                            <input type="checkbox" name="user_rank" title="非会员" value="0">
                            <input type="checkbox" name="user_rank" title="vip" value="1">
                            <input type="checkbox" name="user_rank" title="注册用户" value="2">
                            <input type="checkbox" name="user_rank" title="代销用户" value="3">
                        </div>
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">金额上限：</label>
                        <div class="layui-input-block">
                            <input type="text" name="max_amount" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">金额下限：</label>
                        <div class="layui-input-block">
                            <input type="text" name="min_amount" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-card-body layui-row layui-col-space10">
                    <label class="layui-form-label">优惠方式：</label>
                    <div class="layui-col-md6">
                        <select name="type" id="act_type" lay-verify="" >
                            <option value="0" selected="selected">享受赠品（特惠品）</option>
                            <option value="1">享受现金减免</option>
                            <option value="2">享受价格折扣</option>
                        </select>
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">开始时间：</label>
                        <div class="layui-input-block">
                            <input type="date" name="start_time" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">结束时间：</label>
                        <div class="layui-input-block">
                            <input type="date" name="end_time" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
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