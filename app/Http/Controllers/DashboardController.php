<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();

        $usersData = User::select([
            DB::raw('YEAR(created_at) as ano'),
            DB::raw('COUNT(*) as total')
        ])->groupBy('ano')
            ->orderBy('ano', 'asc')
            ->get();

        foreach ($usersData as $user) {
            $ano[] = $user->ano;
            $total[] = $user->total;
        }

        $userLabel = "'Comparativo de cadastros de usuários'";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);

        $categoriaData = Categoria::all();

        foreach ($categoriaData as $cat) {
            $catNome[] = "'" . $cat->nome . "'";
            $catTotal[] = Produto::where('id_categoria', $cat->id)->count();
        }

        $catLabel = implode(',', $catNome);
        $catTotal = implode(',', $catTotal);


        return view('admin.dashboard', compact('users', 'userLabel', 'userAno', 'userTotal', 'catLabel', 'catTotal'));
    }
}
