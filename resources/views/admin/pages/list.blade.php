@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Listagem de Páginas
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pages) > 1)
                                @foreach($pages as $page)
                                <tr>
                                    <th scope="row">{{ $page->id }}</th>
                                    <td>{{ $page->name }}</td>
                                    <td class="text-right">
                                        <a href="{{ url('/'.$page->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        <a href="{{ url('admin/pages/'.$page->id.'/edit') }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <a href="" class="btn btn-sm btn-outline-danger">Excluir</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Nennuma página cadastrada.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
