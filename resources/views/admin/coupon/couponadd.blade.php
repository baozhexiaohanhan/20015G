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
                        {{--<input type="radio" name="range" id="" value="1">全部商品--}}
                        {{--<input type="radio" name="range" id="" value="2">指定商品--}}
                        <select name="range" lay-verify="">
                            <option value="">   </option>
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
                            <input type="radio" name="user_rank" title="非会员" value="0">
                            <input type="radio" name="user_rank" title="vip" value="1">
                            <input type="radio" name="user_rank" title="注册用户" value="2">
                            <input type="radio" name="user_rank" title="代销用户" value="3">
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
                        <input type="radio" name="type" id="" value="0">享受赠品
                        <input type="radio" name="type" id="" value="1">享受现金减免
                        <input type="radio" name="type" id="" value="2">享受价格折扣
                    </div>
                </div>
                <div class="layui-row layui-col-space10 layui-form-item">
                    <div class="layui-col-lg6">
                        <label class="layui-form-label">优惠金额或折扣：</label>
                        <div class="layui-input-block">
                            <input type="text" name="type_ext" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
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