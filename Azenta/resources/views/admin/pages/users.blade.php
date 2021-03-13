
@extends("layouts/admin")
@section("middle")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    @empty($form)
                        @include("admin/components/users/form")
                    @endempty

                    @isset($form)
                        @switch($form)
                            @case('edit')
                            @include('admin/components/users/formEdit')
                            @break
                            @case('insert')
                            @include('admin/components/users/formAdd')
                            @break
                        @endswitch
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
