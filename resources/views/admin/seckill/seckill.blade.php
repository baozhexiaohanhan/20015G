     @include('admin.lay.top')
     @section('tops')
<form class="layui-form" action="/seckill_add" method="post">
@csrf()
    <div class="layui-form-item">
            <label class="layui-form-label">限时抢购名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
        
       <div>
            <div class="layui-form-item">
                    <label class="layui-form-label">开始日期</label>
                    <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                        <input type="text" class="layui-input" name="start_time" placeholder="2020-10-31 20:00:00" id="test1">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">结束日期</label>
                    <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                        <input type="text" class="layui-input" name="end_time" placeholder="2020-10-31 20:00:00" id="test0">
                    </div>
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
                <select name="goods_id" lay-verify="title" autocomplete="off"  class="layui-input goods_id">
                    <option value="">请选择</option>
                    @foreach($goods as $k=>$v)
                    <option value="{{$v->goods_id}}" >{{$v->goods_name}}</option>
                   @endforeach
                </select>
                <span id="tis" style="color:red"></span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">原价</label>
            <div class="layui-input-block">
                <input type="text" style="width: 200px;" lay-verify="title" autocomplete="off" placeholder="点击文本框获取原价" value="" class="layui-input jia">
            </div>
            <label class="layui-form-label">限时抢购价</label>
            <div class="layui-input-block">
                <input type="text" name="price" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">抢购数量</label>
            <div class="layui-input-block">
                <input type="text" name="number" lay-verify="title" value="" autocomplete="off" placeholder="" class="layui-input number">
            </div>
        </div>
        <div class="layui-form-item">
        <label class="layui-form-label">介绍</label>
        <div class="layui-input-block">
            <textarea name="intro" id="" cols="30" lay-verify="title" autocomplete="off"  class="layui-input" rows="10"></textarea>
        </div>
        </div>
      
      
        <button type="submit" style="margin-left:35px; margin-top:20px;" class="layui-btn">添加</button>
</form>
<script type="text/javascript" src="/admin/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
<script>
    $(document).on("click",".jia",function(){
        var goods_id = $("select[name='goods_id']").val();
        if(goods_id==""){
            $("#tis").html("请选择抢购商品");return;
        }
        console.log(goods_id);
        $.get("/seckill_jia",{"goods_id":goods_id},function(res){
            // console.log();
            $(".jia").val(res['data']);
            $(".number").val("商品总库存("+res['number']+"件)请进行设置抢购数量");
        })
    })
    // alert(111)



</script>
<script>
    
    
    // layui.use('laydate', function(){
    //   var laydate = layui.laydate;
      
    //   //执行一个laydate实例
    //   laydate.render({
    //     elem: '#test1' //指定元素
    //     ,type: 'datetime'
    //   });
    // });

    // layui.use('laydate', function(){
    //   var laydate = layui.laydate;
      
    //   //执行一个laydate实例
    //   laydate.render({
    //     elem: '#test0' //指定元素
    //     ,type: 'datetime'
    //   });
    // });

</script>

