@section('title', 'U 袋网 列表')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')
    <div class="content inner">
        <section class="filter-section clearfix">
            <ol class="breadcrumb">
                <li><a href="index.html">首页</a></li>
                <li class="active">商品筛选</li>
            </ol>
            <div class="sort-box bgf5">
                <div class="sort-text">排序：</div>
                <a href=""><div class="sort-text">销量 <i class="iconfont icon-sortDown"></i></div></a>
                <a href=""><div class="sort-text">评价 <i class="iconfont icon-sortUp"></i></div></a>
                <a href=""><div class="sort-text">价格 <i class="iconfont"></i></div></a>
            </div>
        </section>
        <section class="item-show__div clearfix">
            <div class="pull-left">
              <div class="item-list__area clearfix">
                    @foreach($data as $k=>$v)
                    <div class="item-card">

                        <a href="/details/?goods_id={{$v->goods_id}}" class="photo">
                            <img src="{{$v->goods_img}}" class="cover">
                            <div class="name">{{$v->goods_name}}</div>
                            <input type="hidden" name="goods_name">
                        </a>
                        <div class="middle">
                            <div class="price"><small>￥</small>{{$v->goods_price}}</div>
                            <!-- <div class="sale"><a href="">加入购物车</a></div> -->
                        </div>
                        <div class="buttom">
                            <div>销量 <b>666</b></div>
                            <div>人气 <b>888</b></div>
                            <div>评论 <b>1688</b></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!-- 右侧菜单 -->
    <div class="right-nav">
        <ul class="r-with-gotop">
            <li class="r-toolbar-item">
                <a href="udai_welcome.html" class="r-item-hd">
                    <i class="iconfont icon-user" data-badge="0"></i>
                    <div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="udai_shopcart.html" class="r-item-hd">
                    <i class="iconfont icon-cart"></i>
                    <div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="udai_collection.html" class="r-item-hd">
                    <i class="iconfont icon-aixin"></i>
                    <div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="" class="r-item-hd">
                    <i class="iconfont icon-liaotian"></i>
                    <div class="r-tip__box"><span class="r-tip-text">联系客服</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="issues.html" class="r-item-hd">
                    <i class="iconfont icon-liuyan"></i>
                    <div class="r-tip__box"><span class="r-tip-text">留言反馈</span></div>
                </a>
            </li>
            <li class="r-toolbar-item to-top">
                <i class="iconfont icon-top"></i>
                <div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
            </li>
        </ul>
        <script>
            $(document).ready(function(){ $('.to-top').toTop({position:false}) });
        </script>
    </div>


@include('index.lay.bottom')
@section('bottom')