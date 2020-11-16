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
          <tr cat_id="{{$v->cat_id}}">
            
            <td >{{$v->cat_id}}</td>
            <!-- <td>{{$v->cat_name}}</td> -->
            <td cat_name="cat_name" cat_name="{{$v->cat_name}}">
                <span class="name_a">{{$v->cat_name}}</span>
                <input type="text" class="name_s" value="{{$v->cat_name}}" style="display:none">
            </td>
            
            <td>
                <a href="{{url('/attr_index/'.$v->cat_id)}}" class="layui-btn">属性列表</a>
                
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
// 即点即改
$(document).ready(function(){
      $(document).on("click",".name_a",function(){
            var _this = $(this);
            _this.hide();
            _this.next("input").show();

            $(".name_s").blur(function(){
                var _this = $(this);

                var zi = _this.val();
                var name = _this.parents("td").attr("cat_name");
                // console.log(name);return;
                if(zi==""){
                  alert("内容不能为空");
                  history.go(0);
                  return;
                }
                if(zi==name){
                  alert("此品牌已有");
                  // history.go(0);
                  _this.prev("span").text(zi).show();
                  _this.hide();
                  return;
                }
                var cat_id = _this.parents("tr").attr("cat_id");
                var cat_name = _this.parent("td").attr("cat_name");
                var data = {};
                data.cat_name = cat_name;
                data.cat_id = cat_id;
                data.zi = zi;
               var url = "{{url('/ajaxjdjd')}}";
                $.ajax({
                    type:"get",
                    data:data,
                    url:url,
                    dataType:"json",
                    success:function(res){
                      // console.log(res)
					    if(res.code==0001){
                _this.prev("span").text(zi).show();
                _this.hide();
                
              // alert(res.message);
              // history.go(0);
						  }
                    }
              })
            })
          })
	    })

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