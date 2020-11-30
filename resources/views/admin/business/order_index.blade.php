@extends('admin.lay.js')
     @section('js')
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a>商家后台</a>
        <a>
          <cite>订单列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <!-- <form class="layui-form layui-col-md12 x-so">
          <input class="layui-input" placeholder="开始日" name="start" id="start">
          <input class="layui-input" placeholder="截止日" name="end" id="end">
          <div class="layui-input-inline">
            <select name="contrller">
              <option>支付状态</option>
              <option>已支付</option>
              <option>未支付</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <select name="contrller">
              <option>支付方式</option>
              <option>支付宝</option>
              <option>微信</option>
              <option>货到付款</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <select name="contrller">
              <option value="">订单状态</option>
              <option value="0">待确认</option>
              <option value="1">已确认</option>
              <option value="2">已收货</option>
              <option value="3">已取消</option>
              <option value="4">已完成</option>
              <option value="5">已作废</option>
            </select>
          </div>
          <input type="text" name="username"  placeholder="请输入订单号" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form> -->
      </div>
      <!-- <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','./order-add.html')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock> -->
      <table class="layui-table">
        <thead>
          <tr>
            <th>订单编号</th>
            <th>收货人</th>
            <th>总金额</th>
            <th>应付金额</th>
            <th>订单状态</th>
            <th>支付状态</th>
            <th>发货状态</th>
            <th>支付方式</th>
            <th>配送方式</th>
            <th>下单时间</th>
            </tr>
        </thead>
        <tbody>
        @foreach($res as $k=>$v)
          <tr>
            <td>{{$v->order_sn}}</td>
            <td>{{$v->consignee}}:{{$v->tel}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->order_price}}</td>
            <td>{{$v->order_status}}
            @if($v->order_status==1)
              已确认
            @endif
            @if($v->order_status==0)
              未确认
            @endif
            @if($v->order_status==2)
              已取消
            @endif
            </td>
            <td>
            @if($v->pay_status==1)
              已付款
            @endif
            @if($v->pay_status==0)
              待付款
            @endif
            </td>
            <td>
            @if($v->is_send==0)
              未发货
            @endif
            @if($v->is_send==1)
              已发货
            @endif
            @if($v->is_send==2)
              已收货
            @endif
            @if($v->is_send==3)
              已退款
            @endif
            </td>
            <td>
            @if($v->pay_type==1)
              微信
            @endif
            @if($v->pay_type==2)
              支付宝
            @endif
            @if($v->pay_type==3)
              货到付款
            @endif
            </td>
            <td>物流</td>
            <td>{{date("Y-m-d H:i:s",$v->addtime)}}</td>
            <td class="td-manage">
           
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
     

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
  </body>

</html>