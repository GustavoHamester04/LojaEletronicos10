<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::all();
        return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome'   => 'required|string|max:255',
            'estado' => 'required|string|size:2',
        ]);

        Cidade::create($dados);

        return redirect()
               ->route('cidades.index')
               ->with('success', 'Cidade criada com sucesso!');
    }

    public function show(Cidade $cidade)
    {
        return view('cidades.show', compact('cidade'));
    }

    public function edit(Cidade $cidade)
    {
        return view('cidades.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $dados = $request->validate([
            'nome'   => 'required|string|max:255',
            'estado' => 'required|string|size:2',
        ]);

        $cidade->update($dados);

        return redirect()
               ->route('cidades.index')
               ->with('success', 'Cidade atualizada com sucesso!');
    }

    public function destroy(Cidade $cidade)
    {
        $cidade->delete();

        return redirect()
               ->route('cidades.index')
               ->with('success', 'Cidade excluída com sucesso!');
    }
}
