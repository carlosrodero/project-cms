@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Listagem de Projetos
                    <a href="{{ url('admin/projects/add') }}" class="float-right">Adicionar Projeto</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categorias</th>
                                    <th scope="col">Qtd. Fotos</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->id }}</th>
                                    <td>{{ $project->name }}</td>
                                    <td>
                                        @foreach ($project->categories as $itemC)
                                            <a href="#" class="btn btn-sm btn-secondary" style="margin: 3px">
                                                {{ $itemC->name }}
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ count($project->medias) }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url('admin/projects/'.$project->id.'/edit') }}" class="btn btn-sm btn-outline-primary" style="margin: 3px">Editar</a>
                                        {!! Form::open(array('url' => 'admin/projects/'.$project->id, 'method' => 'DELETE', 'style' => 'display:inline-block')) !!}
                                        <input type="hidden" name="idProject" value="{{ $project->id }}">
                                        {!! Form::submit('Excluir', array('class' => 'btn btn-sm btn-outline-danger')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
