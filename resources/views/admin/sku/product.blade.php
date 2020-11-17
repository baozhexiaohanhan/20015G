@extends('admin.lay.js')
     @section('js')
<form method="post" action="{{url('goods/product_add')}}" name="addForm" id="addForm">
<input type="hidden" name="goods_id" value="{{$go['goods_id']}}">
<input type="hidden" name="act" value="product_add_execute">
  <table width="100%" cellpadding="3" cellspacing="1" id="table_list">
    <tbody><tr>
      <th colspan="20" scope="col">商品名称：{{$go['goods_name']}}&nbsp;&nbsp;&nbsp;&nbsp;货号：{{$go['goods_sn']}}</th>
    </tr>
    <tr>
      <!-- start for specifications -->
      <!-- @ph @endphp -->
      <td scope="col" style="float:right; margin:50px;">
      @if($new_goods_specs['attr_name'])
        @foreach($new_goods_specs['attr_name'] as $k=>$v)
             <span align="center" style="margin-left:25px"><strong>{{$v}}</strong></span>
        @endforeach
      @endif
      </td>
            <!-- end for specifications -->
      <td class="label_2" style="background-color: rgb(255, 255, 255);">货号</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">库存</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">&nbsp;</td>
    </tr>

    
    <tr id="attr_row">
    <!-- start for specifications_value -->
          <td align="center" style="background-color: rgb(255, 255, 255);">
         @if($new_goods_specs['attr_values'])
         @foreach($new_goods_specs['attr_values'] as $k=>$v)
        <select name="attr[{{$k}}][]" style="width:100px;">
                <option value="" selected="">请选择...</option>
                @foreach($v as $kk=>$vv)
                <option value="{{$kk}}">{{$vv}}</option>
                @endforeach
        </select>
        @endforeach
        @endif
      </td>
        <!-- end for specifications_value -->

      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="{{$go['goods_sn']}}" size="20"></td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
      <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value=" + " onclick="add_attr_product(this)"></td>
    </tr>

    <tr>
      <td align="center" colspan="4" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 " onclick="checkgood_sn()">
      </td>
    </tr>
  </tbody></table>
</form>

</div>

</body>
<script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
<script>
    function add_attr_product(obj){
    var newobj = $(obj).parent().parent().clone();
    newobj.find('.button').val(' - ');
    newobj.find('.button').attr("onclick","rescSpec(this)");
    $(obj).parent().parent().after(newobj);
    // console.log(newobj);
    }
    function rescSpec(obj){
    $(obj).parent().parent().remove();
    }


</script>