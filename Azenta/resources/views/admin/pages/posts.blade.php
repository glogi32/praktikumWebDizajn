@extends("layouts/admin")
@section("middle")
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                @empty($form)
                    @include("admin/components/posts/form")
                @endempty

                @isset($form)
                    @switch($form)
                        @case('edit')
                            @include('admin/components/posts/formEdit')
                        @break
                        @case('insert')
                            @include('admin/components/posts/formAdd')
                        @break
                    @endswitch
                @endisset

            </div>
        </div>
    </div>
@endsection
