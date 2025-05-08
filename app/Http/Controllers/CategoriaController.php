<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('filhas')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function __construct()
{
    $this->middleware(function ($request, $next) {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Acesso negado.');
        }
        return $next($request);
    });
}

    public function create()
    {
        $pais = Categoria::whereNull('categoria_pai')->get();
        return view('categorias.create', compact('pais'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'          => 'required|string|max:255',
            'categoria_pai' => 'nullable|exists:categorias,id',
        ]);

        Categoria::create($data);

        return redirect()
            ->route('categorias.index')
            ->with('success','Categoria criada com sucesso!');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        $pais = Categoria::whereNull('categoria_pai')
                         ->where('id','!=',$categoria->id)
                         ->get();
        return view('categorias.edit', compact('categoria','pais'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nome'          => 'required|string|max:255',
            'categoria_pai' => 'nullable|exists:categorias,id',
        ]);

        $categoria->update($data);

        return redirect()
            ->route('categorias.index')
            ->with('success','Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
{
    if ($categoria->produtos()->exists()) {
        return redirect()->route('categorias.index')->with('error', 'Não é possível excluir uma categoria que possui produtos.');
    }

    $categoria->delete();
    return redirect()->route('categorias.index')->with('success', 'Categoria excluída.');
}
}
