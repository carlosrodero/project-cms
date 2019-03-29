@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dados da Página
                    <a href="{{ url('admin/pages') }}" class="float-right">Listagem das Páginas</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    form
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
