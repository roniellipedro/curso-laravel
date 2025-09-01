<!-- Modal Structure -->
<div id="delete-{{ $produto->id }}" class="modal">
    <div class="modal-content">
        <h4><i class="material-icons">delete</i>Excluir</h4>
        <div class="row">
            <p>Você tem certeza que deseja excluir <strong>{{ $produto->nome }}</strong> ?</p>

            <form action="{{ route('admin.produto.delete', $produto->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="waves-effect waves-green btn red right">Excluir</button>
            </form>

            <a class="modal-close waves-effect waves-green btn blue right">Cancelar</a>
        </div>

    </div>

</div>
