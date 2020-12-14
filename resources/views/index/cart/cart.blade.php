@section('title', '购物车')
    @include('index.lay.tops')
    @section('tops2')
	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="index.html"><img src="/static/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
				<div class="title">购物车</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车</div>
				<form action="/shopcart" class="shopcart-form__box">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="150">
									<label class="checked-label"><input type="checkbox" class="check-all" name="cartcheck[]"><i></i> 全选</label>
								</th>
								<th width="300">商品信息</th>
								<th width="150">单价</th>
								<th width="200">数量</th>
								<th width="200">现价</th>
								<th width="80">操作</th>
							</tr>
						</thead>
						
						<tbody>
							@if(isset($cart['info']))
							@foreach($cart['info'] as $k=>$v)
							<tr>
								<td>
									<label class="checked-label"><input type="checkbox" class="cartseller parent_{{$v['seller_id']}}" value="{{$v['seller_id']}}"><i></i>{{$v['true_name']}}</label>

									
								</td>
							</tr>
							@foreach($v['child'] as $kk=>$vv)
							<tr>
								<th scope="row">
									<label class="checked-label">
										@if($vv['is_up']==2)
										@endif
										@if($vv['is_up']==1)
										<input type="checkbox" name="checkbox" id="cartid" class="cartseller seller_{{$vv['seller_id']}}" seller_id="{{$vv['seller_id']}}" value="{{$vv['rec_id']}}">
										@endif
										<i></i>
										<a href="/details/?goods_id={{$vv['goods_id']}}" class="img"><img src="{{$vv['goods_img']}}" alt="" style="width: 173.2px;height: 240px;" class="cover"></a>
									</label>
								</th>
								<td>
									@if($vv['is_up']==2)
									<div href="/details/?goods_id={{$vv['goods_id']}}" class="name ep3" style="color:#888;">{{$vv['goods_name']}}
									</div>
									<div style="color:#888;">商品已下架</div>
									@endif
									@if($vv['is_up']==1)
									<a href="/details/?goods_id={{$vv['goods_id']}}" class="name ep3">{{$vv['goods_name']}}</a>
									@endif
									<div class="type c9">
										@if(isset($vv['goods_attr']))
										@foreach($vv['goods_attr'] as $attr)
										{{$attr['attr_name']}}:{{$attr['attr_value']}}
										@endforeach
										@endif
									</div>
								</td>
								<td>
									¥{{$vv['goods_price']}}
									<br>
									<span style="color:red;line-height:200px;font-size:20px;">{{$vv['name']}}</span>
								</td>
								<td>
									<div class="cart-num__box">

									<input type="button" id="sub" class="increment mins" cart="{{$vv['rec_id']}}" goods_id="{{$vv['goods_id']}}" goods_attr_id="{{$vv['goods_attr_id']}}" value="-">
									<input type="text" class="val" cart="{{$vv['rec_id']}}" goods_id="{{$vv['goods_id']}}" goods_attr_id="{{$vv['goods_attr_id']}}" value="{{$vv['buy_number']}}" maxlength="2">
									<input type="button" id="add" class="increment plus" cart="{{$vv['rec_id']}}" goods_id="{{$vv['goods_id']}}" goods_attr_id="{{$vv['goods_attr_id']}}" value="+">
									</div>
									<span style="color: red;" id="sadd"></span>
								</td>
								<td><span class="sum">￥{{$vv['buy_number']*$vv['goods_price']}}.00</span></td>
								<td><a href="javascript:void(0)" onclick="deleteById({{$vv['rec_id']}})" >删除</a></td>
							</tr>
							@endforeach
							@endforeach
							@endif
						</tbody>

					</table>
					<div class="user-form-group tags-box shopcart-submit pull-right">
						<div class="btn">提交订单</div>
					</div>
					<div class="checkbox shopcart-total">
						<label><input type="checkbox" class="check-all"><i></i> 全选</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="moredel">删除选中的商品</a>
						<div class="pull-right">
							<!-- 已选商品 <span>2</span> 件 -->
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
							<b class="cr">¥<span class="fz24">0.00</span></b>
						</div>
					</div>
					<script>

					$('.btn').click(function(){
							var rec_id = new Array();

							$('#cartid:checked').each(function(){
								rec_id.push($(this).val());
							});
							// console.log(rec_id);return;
							if(!rec_id.length){
								alert('选择购买的商品');
								return; 
							}
							location.href="/shopcart?rec_id="+rec_id;
						})

						$(document).ready(function(){
							var $item_checkboxs = $('.shopcart-form__box tbody input[type="checkbox"]'),
								$check_all = $('.check-all');
							// 全选
							$check_all.on('change', function() {
								$check_all.prop('checked', $(this).prop('checked'));
								$item_checkboxs.prop('checked', $(this).prop('checked'));
								var cart_id = new Array();
								$("input[name='checkbox']:checked").each(function(){
									cart_id.push($(this).val());
								})
								$.get("/getcartprice",{cart_id:cart_id},function(res){
									if(res.code=='0'){
										$('.fz24').text(res.data.total);
									}
								},'json')
							});

							
							// 点击选择
							$item_checkboxs.on('change', function() {
								var flag = true;
								$item_checkboxs.each(function() {
									if (!$(this).prop('checked')) { flag = false }
								});
								$check_all.prop('checked', flag);
							});
							// // 个数限制输入数字
							// $('input.val').onlyReg({reg: /[^0-9.]/g});
							// // 加减个数
							// $('.cart-num__box').on('click', '.sub,.add', function() {
							// 	var value = parseInt($(this).siblings('.val').val());
							// 	if ($(this).hasClass('add')) {
							// 		$(this).siblings('.val').val(Math.min((value += 1),99));
							// 	} else {
							// 		$(this).siblings('.val').val(Math.max((value -= 1),1));
							// 	}
							// });
							$(function(){
								// 文本框的失去焦点事件
								$(document).on("blur",".val",function(){
									var _this=$(this);
									// alert(_this);
									//获取商品数量
									var buy_number=_this.val();
									// alert(buy_number);
									var reg=/^\d{1,}$/;
					                if(buy_number==''){
					                    _this.val(1);
					                    buy_number=1;
					                }else if(!reg.test(buy_number)){
					                     _this.val(1);
					                     buy_number=1;
					                }else{
					                    _this.val(parseInt(buy_number));
					                    buy_number=parseInt(buy_number);
					                }
									if(buy_number==0){
										_this.parents("tr").find(".sum").text("0.00");
									}
									//获取购物车id
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get('/cartplus',{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){										
										 	if(res.code==0000){
													_this.parents("tr").find(".sum").text('￥'+res.data);
													var cart_id = new Array();
													$("input[name='checkbox']:checked").each(function(){
														cart_id.push($(this).val());
													})
													$.get("/getcartprice",{cart_id:cart_id},function(res){
														if(res.code=='0'){
																$('.fz24').text(res.data.total);
															}
													})
												}
												if(res.code==0001){
													_this.val(res.data);
												}
												if(res.code==0001){
													_this.parent().next().html("最多只能购买"+res.data+"件");
												}

									},'json')
								})
								//给+绑定一个点击事件
								$(document).on('click','#add',function(){
									var _this=$(this);
									var buy_number=parseInt(_this.prev('input').val());
									buy_number=buy_number+1;
									_this.prev('input').val(buy_number);
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get("/cartplus",{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){
										// alert(res);return;
										if(res.code==0000){
											_this.parents("tr").find(".sum").text('￥'+res.data);
											// console.log(res.data);
											var cart_id = new Array();
											$("input[name='checkbox']:checked").each(function(){
												cart_id.push($(this).val());
											})
											$.get("/getcartprice",{cart_id:cart_id},function(res){
												if(res.code=='0'){
														$('.fz24').text(res.data.total);
													}
												// console.log(res);
											},'json')
										}
										if(res.code==0001){
											// console.log(res);
											_this.prev().val(res.data);
										}
										if(res.code==0001){
											_this.parent().next().html();
										}

									},'json')
								})
								//给-绑定一个点击事件
								$(document).on('click','#sub',function(){
									var _this=$(this);
									var buy_number=parseInt(_this.next('input').val());
									if(buy_number<=1){
						                _this.next('input').val(1);
						            }else{
						                buy_number=buy_number-1;
						                _this.next('input').val(buy_number);
									}
									//获取购物车id
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get("/cartplus",{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){
										if(res.code==0000){
											_this.parents("tr").find(".sum").text('￥'+res.data);
											// console.log(res.data);
											var cart_id = new Array();
											$("input[name='checkbox']:checked").each(function(){
												cart_id.push($(this).val());
											})
											$.get("/getcartprice",{cart_id:cart_id},function(res){
												if(res.code=='0'){
														$('.fz24').text(res.data.total);
													}
												// console.log(res);
											},'json')
										}
										if(res.code==0001){
											// console.log(res);
											_this.prev().val(res.data);
										}
										if(res.code==0001){
											_this.parent().next().html();
										}
									},'json')
								})
								
							});
						});


			
						$(document).on("click",".cartid",function(){
							var cart_id = new Array();
							$("input[name='checkbox']:checked").each(function(){
								cart_id.push($(this).val());
							})
							$.get("/getcartprice",{cart_id:cart_id},function(res){
								if(res.code=='0'){
										$('.fz24').text(res.data.total);
									}
							},'json')
						});

						//ajax删除
						   function deleteById(rec_id){
						   	// alert(123);return;
						        if(!rec_id){
						            return;
						        }
						        $.get('/cart/destroy/'+rec_id,function(res){
						            alert(res.msg);
						            location.reload();
						        },'json')
						    };
						    //批量删除
							$(document).on('click','.moredel',function(){
								var ids=new Array;
								$("input[name='checkbox']:checked").each(function(){
									ids.push($(this).val());
									// alert(ids);return;
								});
								$.get('/cart/destroys/',{ids:ids},function(res){
						            alert(res.msg);
						            location.reload();
						        },'json')
							});

							$('.cartseller').click(function(){
								// alert(123);
								var checkedval=$(this).prop('checked');
								// //属于商家的全选
								var val=$(this).val();
								// alert(val);
								$(this).parents('td').parent('tr').siblings("tr").find(".seller_"+val).prop('checked',checkedval);
								var seller_id=$(this).attr('seller_id');
								// alert(seller_id);
								$(this).parents('table').find('.parent_'+seller_id).prop('checked',checkedval);
								var cart_id = new Array();
								$("input[name='checkbox']:checked").each(function(){
									cart_id.push($(this).val());
								})
								$.get("/getcartprice",{cart_id:cart_id},function(res){
									if(res.code=='0'){
											$('.fz24').text(res.data.total);
										}
								},'json')
							})

					</script>
				</form>
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