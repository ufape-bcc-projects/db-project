<?php

namespace App\Http\Controllers;

use App\Models\Granja;
use App\Models\Localizacao;
use App\Models\Proprietario;
use App\Models\TipoDeCriacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GranjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $granjas = Granja::all();
        return view('granjas.listar', ['granjas' => $granjas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $proprietarios = Proprietario::all();


        return view('granjas.criar', ['proprietarios' => $proprietarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate = [
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:14', 'min:14', 'unique:granjas'],
            'localizacoes' => ['required', 'string'],
            'tipo_criacao' => ['required', 'string'],
        ];

        $granja = Granja::create([
            'id_proprietario' => $request->id_proprietario,
            'nome' => $request->nome,
            'cnpj' => $request->cnpj
        ]);

        foreach (explode(';', $request->localizacoes) as $localizacao) {
            if (trim($localizacao) != '') {
                Localizacao::create([
                    'endereco' => trim($localizacao),
                    'id_granja' => $granja->id
                ]);
            }
        }

        foreach (explode(';', $request->tipo_criacao) as $tipoCriacao) {
            if (trim($tipoCriacao) != '') {
                TipoDeCriacao::create([
                    'tipo' => trim($tipoCriacao),
                    'id_granja' => $granja->id
                ]);
            }
        }

        return redirect()->route('listar.granja');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $granja = Granja::find($id);
        return view('granjas.mostrar', ['granja' => $granja]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $granja = Granja::find($id);
        $proprietarios = Proprietario::all();
        return view('granjas.editar', ['granja' => $granja], ['proprietarios' => $proprietarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $granja = Granja::find($id);

        $request->validate = [
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:14', 'min:14', 'unique:granjas'],
        ];

        $granja->nome = $request->nome;
        $granja->cnpj = $request->cnpj;
        $granja->id_proprietario = $request->id_proprietario;

        $granja->save();

        return redirect()->route('listar.granja');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $granja = Granja::find($id);
        $granja->delete();

        return redirect()->route('listar.granja');
    }
}
