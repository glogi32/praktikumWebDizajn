@extends("layouts.adminTemplate")

@section("content")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    @empty($form)
                        @include("admin.components.services.form")
                    @endempty

                    @isset($form)
                        @switch($form)
                            @case('edit')
                            @include('admin.components.services.formEdit')
                            @break
                            @case('add')
                            @include('admin.components.services.formAdd')
                            @break
                        @endswitch
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
