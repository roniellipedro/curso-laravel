<!-- Modal Structure -->
<div id="create" class="modal">
    <div class="modal-content">
        <h4><i class="material-icons">card_giftcard</i> Novo produto</h4>
        <form class="col s12" action="{{ route('admin.produto.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                    <input id="nome" name="nome" type="text" class="validate">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input id="preco" name="preco" type="text" class="validate">
                    <label for="preco">Preço</label>
                </div>

                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea"></textarea>
                    <label for="descricao">Descrição</label>
                </div>

                <div class="input-field col s12">
                    <select id="id_categoria" name="id_categoria">
                        <option value="" disabled selected>Selecione a categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                    <label for="id_categoria">Categoria</label>
                </div>
            </div>

            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Imagem</span>
                    <input name="imagem" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <button type="submit" class="waves-effect waves-green btn blue right">Cadastrar</button><br>
        </form>
    </div>

</div>

<script src="https://unpkg.com/imask"></script>
<script>
    var element = document.getElementById('preco');

    var maskOptions = {
        mask: Number,
        scale: 2,
        signed: false,
        thousandsSeparator: '.',
        padFractionalZeros: true,
        normalizeZeros: true,
        radix: ',',
    };

    var mask = IMask(element, maskOptions);
</script>
