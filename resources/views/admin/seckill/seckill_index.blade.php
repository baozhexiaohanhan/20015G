@extends('admin.lay.js')
     @section('js')
     @include('admin.lay.top')
     @section('tops')
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
        <th>抢购商品名字</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>是否开启</th>
        <th>商品</th>
        <th>原价</th>
        <th>抢购价</th>
        <th>介绍</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody>
        @foreach($seckill as $k=>$v)
          <tr >
            
            <td>{{$v->id}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{url('/seckilldesc/'.$v->id)}}" class="layui-btn">预览</a></td>
            <td>{{$v->name}}</td>
            <td>{{date('Y-m-d H:i:s',$v->start_time)}}</td>
            <td>{{date('Y-m-d H:i:s',$v->end_time)}}</td>
            <td>@if($v->is_close==1)
                    是
                @endif
                @if($v->is_close==2)
                    否
                @endif
            </td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->yuan}}</td>
            <td>{{$v->price}}</td>
            <td>{{$v->intro}}</td>
            <td>
                <a href="{{url('/updates/'.$v->id)}}" class="layui-btn">修改</a>
                <a href="JavaScript:;" cat_id="{{$v->id}}" class="layui-btn layui-btn-danger san">删除</a>

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
    var url = "{{url('/del')}}";
    $.ajax({
      type:"get",
      url:url,
      data:data,
      datetype:"json",
      success:function(res){
        // console.log(res);
        history.go(0);
      }
    })
  }
})

</script>