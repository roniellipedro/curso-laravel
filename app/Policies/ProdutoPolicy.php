<?php

namespace App\Policies;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdutoPolicy
{
    public function verProduto(User $user, Produto $produto)
    {
        return $user->id === $produto->id_user;
    }
}
