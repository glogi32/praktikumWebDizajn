@extends("layouts/admin")
@section("middle")
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                @empty($form)
                    @include("admin/components/properties/form")
                @endempty

                @isset($form)
                    @switch($form)
                        @case('edit')
                        @include('admin/components/properties/formEdit')
                        @break
                        @case('insert')
                        @include('admin/components/properties/formAdd')
                        @break
                    @endswitch
                @endisset

            </div>
        </div>
    </div>
@endsection
