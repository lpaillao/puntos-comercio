<?php

namespace App\Http\Controllers;

use App\Encryption;
use App\Models\Venta;
use App\Models\Dispositivo;
use App\Models\Comercio;
use App\Models\Punto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $ventas=Venta::all();
        return $ventas;
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
        //



        try {
            DB::transaction(function() use ($request) {

                $venta=new Venta();
                $venta->id_dispositivo  = $request->id_dispositivo;
                $venta->monto  = $request->monto;
                $venta->cod_seguridad  =  Crypt::encryptString($request->cod_seguridad);
                $venta->save();
        

            });
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la venta']);
        }
        //Consultamos el dispositivo por el ID
        $dispositivo = new Dispositivo();
        $dispositivo = Dispositivo::find($request->id_dispositivo);

        //Buscamos el comercion
        $comercio = Comercio::find($dispositivo->id_comercio);


        //buscamos y actualizamos los puntos del comercio
        $punto = Punto::find($comercio->id_puntos);
        $punto->saldo = $punto->saldo+10;
        $punto->save();

        return $punto;

        
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

    function dispositivo($idDispositivo){

        $dispositivo=new Dispositivo();
        return $dispositivo->show($idDispositivo);



    }
}
