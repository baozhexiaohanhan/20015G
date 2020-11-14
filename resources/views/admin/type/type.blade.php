@extends('admin.lay.js')
     @section('js')
<form class="layui-form" >
</form>

  <div class="layui-form-item">
    <label class="layui-form-label">商品类型名</label>
    <div class="layui-input-block">
      <input type="text" name="cat_name" id="cat_name" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/jquery.js" charset="utf-8"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});


</script>
<script>
 $(document).on("click",".btn",function(){
        var cat_name = $("#cat_name").val();
        $.get("{{url('/type_add')}}",{"cat_name":cat_name},function(res){
            // if(res.code==100){
            // console.log(res);
            location.href="{{url('/type_index')}}";
            // }
        })
        
    })

</script>