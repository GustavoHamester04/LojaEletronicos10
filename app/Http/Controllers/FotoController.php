<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->is_admin) {
                abort(403, 'Acesso negado.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $fotos = Foto::with('produto')->paginate(10);
        return view('fotos.index', compact('fotos'));
    }

    public function create()
    {
        $produtos = Produto::pluck('nome', 'id');
        return view('fotos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'fotos' => 'required|array|min:1|max:5',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $qtdExistente = Foto::where('produto_id', $request->produto_id)->count();
        $qtdNova = count($request->file('fotos'));

        if (($qtdExistente + $qtdNova) > 5) {
            return back()->withErrors('Máximo de 5 fotos por produto.');
        }

        foreach ($request->file('fotos') as $arquivo) {
            $path = $arquivo->store('produtos', 'public');

            Foto::create([
                'produto_id' => $request->produto_id,
                'arquivo' => $path,
            ]);
        }

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Fotos enviadas com sucesso!');
    }

    public function show(Foto $foto)
    {
        return view('fotos.show', compact('foto'));
    }

    public function edit(Foto $foto)
    {
        $produtos = Produto::pluck('nome', 'id');
        return view('fotos.edit', compact('foto', 'produtos'));
    }

    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'arquivo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('arquivo')) {
            if ($foto->arquivo) {
                Storage::disk('public')->delete($foto->arquivo);
            }
            $foto->arquivo = $request->file('arquivo')->store('produtos', 'public');
        }

        $foto->produto_id = $request->produto_id;
        $foto->save();

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Foto atualizada com sucesso!');
    }

    public function destroy(Foto $foto)
    {
        Storage::disk('public')->delete($foto->arquivo);
        $foto->delete();

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Foto excluída.');
    }
}
