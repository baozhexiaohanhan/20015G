@extends('admin.lay.js')
     @section('js')
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
        <span class="layui-breadcrumb">
            <a href="/">首页</a>
            <a href="/demo/">展示</a>
        </span>
        </legend>
    </fieldset>
  <table class="layui-table">
    <colgroup>
      <col width="150">
      <col width="150">
      <col width="200">
      <col>
    </colgroup>
    <div>
    
    </div>
      
    <thead>
      <tr>
        <th>id</th>
        <th>属性名</th>
        <th>所属商品类型</th>
        <th>属性是否可选</th>
        <th>该属性值的录入方式</th>
        <th>可选值列表</th>
        <th>操作  <a href="{{url('/skus/attr/'.$id)}}" class="layui-btn">添加属性</a></th>
      </tr> 
    </thead>
    <tbody>
        @foreach($res as $k=>$v)
          <tr >
            
            <td>{{$v->attr_id}}</td>
            <td>{{$v->attr_name}}</td>
            <td>{{$v->cat_name}}</td>    
            <td>
                @if(($v->is_linked)==0)
                    属性
                @endif
                @if(($v->is_linked)==1)
                    规格
                @endif
               
            </td>
            <td>
                @if(($v->attr_input_type)==0)
                手工录入
                @endif
                @if(($v->attr_input_type)==1)
                下拉选择
                @endif
               
            </td>    
            <td>{{$v->attr_values}}
                
            </td>
            
            <td>
                
                <a href="{{url('/admin/admin_id/'.$v->admin_id)}}" class="layui-btn">修改</a>
                <a href="JavaScript:;" attr_id="{{$v->attr_id}}" class="layui-btn layui-btn-danger san">删除</a>
            </td>
          </tr>
        @endforeach
          <tr>
            <td colspan="6">
            </td>
          </tr>
    </tbody>
    
  </table>
 
  <script type="text/javascript" src="/admin/jquery.js" charset="utf-8"></script>

<script>

$(document).on("click",".san",function(){
    var attr_id = $(this).attr("attr_id");
    
  if(window.confirm("是否删除")){
    var data = {};
    data.attr_id = attr_id;
    var url = "{{url('/skus/attr_del')}}";
    $.ajax({
      type:"get",
      url:url,
      data:data,
      datetype:"json",
      success:function(res){
        console.log(res);
        history.go(0);
      }
    })
  }
})

</script>