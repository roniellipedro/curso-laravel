<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        $produtos = Produto::paginate(3);

        return view('site.home', compact('produtos'));
    }

    public function categoria($id)
    {
        $categoria = Categoria::find($id);
        $produtos = Produto::where('id_categoria', $id)->paginate(3);

        return view('site.categoria', compact('produtos','categoria'));
    }
}
