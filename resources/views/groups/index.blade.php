@extends('layouts.privado')

@section('page-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Grupos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Grupos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-body" id="registradas_row">
            @include('groups.partials._index_row')
        </div>
        <div class="card-footer" id="foo-rows">
            {{ $registros->links() }}
        </div>
    </div>
</div>

@endsection

@section('jscripts')
    <script src="{{ mix('js/groups/index.js') }}"></script>
@endsection
