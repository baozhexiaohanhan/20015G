@extends('admin.lay.js')
     @section('js')
<form class="layui-form" action="/seckill_add" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
@csrf()
    <div class="layui-form-item">
            <label class="layui-form-label">限时抢购名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>

       
        <div class="layui-form-item">
            <label class="layui-form-label">开始日期</label>
            <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                <input type="text" class="layui-input" name="start_time" id="test1">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">结束日期</label>
            <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                <input type="text" class="layui-input" name="end_time" id="test0">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否开启</label>
            <div class="layui-input-block">
                <input type="radio" name="is_close" value="1" title="开启" checked>        
                <input type="radio" name="is_close" value="2" title="关闭">      
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">抢购商品</label>
            <div class="layui-input-block">
                <select name="goods_id"  lay-verify="title" autocomplete="off"  class="layui-input">
                    <option value="0">请选择</option>
                    @foreach($goods as $k=>$v)
                    <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                   @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">原价</label>
            <div class="layui-input-block">
                <input type="text" name="yuan" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
            <label class="layui-form-label">限时抢购价</label>
            <div class="layui-input-block">
                <input type="text" name="price" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
        <label class="layui-form-label">介绍</label>
        <div class="layui-input-block">
            <textarea name="intro" id="" cols="30" lay-verify="title" autocomplete="off" placeholder="" class="layui-input" rows="10"></textarea>
        </div>
        </div>
      
      
        <button type="submit" style="margin-left:35px; margin-top:20px;" class="layui-btn">添加</button>
</form>
<script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
<script>
    
    
    layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //执行一个laydate实例
      laydate.render({
        elem: '#test1' //指定元素
        ,type: 'datetime'
      });
    });

    layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //执行一个laydate实例
      laydate.render({
        elem: '#test0' //指定元素
        ,type: 'datetime'
      });
    });

</script>