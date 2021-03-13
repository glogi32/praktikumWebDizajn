@php
    $i=1;
@endphp
@foreach($properties as $p)

    <tr>
        <td>{{$i}}</td>
        <td>{{$p->propertyName}}</td>
        <td>{{$p->address}}</td>
        <td>{{$p->cityName}}</td>
        <td>{{$p->status}}</td>
        <td>{{$p->price}}</td>
        <td>@if($p->updated_at) {{date("d-m-Y,  G:i",$p->updated_at)}} @else / @endif</td>
        <td>{{$p->firstName}} {{$p->lastName}}</td>
        <td>{{$p->typeName}}</td>
        <td>{{date("d-m-Y",$p->datePost)}}</td>
        <td>{{date("d-m-Y",$p->dateExpired)}}</td>
        <td><a href="{{ route("properties.edit",$p->property_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
        <td><a href="" data-id="{{$p->property_id}}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deleteProperty"><i class="material-icons">Delete</i></a></td>

    </tr>
    @php
        $i++;
    @endphp
@endforeach
