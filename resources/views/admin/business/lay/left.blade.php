
<div class="left-nav">
<div id="side-nav">

             <ul id="nav">
             <li >
                <a href="javascript:;">
                    <i class="iconfont">&#xe6eb;</i>
                    <cite>统计结算模块</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li><a _href="/business/statistics"><i class="iconfont">&#xe6a7;</i><cite>统计</cite></a></li >
                </ul>
            </li>
             <li >
                <a href="javascript:;">
                    <i class="iconfont">&#xe6e4;</i>
                    <cite>商品 sku</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li><a _href="{{url('/skus/sku')}}"><i class="iconfont">&#xe6a7;</i><cite>添加商品</cite></a></li>
                    <li><a _href="{{url('/skus/goods/product_index')}}"><i class="iconfont">&#xe6a7;</i><cite>商品展示</cite></a></li>
                    <li>
                        <a href="javascript:;"><i class="iconfont">&#xe6f6;</i><cite>类型 属性 添加</cite><i class="iconfont nav_right">&#xe6a7;</i></a>
                        <ul class="sub-menu">
                            <li><a _href="{{url('/skus/type')}}"><i class="iconfont">&#xe6a7;</i><cite>商品类型添加</cite></a></li>
                            <li><a _href="{{url('/skus/type_index')}}"><i class="iconfont">&#xe6a7;</i><cite>商品类型展示</cite></a></li>
                           
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="iconfont">&#xe6f6;</i><cite>订单模块</cite><i class="iconfont nav_right">&#xe6a7;</i></a>
                <ul class="sub-menu">
                    <li><a _href="{{url('/business/order_index')}}"><i class="iconfont">&#xe6a7;</i><cite>订单列表</cite></a></li>
                </ul>
            </li>
             <li >
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b4;</i>
                    <cite>配置模块</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <!-- <li><a _href="html/grid.html"><i class="iconfont">&#xe6a7;</i><cite>发货地址</cite></a></li> -->
                    <li><a _href="/business/user_up"><i class="iconfont">&#xe6a7;</i><cite>资料修改</cite></a></li>
                </ul>
            </li>
        </ul>
      </div>
    </div>
     @section('sidebar') 
