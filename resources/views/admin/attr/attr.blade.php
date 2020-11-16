@extends('admin.lay.js')
@section('js')
     <form  action="/attr_add" method='post' style="margin-top:20px;">
     <div class="layui-tab-item layui-show">

    <div class="layui-form-item">
            <label class="layui-form-label">属性名</label>
        <div class="layui-input-block">
            <input type="text" name="attr_name" lay-verify="title" autocomplete="off"  class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">所属商品类型</label>
        <div class="layui-input-block">
            <select name="cat_id" lay-filter="aihao">
                <option value=""selected=""></option>
                @foreach($res as $k=>$v)
                <option value="{{$v->cat_id}}" @if($v->cat_id==$cat_id) selected @endif >{{$v->cat_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
   
        <div class="layui-form-item">
            <label class="layui-form-label">属性可选:</label>
            <div class="layui-input-block">
            <input type="radio" name="attr_type" value="0" checked>  属性 
            <input type="radio" name="attr_type" value="1" > 规格
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">录入方式:</label>
            <div class="layui-input-block">
            <input type="radio" name="attr_input_type" value="0" checked> 手工录入    
            <input type="radio" name="attr_input_type" value="1" > 下拉录入
            </div>
        </div>

        <div class="layui-form-item">
        <label class="layui-form-label">可选值列表:</label>
        <div class="layui-input-block">
                <textarea name="attr_values" id="" cols="30" rows="10" disabled="disabled"></textarea>
        </div>
        </div>
<button type="submit" style="margin-left:35px; margin-top:20px;" class="layui-btn">添加</button>
</div>
</form>
<script type="text/javascript" src="/admin/jquery.js" charset="utf-8"></script>
<script>
    $(document).on("click","input[name='attr_input_type']",function(){
        var attr_input_type = $(this).val();
        // console.log(attr_input_type);
        if(attr_input_type==1){
            $("textarea").removeAttr("disabled");
        }else{
            $("textarea").attr("disabled","disabled");
        }
    })

</script>