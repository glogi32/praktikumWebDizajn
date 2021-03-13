@php
    $i=1;
@endphp
@foreach($users as $u)

    <tr>
        <td>{{$i}}</td>
        <td>{{$u->firstName}}</td>
        <td>{{$u->lastName}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->name}}</td>
        <td>@if($u->updated_at) {{date("d:m:Y,  G:i",$u->updated_at)}} @else / @endif</td>
        <td><a href="{{ route('users.edit',  $u->user_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
        <td><a href="{{ route('users.destroy',$u->user_id) }}" data-id="{{$u->user_id}}"  class="btn btn-danger waves-effect btn-xs deleteUser"><i class="material-icons">Delete</i></a></td>
        @csrf
    </tr>
    @php
        $i++;
    @endphp
@endforeach
