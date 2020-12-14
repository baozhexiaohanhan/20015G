@section('title', '个人中心')
    @include('index.lay.tops')
    @section('tops2')
	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="index.html"><img src="/static/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
				<div class="title">个人中心</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			@include('index.lay.left')
    @section('left')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-浏览历史</div>
					<div class="collection-list__area clearfix">
					@foreach($history as $k=>$v)
					<div class="item-card">
							<a href="/details/?goods_id={{$v['goods_id']}}" class="photo">
								<img src="{{$v['goods_img']}}" alt="{{$v['goods_name']}}" class="cover">
								<div class="name">{{$v['goods_name']}}</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>{{$v['goods_price']}}</div>
								<div class="sale"><a href="">浏览历史</a></div>
							</div>
							
								<div class="price">{{date('Y-m-d H:i:s',$v['look_time'])}}</div>
							
						</div>
						@endforeach
					</div>
					<!-- <div class="page text-right clearfix">
						<a class="disabled">上一页</a>
						<a class="select">1</a>
						<a href="">2</a>
						<a href="">3</a>
						<a class="" href="">下一页</a>
						<a class="disabled">1/3页</a>
					</div> -->
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
	<!-- 底部信息 -->
	   @include('index.lay.bottom')
@section('bottom')