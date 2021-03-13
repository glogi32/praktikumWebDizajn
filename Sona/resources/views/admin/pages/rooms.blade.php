@extends("layouts.adminTemplate")

@section("content")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    @empty($form)
                        @include("admin.components.rooms.form")
                    @endempty

                    @isset($form)
                        @switch($form)
                            @case('edit')
                            @include('Admin.components.rooms.formEdit')
                            @break
                            @case('add')
                            @include('Admin.components.rooms.formAdd')
                            @break
                        @endswitch
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
