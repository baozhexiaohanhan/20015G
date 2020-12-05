@section('title', '秒杀')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')

	<div class="content inner">
		<section class="filter-section clearfix">
			<ol class="breadcrumb">
				<li><a href="index.html">首页</a></li>
				<li class="active">秒杀专区</li>
			</ol>
			<div class="filter-box">
				<div class="all-filter">
					<div class="filter-value">
						<a href="" class="sale-title active">秒杀专区</a>
						
					</div>
				</div>
			</div>
			<div class="sort-box bgf5">
				<div class="sort-text"></div>
				<!-- <a href=""><div class="sort-text"> <i class="iconfont icon-sortDown"></i></div></a> -->
				<!-- <a href=""><div class="sort-text"> <i class="iconfont icon-sortUp"></i></div></a> -->
				<!-- <a href=""><div class="sort-text"> <i class="iconfont"></i></div></a> -->
				<div class="sort-total pull-right"></div>
			</div>
		</section>
		<section class="item-show__div clearfix">
			<div class="pull-left">
				<div class="item-list__area clearfix zuo">
                @foreach($res as $k=>$v)
					<div class="item-card shi">
							<a href="/miaosha_show?goods_id={{$v['goods_id']}}&seckill_id={{$v['id']}}" class="photo">
							<!-- <a href="/details/?goods_id={{$v['goods_id']}}" class="photo"> -->
					
							<img src="{{$v['goods_img']}}" alt="" class="cover">
							<div class="name">{{$v['goods_name']}}</div></a>
						<div class="middle">
							<div class="price"><small>￥</small>{{$v['price']}}</div>
							<div class="sale no-hide">
								<p id="time"></p>
								<h6 id="times" time="{{date('Y-m-d H:i:s',$v['start_time'])}}"> 结束时间:{{date("H:i:s",$v['end_time'])}}</h6>
							</div>
						</div>
                        <div class="buttom">
							<div>原价 {{$v['yuan']}} 秒杀降价{{$v['yuan']-$v['price']}}.00</div>
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
				<!-- <div class="page text-right clearfix">
					<a class="disabled">上一页</a>
					<a class="select">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">4</a>
					<a href="">5</a>
					<a class="" href="">下一页</a>
					<a class="disabled">1/5页</a>
				</div> -->
			</div>
			<div class="pull-right">
				
				<div class="desc-segments__content">
					<div class="lace-title">
						<span class="c6">爆款推荐</span>
					</div>
					<div class="picked-box">
						<a href="" class="picked-item"><img src="/static/images/temp/S-001.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-002.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-003.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-004.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-005.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-006.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-007.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-008.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-009.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/static/images/temp/S-010.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
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
	<script>
		// $(document).ready(function(){
		// 	// var times = $("#times").attr("time");
		// 	var times = $(".zuo").find('.shi').find(".middle").find("div").find("#times").attr("time");
		// 	// var times = new Date("date('Y-m-d H:i:s'");
		// 	// var nowtime = new Date("date('Y-m-d H:i:s')");
		// 	function getNow(s) {
		// 		return s < 10 ? '0' + s: s;
		// 	}
		// 	var myDate = new Date();             
		// 	var year=myDate.getFullYear();        //获取当前年
		// 	var month=myDate.getMonth()+1;   //获取当前月
		// 	var date=myDate.getDate();            //获取当前日


		// 	var h=myDate.getHours();              //获取当前小时数(0-23)
		// 	var m=myDate.getMinutes();          //获取当前分钟数(0-59)
		// 	var s=myDate.getSeconds();
		// 	var now=year+'-'+getNow(month)+"-"+getNow(date)+" "+getNow(h)+':'+getNow(m)+":"+getNow(s);
		// 	// console.log(now);

			
		
		// 	// if(times>now){
		// 	// 	
		// 	// }
		// 	// console.log(now);
		// })
	
	</script>
	<!-- 底部信息 -->
	@include('index.lay.bottom')
@section('bottom')