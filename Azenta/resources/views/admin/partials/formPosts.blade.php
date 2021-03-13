@php
    $i=1;
@endphp
@foreach($posts as $p)

    <tr>
        <td>{{$i}}</td>
        <td>{{$p->title}}</td>
        <td>{{date("d-m-Y",$p->created_at)}}</td>
        <td>@if($p->updated_at) {{date("d-m-Y",$p->updated_at)}} @else / @endif</td>
        <td>{{$p->firstName}} {{$p->lastName}}</td>
        <td><a href="{{ route("posts.edit",$p->post_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
        <td><a href="#" data-id="{{$p->post_id}}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deletePost"><i class="material-icons">Delete</i></a></td>
    </tr>
    @php
        $i++;
    @endphp
@endforeach
