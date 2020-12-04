@foreach($ads as $v)
<a href="/shops/shops/?seller_id={{$v}}"><li>{{$v->ad_name}}</li></a>
@endforeach