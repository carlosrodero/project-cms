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
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <?php $blocks = $page->blocks; ?>
                    
                    {!! Form::model($blocks, array('url' => 'admin/pages/'.$page->id, 'method' => 'PATCH', 'files' => true)) !!}

                        @foreach ($blocks as $block)

                            @if($block->type === 'input')
                                {!! Form::label( 'input-'.$block->id, $block->name) !!}
                                {!! Form::input('text', 'input-'.$block->id, $block->content, array('class' => 'form-control', 'placeholder' => $block->name, 'style' => 'margin-bottom:20px;')) !!}

                            @elseif($block->type === 'text')
                                {!! Form::label( 'input-'.$block->id, $block->name) !!}
                                {!! Form::textarea('input-'.$block->id, $block->content, array('class' => 'form-control', 'placeholder' => $block->name, 'style' => 'margin-bottom:20px;')) !!}

                            @elseif($block->type === 'image')
                                {!! Form::label( 'input-'.$block->id, $block->name) !!}
                                {!! Form::file('input-'.$block->id, array('class' => 'form-control', 'placeholder' => $block->name, 'style' => 'margin-bottom:20px;')) !!}

                            @else

                                {!! Form::label( 'input-'.$block->id, $block->name) !!}
                                {!! Form::input('text', 'input-'.$block->id, null, array('class' => 'form-control', 'placeholder' => $block->name, 'style' => 'margin-bottom:20px;')) !!}

                            @endif

                            <input type="hidden" name="type-{{ $block->type }}" value="{{ $block->type }}">
                            <input type="hidden" name="name-{{ $block->type }}" value="{{ $block->name }}">

                        @endforeach
                        
                    <input type="hidden" name="pageId" value="{{ $page->id }}">
                    {!! Form::submit('Salvar', array('class' => 'btn btn-block btn-success', 'style' => 'margin-top:20px;')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
