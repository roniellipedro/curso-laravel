<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista()
    {
        $itens = Cart::content();

        return view('site.carrinho', compact('itens'));
    }

    public function adicionaCarrinho(Request $request)
    {
        if ($request->quantity == null) {
            return redirect()->back()->with('alerta', 'A quantidade deve ser maior ou igual a 1');
        }

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'qty' => abs($request->quantity),
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
            'qty' => abs($request['quantity'])
        ]);

        return response()->json([
            'status' => 'ok',
            'mensagem' => 'Carrinho atualizado'
        ]);
    }

    public function limpaCarrinho()
    {
        Cart::destroy();

        return redirect()->route('site.carrinho')->with('alerta', 'Seu carrinho está vazio!');
    }
}
