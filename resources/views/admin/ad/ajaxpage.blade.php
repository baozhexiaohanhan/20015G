 @foreach($ad as $v)
            <tr>
                <td>{{$v->ad_id}}</td>
                <td id="{{$v->ad_id}}" oldval="{{$v->ad_name}}"><span class="ad_name">{{$v->ad_name}}</span></td>
                <td>{{$v->position_id}}</td>
                <td>{{$v->media_type}}</td>
                <td>{{date('Y-m-d H:i:s'),$v->start_time}}</td>
                <td>{{date('Y-m-d H:i:s'),$v->end_time}}</td>
                <td>@if($v->ad_imgs)
                  <img src="{{$v->ad_imgs}}">
                  @endif</td>
                <td> 
                    <a href="{{url('/ad/edit/'.$v->ad_id)}}" class="layui-btn layui-btn-warm">修改</a>
                    <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除此记录吗')){ location.href='{{url('/admin/ad_position/destroy/'.$v->position_id)}}" class="layui-btn layui-btn-danger">删除</a> -->
                    <a href="javascript:void(0)" onclick="deleteById({{$v->ad_id}})" class="layui-btn layui-btn-danger moredel">删除</a>
                </td>
        @endforeach
        <tr>
            <td colspan="5">
                {{$ad->links('vendor.pagination.adminshop')}}
            </td>
        </tr>