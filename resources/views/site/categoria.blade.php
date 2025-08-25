@extends('site.layout')

@section('titulo', 'Categoria')

@section('conteudo')
    <div class="row container">
        <h5>Categoria: {{ $categoria->nome }}</h5>
        @foreach ($produtos as $produto)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ $produto->imagem }}">
                        <a href="{{ route('produto.details', $produto->slug) }}"
                            class="btn-floating halfway-fab waves-effect waves-light red"><i
                                class="material-icons">visibility</i></a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ Str::limit($produto->nome, 20) }}</span>
                        <p>{{ Str::limit($produto->descricao, 20) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row center">
        {{ $produtos->links('custom.pagination') }}
    </div>
@endsection
