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