@foreach($position as $v)
            <tr>
                <td><input type="checkbox" name="rolecheck[]" lay-skin="primary" value="{{$v->role_id}}"></td>
                <td>{{$v->position_id}}</td>
                <td>{{$v->position_name}}</td>
                <td>{{$v->ad_width}}</td>
                <td>{{$v->ad_height}}</td>
                <td>{{$v->position_desc}}</td>
                <td> 
                     <a href="{{url('ad/position/createhtml/'.$v->position_id)}}" class="layui-btn layui-btn-warm">生成广告</a>
                    <a href="{{url('ad/position/'.$v->position_id)}}" class="layui-btn layui-btn-danger">查看广告</a>
                    <a href="{{url('ad/position/edit/'.$v->position_id)}}" class="layui-btn layui-btn-warm">修改</a>
                    <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除此记录吗')){ location.href='{{url('/admin/ad_position/destroy/'.$v->position_id)}}" class="layui-btn layui-btn-danger">删除</a> -->
                    <a href="javascript:void(0)" onclick="deleteById({{$v->position_id}})" class="layui-btn layui-btn-danger moredel">删除</a>
                </td>
        @endforeach
        <tr>
            <td colspan="5">
                {{$position->links('vendor.pagination.adminshop')}}
            </td>
        </tr>