<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProdutoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(4);

        $categorias = Categoria::all();

        return view('admin.produtos', compact('produtos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request['preco'] = intval(str_replace([',', '.'], ['', ''], $request['preco']));
        $request['id_user'] = Auth::user()->id;
        $request['slug'] = Str::slug($request['nome']);
        $originalSlug = $request['slug'];
        $i = 1;

        while (Produto::where('slug', $request['slug'])->exists()) {
            $request['slug'] = $originalSlug . '-' . $i;
            $i++;
        }

        $produto = $request->only('nome', 'descricao', 'preco', 'slug', 'id_user', 'id_categoria');
        dd($produto);
        Produto::create($produto);

        return redirect()->route('admin.produtos')->with('sucesso', 'Produto criado com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect(route('admin.produtos'))->with('sucesso', 'Produto removido com sucesso!');
    }
}
