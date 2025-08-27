@if (session('erro'))
    {{ session('erro') }}
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
        <br>
    @endforeach
@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf
    <label for="email">E-mail</label><br>
    <input name="email" id="email" type="email"><br>
    <label for="password">Password</label><br>
    <input name="password" id="password" type="password"><br>
    <input type="submit" value="Entrar">
</form>
