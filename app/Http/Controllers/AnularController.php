<?php

namespace App\Http\Controllers;

use App\Encryption;
use App\Models\Comercio;
use App\Models\Venta;
use App\Models\Punto;
use App\Models\Dispositivo;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Facades\Crypt;

class AnularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //Primero buscamos la venta y verificamos el codigo
        $venta = Venta::find($request->id_venta);

        if(is_null($venta)){
            $test=array(
                'algo'=>'error'
            );
            return $test;
            
        }else{
            $codOriginal=Crypt::decryptString($venta->cod_seguridad);

            $nuevoCodigoSeguridad=Crypt::encryptString($request->cod_seguridad);
            if($codOriginal == $request->cod_seguridad){
                

                //obtengo los datos de dispositivo
                $dispositivo = Dispositivo::find($venta->id_dispositivo);

                //datos del comercio
                $comercio = Comercio::find($dispositivo->id_comercio);

                $punto = Punto::find($comercio->id_puntos);
                if($punto->saldo>0){
                    $punto->saldo = $punto->saldo-10;
                    $punto->save();
                } 
                $test=array(
                    'algo'=>'igual',
                    'orige'=>$codOriginal,
                    'new'=>$punto
                );
            }         
            return $punto;
        }
    
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
