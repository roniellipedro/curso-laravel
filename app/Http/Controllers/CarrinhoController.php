<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista()
    {
        // Cart::destroy();
        $itens = Cart::content();

        return view('site.carrinho', compact('itens'));
    }

    public function adicionaCarrinho(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->quantity,
            'options' => array(
                'image' => $request->image
            )
        ]);

        return redirect()->route('site.carrinho')->with('sucesso', 'Produto adicionado ao carrinho com sucesso!');
    }

    public function removeCarrinho(Request $request)
    {
        Cart::remove($request->rowId);

        return redirect()->route('site.carrinho')->with('sucesso', 'Produto removido do carrinho com sucesso!');
    }

    public function atualizaCarrinho(Request $request)
    {
        Cart::update($request['rowId'], [
            'qty' => $request['quantity']
        ]);
    }

    public function limpaCarrinho()
    {
        Cart::destroy();

        return redirect()->route('site.carrinho')->with('alerta', 'Seu carrinho está vazio!');
    }
}
