@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Listagem de Páginas
                    <a href="{{ url('admin/pages/add') }}" class="float-right">Adicionar Página</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    list
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
