<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>

<body>
<!-- 内容主体区域 -->
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
      <legend><span class="layui-breadcrumb">
      <a href="/">首页</a>
      <a href="/demo/">商品品牌</a>
      <a><cite>品牌列表</cite></a>
      </span></legend>
    </fieldset>

    <!-- <form class="layui-form" action="">
    <div class="layui-form-item">
    <div class="layui-inline">
      <div class="layui-input-inline" style="padding-left: 40px;">
        <input type="tel" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称" lay-verify="required|phone" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-inline">
      <div class="layui-input-inline">
        <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入品牌网址" lay-verify="email" autocomplete="off" class="layui-input">
      </div>
    </div>
       <div class="layui-inline">
      <div class="layui-input-inline">
       <button class="layui-btn layui-btn-warm">搜索</button>
      </div>
    </div>
  </div> -->
<!-- </form> -->
    <div class="layui-form" style="padding: 15px;">
  <table class="layui-table">
    <colgroup>
      <col width="150">
      <col width="150">
      <col width="200">
      <col>
    </colgroup>
    <thead>
      <tr>
        <th width="5%"><input type="checkbox" name="allcheckbox" lay-skin="primary"></th>
        <th>品牌ID</th>
        <th>品牌名称</th>
        <th>品牌网址</th>
        <th>品牌logo</th>
        <th>品牌内容</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody>
      @foreach($brand as $v)
      <tr>
        <td><input type="checkbox" name="brandcheck[]" lay-skin="primary" value="{{$v->brand_id}}"></td>
        <td>{{$v->brand_id}}</td>
        <td id="{{$v->brand_id}}" oldval="{{$v->brand_name}}"><span class="brand_name">{{$v->brand_name}}</span></td>
        <td>{{$v->brand_url}}</td>
        
        <td>
          @if($v->brand_logo)
          <img src="{{$v->brand_logo}}" width="60">
          @endif
        </td>
        <td>{{$v->brand_desc}}</td>
        <td>
          <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="layui-btn layui-btn-warm">修改</a>
          <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除此记录吗')){ location.href='{{url('/brand/delete/'.$v->brand_id)}}';}" class="layui-btn layui-btn-danger">删除</a> -->
          <a href="javascript:void(0)" onclick="deleteById({{$v->brand_id}})" class="layui-btn layui-btn-danger">删除</a>
        </td>
      </tr>
      @endforeach
     <tr>
      <td colspan="7">
        {{$brand->links('vendor.pagination.adminshop')}}
      </td>
      </tr>
    </tbody>
    
  </table>
</div>


<script src="/admin/js/jquery.min.js"></script>
<script>
//JavaScript代码区域
layui.use(['element','form'], function(){
  var element = layui.element;
  var form=layui.form;
});

//ajax删除
function deleteById(brand_id){
  if(!brand_id){
    return;
  }
  $.get('/brand/delete/'+brand_id,function(res){
      alert(res.msg);
      location.reload();
  })
}

//ajax无刷新
$(document).on('click','.layui-laypage a',function(){
  var url=$(this).attr('href');
  $.get(url,function(res){
    $('tbody').html(res);
  })
  return false;
});
</script>
  

  
