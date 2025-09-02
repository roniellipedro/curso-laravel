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

        @if (session('alerta'))
            <div class="card blue">
                <div class="card-content white-text">
                    <p>{{ session('alerta') }}</p>
                </div>
            </div>
        @endif

        @if ($itens->count() == 0)
            <div class="card orange">
                <div class="card-content white-text">
                    <h5>Seu carrinho está vazio!</h5>
                    <span>Clique
                        <a style="color: blue;" href="{{ route('site.index') }}">aqui</a>
                        e aproveite nossas promoções!</span>
                </div>
            </div>
        @else
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
                            @php
                                $imagem = $item->options->image;
                            @endphp
                            <td><img src="{{ $imagem ? url("storage/$imagem") : 'https://placehold.co/400x400?text=Sem+foto' }}"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;"
                                    class="responsive-img "></td>
                            <td>{{ $item->name }}</td>
                            <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>

                            <td><input type="number" style="width: 50px; font-weight:900;"
                                    class="white center refresh-cart-input" name="quantity" data-id="{{ $item->rowId }}"
                                    value="{{ $item->qty }}">
                            </td>
                            <td>
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">

                                <form action="{{ route('site.removecarrinho') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                    <button class="btn-floating btn-large waves-effect waves-light red"><i
                                            class="material-icons">delete</i></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card orange">
                <div class="card-content black-text">
                    <h5>Total: R$ {{ Cart::subtotal(2, ',', '.') }}</h5>
                </div>
            </div>


            <div class="row container center">
                <a href="{{ route('site.index') }}"class="btn waves-effect waves-light blue">Continuar comprando<i
                        class="material-icons right">arrow_back</i></a>
                <a href="{{ route('site.limpacarrinho') }}" class="btn waves-effect waves-light blue">Limpar carrinho<i
                        class="material-icons right">clear</i></a>
                <a class="btn waves-effect waves-light green">Finalizar pedido<i class="material-icons right">check</i></a>
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.refresh-cart-input').forEach(input => {
            input.addEventListener('change', function() {

                const formData = new FormData();
                formData.append('quantity', this.value);
                formData.append('rowId', this.dataset.id);

                fetch('/carrinho/atualizar', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Atualizado com sucesso!', data)

                        window.location.reload();
                    })
                    .catch(err => console.error('Erro ao atualizar:', err));
            });
        });
    </script>
@endsection
