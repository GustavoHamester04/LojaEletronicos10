<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;  
use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $produtos = Produto::paginate(10); // Retorna um paginador com 10 itens por página
    return view('home', compact('produtos'));
}
}
