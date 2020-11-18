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
<form action="{{url('/coupon/update')}}" method="post">
    @foreach($data as $v)
        <input type="hidden" name="coupon_id" value="{{$v->coupon_id}}">
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form" action="" lay-filter="component-form-element">
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">优惠券名称：</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$v->name}}">
                        </div>
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">发行总量：</label>
                        <div class="layui-input-block">
                            <input type="text" name="total" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$v->total}}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠形式：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="shape" value="1" title="" @if($v->shape == 1)checked @endif>指定现金<input type="text" name="shape_pic" id="" value="{{$v->shape_pic}}">元<br>
                        <input type="radio" name="shape" value="2" title="" @if($v->shape == 2)checked @endif> 折扣
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">使用门槛：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="condition" value="1" title="" @if($v->condition == 1)checked @endif>不限制<br>
                        <input type="radio" name="condition" value="2" title="" @if($v->condition == 2)checked @endif>满<input type="text" name="condition_pic" id="" value="{{$v->condition_pic}}">元即可用
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">每人限领：</label>
                        <div class="layui-input-block">
                            <input type="text" name="number" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$v->number}}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">使用范围：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="range" value="1" title="" @if($v->range == 1)checked @endif>全店商品
                        <input type="radio" name="range" value="2" title="" @if($v->range == 2)checked @endif>指定商品
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">有效期：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="state" value="1" title="" @if($v->state == 1)checked @endif>固定日期<br>
                        生效日期：<input type="date" name="start_time" id="" value="{{$v->start_time}}"><br>
                        失效日期：<input type="date" name="end_time" id="" value="{{$v->end_time}}"><br>
                        <input type="radio" name="state" value="2" title="" @if($v->state == 2)checked @endif>领到优惠券当日开始2天有效<br>
                        <input type="radio" name="state" value="3" title="" @if($v->state == 3)checked @endif>领到优惠券次日开始2天有效<br>
                    </div>
                </div>
                <div class="layui-card">
                    <div class="layui-card-header">使用说明：</div>
                    <div class="layui-card-body layui-row layui-col-space10">
                        <div class="layui-col-md12">
                            <textarea name="explain" placeholder="请输入" class="layui-textarea" value="{{$v->explain}}"></textarea>
                        </div>
                    </div>
                </div>
                @endforeach
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