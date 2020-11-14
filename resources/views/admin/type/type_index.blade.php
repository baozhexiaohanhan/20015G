@extends('admin.lay.js')
     @section('js')
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
        <th>类型名</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody>
        @foreach($res as $k=>$v)
          <tr >
            
            <td>{{$v->cat_id}}</td>
            <td>{{$v->cat_name}}</td>
          
            
            <td>
                <a href="{{url('/attr/attr_index/'.$v->cat_id)}}" class="layui-btn">属性列表</a>
                <a href="{{url('/admin/admin_id/'.$v->admin_id)}}" class="layui-btn">修改</a>
                <a href="JavaScript:;" cat_id="{{$v->cat_id}}" class="layui-btn layui-btn-danger san">删除</a>
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
    var cat_id = $(this).attr("cat_id");
    
  if(window.confirm("是否删除")){
    var data = {};
    data.cat_id = cat_id;
    var url = "{{url('/type_del')}}";
    $.ajax({
      type:"get",
      url:url,
      data:data,
      datetype:"json",
      success:function(res){
        console.log(res);
        // history.go(0);
      }
    })
  }
})

</script>