@extends('site.layout')

@section('titulo', 'Carrinho')

@section('conteudo')
    <div class="row container">
        @if (session('sucesso'))
            <div class="card green">
                <div class="card-content white-text">
                    <p>{{ session('sucesso') }}</p>
                </div>
            </div>
        @endif



        <h5>Seu carrinho possui {{ $itens->count() }} produto(s) </h5>

        <table class="striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td><img src="{{ $item->options->image }}" width="100" class="responsive-img circle"></td>
                        <td>{{ $item->name }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td><input type="number" style="width: 50px; font-weight:900;" class="white center" name="quantity"
                                value="{{ $item->qty }}"></td>
                        <td>
                            <button class="btn-floating btn-large waves-effect waves-light orange"><i
                                    class="material-icons">refresh</i></button>
                            <form action="{{ route('site.removecarrinho') }}" method="POST">
                                @csrf
                                <button class="btn-floating btn-large waves-effect waves-light red"><i
                                        class="material-icons">delete</i></button>
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="row container center">
            <button class="btn waves-effect waves-light blue">Continuar comprando<i
                    class="material-icons right">arrow_back</i></button>
            <button class="btn waves-effect waves-light blue">Limpar carrinho<i
                    class="material-icons right">clear</i></button>
            <button class="btn waves-effect waves-light green">Finalizar pedido<i
                    class="material-icons right">check</i></button>
        </div>
    </div>
@endsection
