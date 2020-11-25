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
                        <!-- 已选选项 -->
                        <div class="ul_filter">
                            <ul>
                                <li class="close tag-brand_id" style="display: none" >品牌</li>
                                <li  class="close tag-price" style="display: none">价格</li>
                            </ul>
                        </div>
                        <a class="reset pull-right" href="item_category.html">重置</a>
                    </div>
                </div>
                <div class="filter-prop-item">
                    <span class="filter-prop-title">品牌：</span>
                    <ul class="clearfix search">
                        @foreach($data['brand'] as $v)
                            <a href="javascript:void(0)" value="{{$v['brand_id']}}" field="brand_id" title="{{$v['brand_name']}}">
                                <li @if(isset($query['brand_id']) && $query['brand_id']==$v['brand_id']) class="redhover" @endif>
                                    {{$v['brand_name']}}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="filter-prop-item">
                    <span class="filter-prop-title">价格：</span>
                    <ul class="type-list search">
                        @foreach($data['price'] as $v)
                            <a href="javascript:void(0)"  value="{{$v}}" field="price">
                                <li @if(isset($query['price']) && $query['price']==$v) class="redhover" @endif>
                                    {{$v}}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sort-box bgf5">
                <div class="sort-text">排序：</div>
                <a href=""><div class="sort-text">销量 <i class="iconfont icon-sortDown"></i></div></a>
                <a href=""><div class="sort-text">评价 <i class="iconfont icon-sortUp"></i></div></a>
                <a href=""><div class="sort-text">价格 <i class="iconfont"></i></div></a>
                <div class="sort-total pull-right">共1688个商品</div>
            </div>
        </section>
        <section class="item-show__div clearfix">
            <div class="pull-left">
                <div class="item-list__area clearfix">
                    @foreach($data['goods']['data'] as $v)
                    <div class="item-card">
                        <a href="/details/?goods_id={{$v['goods_id']}}" class="photo">
                            <img src="{{$v['goods_img']}}" class="cover">
                            <div class="name">{{$v['goods_name']}}</div>
                        </a>
                        <div class="middle">
                            <div class="price"><small>￥</small>{{$v['goods_price']}}</div>
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
                        <span class="c6">浏览历史</span>
                    </div>
                    <div class="picked-box">
                        @foreach($history['history'] as $k=>$v)
                        <a href="" class="picked-item"><img src="{{$v['goods_img']}}" alt="" class="cover"><span class="look_price">¥{{$v['goods_price']}}</span></a>
                        @endforeach
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
            $(function(){
                $('.redhover').each(function (i,k) {
                    var s_key = $(this).parent().attr('field');
                    var s_val = $(this).parent().attr('value');
                    if(s_key=='brand_id'){
                        var s_val = $(this).parent().attr('title');
                    }
                   $('.tag-'+s_key).text(s_val).show();
                });
            });
            $('.search a').click(function () {
                $(this).siblings().find('li').removeClass('redhover');
                $(this).find('li').addClass('redhover');
                var search = '';
                $('.redhover').each(function (i,k) {
                    var s_key = $(this).parent().attr('field');
                    var s_val = $(this).parent().attr('value');
                    search += s_key+ '=' +s_val+'&';
                });
                var url = "{{$url}}";
                if(search){
                     url +='?'+search.substring(0,search.length-1);
                     location.href = url;
                }
            });
        </script>
    </div>
@include('index.lay.bottom')
@section('bottom')
