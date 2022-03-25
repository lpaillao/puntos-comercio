<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\Punto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comercios = Comercio::all();
        return $comercios;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creo el registro de los puntos con el rut
   
        try {
            DB::transaction(function() use ($request) {
                $punto = new Punto();
                $punto->rut_comercio = $request->rut_comercio;
                $punto->saldo = 0;
                $punto->save();

                $nuevoIdPunto=$punto->id;
                $comercio = new Comercio();
                $comercio->id_puntos = $nuevoIdPunto;
                $comercio->rut_comercio = $request->rut_comercio;
                $comercio->nombre=$request->nombre;
                $comercio->save();

            });
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error']);
        }
        return response()->json(['message' => 'Success']);
    }

        
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
