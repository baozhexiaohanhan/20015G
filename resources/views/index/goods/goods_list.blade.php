@section('title', 'U 袋网')
@include('index.lay.top')
@section('tops')
<div class="content inner">
    <section class="filter-section clearfix">
        <ol class="breadcrumb">
            <li><a href="index.html">首页</a></li>
            <li class="active">商品筛选</li>
        </ol>
        <div class="filter-box">
            <div class="all-filter">
                <div class="filter-value">
                    <div class="filter-title">选择商品分类 <i class="iconfont icon-down"></i></div>
                    <!-- 全部大分类 -->
                    <ul class="catelist-card">
                        <a href=""><li class="active">全部分类</li></a>
                        @foreach($cateall as $v)
                        <a href="">
                            <li class="active">{{$v->cate_name}}</li>
                        </a>
                        @endforeach
                    </ul>
                    <!-- 已选选项 -->
                    <div class="ul_filter">
							<span class="pull-left">
								颜色：红色 <a href="javascript:;" class="closediv">&times;</a>
							</span>
                        <span class="pull-left">
								尺寸：XXL <a href="javascript:;" class="close">&times;</a>
							</span>
                    </div>
                    <a class="reset pull-right" href="item_category.html">重置</a>
                </div>
            </div>
            <div class="filter-prop-item">
                <span class="filter-prop-title">分类：</span>
                <ul class="clearfix">
                    <a href=""><li class="active">全部</li></a>
                    @foreach($cate as $v)
                    <a href=""><li>{{$v->cate_name}}</li></a>
                    @endforeach
                </ul>
            </div>
            <div class="filter-prop-item">
                <span class="filter-prop-title">品牌：</span>
                <ul class="clearfix">
                    <a href=""><li class="active">全部</li></a>
                    @foreach($brand as $v)
                    <a href=""><li>{{$v->brand_name}}</li></a>
                    @endforeach
                </ul>
            </div>
            {{--<div class="filter-prop-item">--}}
                {{--<span class="filter-prop-title">尺寸：</span>--}}
                {{--<ul class="clearfix">--}}
                    {{--<a href=""><li class="active">全部</li></a>--}}
                    {{--<a href=""><li>L</li></a>--}}
                    {{--<a href=""><li>M</li></a>--}}
                    {{--<a href=""><li>S</li></a>--}}
                    {{--<a href=""><li>X</li></a>--}}
                    {{--<a href=""><li>XL</li></a>--}}
                    {{--<a href=""><li>XXL</li></a>--}}
                    {{--<a href=""><li>XXXL</li></a>--}}
                {{--</ul>--}}
            {{--</div>--}}
            <div class="filter-prop-item">
                <span class="filter-prop-title">价格：</span>
                <ul class="clearfix">
                    <a href=""><li class="active">全部</li></a>
                    <a href=""><li>0-20</li></a>
                    <a href=""><li>20-40</li></a>
                    <a href=""><li>40-80</li></a>
                    <a href=""><li>80-100</li></a>
                    <a href=""><li>100-150</li></a>
                    <a href=""><li>150以上</li></a>
                    <form class="price-order">
                        <input type="text">
                        <span class="cc">-</span>
                        <input type="text">
                        <input type="button" value="确定">
                    </form>
                </ul>
            </div>
        </div>
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
                @foreach($list as $v)
                <div class="item-card list">
                    <a href="item_show.html" class="photo">
                        <img src="{{$v->goods_img}}" alt="{{$v->goods_name}}" class="cover">
                        <div class="name">{{$v->goods_name}}</div>
                    </a>
                    <div class="middle">
                        <div class="price"><small>￥</small>{{$v->goods_price}}</div>
                        <div class="sale"><a href="">加入购物车</a></div>
                    </div>
                    <div class="buttom">
                        <div>销量 <b>666</b></div>
                        <div>人气 <b>888</b></div>
                        <div>评论 <b>1688</b></div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- 分页 -->
            <div class="page text-right clearfix">
                <a class="disabled">上一页</a>
                <a class="select">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a class="" href="">下一页</a>
                <a class="disabled">1/5页</a>
                <form action="" class="page-order">
                    到第
                    <input type="text" name="page">
                    页
                    <input class="sub" type="submit" value="确定">
                </form>
            </div>
        </div>
        <div class="pull-right">

            <div class="desc-segments__content">
                <div class="lace-title">
                    <span class="c6">爆款推荐</span>
                </div>
                <div class="picked-box">
                    <a href="" class="picked-item"><img src="images/temp/S-001.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-002.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-003.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-004.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-005.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-006.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-007.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-008.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-009.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                    <a href="" class="picked-item"><img src="images/temp/S-010.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
                </div>
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
