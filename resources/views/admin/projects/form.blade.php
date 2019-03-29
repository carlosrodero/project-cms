@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dados do Projeto
                    <a href="{{ url('admin/projects') }}" class="float-right">Listagem dos Projetos</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('alert'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('alert') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <ul class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(Request::is('*/edit'))
                    <?php $assignedCategories = $project->categories; ?>
                    {!! Form::model($project, array('url' => 'admin/projects/'.$project->id, 'method' => 'PATCH', 'files' => true)) !!}
                    @else
                    <?php $assignedCategories = null; ?>
                    {!! Form::open(array('url' => 'admin/projects', 'method' => 'POST', 'files' => true)) !!}
                    @endif

                    {!! Form::label('name', 'Nome do Projeto') !!}
                    {!! Form::input('text', 'name' , null, ['autofocus', 'class' => 'form-control', 'placeholder' => 'Digite o nome do projeto']) !!}

                    {!! Form::label('categories', 'Nome do Projeto') !!}
                    {!! Form::select('categories', $categories, $assignedCategories, array('class' => 'form-control', 'multiple', 'name' => 'categories[]')) !!}

                    {!! Form::label('image', 'Imagens do Projeto') !!}
                    {!! Form::file('image', array('class' => 'form-control', 'accept' => 'image/*;capture=camera', 'multiple', 'name' => 'image[]')) !!}

                    {!! Form::submit('Salvar', array('class' => 'btn btn-block btn-success', 'style' => 'margin-top:20px')) !!}

                    {!! Form::close() !!}

                    @if(Request::is('*/edit'))

                    <div class="card-columns" style="margin-top: 20px">
                        @foreach ($project->medias as $media)

                            <div class="card" style="">
                                <img src="{{ URL::asset("storage/projects/{$project->id}/{$media->filename}") }}" class="img-thumbnail" alt="...">
                                <div class="card-body text-center">
                                {!! Form::open(array(
                                    "url" => "admin/medias/{$project->id}",
                                    "method" => "DELETE"
                                )) !!}
                                    <input type="hidden" name="mediaId" value="{{ $media->id }}" />
                                    {!! Form::submit('Excluir', array('class' => 'btn btn-sm btn-outline-danger')) !!}
                                {!! Form::close() !!}
                                </div>
                                <div class="card-footer">
                                <small class="text-muted">
                                    Enviado em: {{ date('d/m/Y H:i', strtotime($media->created_at)) }}
                                </small>
                                </div>
                            </div>

                        @endforeach
                    {{-- </div> --}}

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
