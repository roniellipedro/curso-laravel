@if (session('erro'))
    {{ session('erro') }}
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
        <br>
    @endforeach
@endif

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <label for="firstName">Nome</label><br>
    <input name="firstName" id="firstName" type="firstName"><br>
    <label for="lastName">Sobrenome</label><br>
    <input name="lastName" id="lastName" type="lastName"><br>
    <label for="email">E-mail</label><br>
    <input name="email" id="email" type="email"><br>
    <label for="password">Password</label><br>
    <input name="password" id="password" type="password"><br>
    <input type="submit" value="Cadastrar">
</form>
