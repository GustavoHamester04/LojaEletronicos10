<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->paginate(10);
        return view('produtos.index', compact('produtos'));
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
        $categorias = Categoria::pluck('nome', 'id');
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'estoque' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $data['slug'] = Str::slug($data['nome']);

        Produto::create($data);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::pluck('nome', 'id');
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'estoque' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $data['slug'] = Str::slug($data['nome']);

        $produto->update($data);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto excluído.');
    }
}
