<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\AuthController;
use App\Models\config\CONF_MONEY;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    //
    public function index(Request $request)
    {
      
        $money = new CONF_MONEY();
        $money = $money->monies();

        return response()->json([
            'message' => 'Lista de monedas',
            'data' => $money
        ], 200);
    }

    public function store(Request $request)
    {

        //validar que no exista la moneda
        $money = new CONF_MONEY();
        $money = $money->money($request->money_key);
        if ($money) {
            return response()->json([
                'message' => 'Error al crear moneda',
                'error' => 'La moneda ya existe'
            ], 400);
        }

        $data = $request->only('money_key', 'money_name', 'money_change', 'money_descript', 'money_keySat', 'money_status');

        $validator = Validator::make($data, [
            'money_key' => 'required|string',
            'money_name' => 'required|string',
            'money_change' => 'required|numeric',
            'money_descript' => 'string',
            'money_keySat' => 'required|string',
            'money_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al crear moneda',
                'error' => $validator->messages()
            ], 400);
        }

        $money = new CONF_MONEY();
        $money->money_key = $request->money_key;
        $money->money_name = $request->money_name;
        $money->money_change = $request->money_change;
        $money->money_descript = $request->money_descript;
        $money->money_keySat = $request->money_keySat;
        $money->money_status = $request->money_status;
        $money->save();

        return response()->json([
            'message' => 'Moneda creada',
            'data' => $money
        ], 200);
    }

    public function show($id)
    {
        $money = new CONF_MONEY();
        $money = $money->money_id($id);

        return response()->json([
            'message' => 'Moneda',
            'data' => $money
        ], 200);
    }

    public function edit($id)
    {
        $money = new CONF_MONEY();
        $money = $money->money_id($id);

        return response()->json([
            'message' => 'Moneda',
            'data' => $money
        ], 200);

    }



    public function update(Request $request, $id)
    {
        $data = $request->only('money_key', 'money_name', 'money_change', 'money_descript', 'money_keySat', 'money_status');

        $validator = Validator::make($data, [
            'money_key' => 'required|string',
            'money_name' => 'required|string',
            'money_change' => 'required|numeric',
            'money_descript' => 'string',
            'money_keySat' => 'required|string',
            'money_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al actualizar moneda',
                'error' => $validator->messages()
            ], 400);
        }

        $money = CONF_MONEY::find($id);
        $money->money_key = $request->money_key;
        $money->money_name = $request->money_name;
        $money->money_change = $request->money_change;
        $money->money_descript = $request->money_descript;
        $money->money_keySat = $request->money_keySat;
        $money->money_status = $request->money_status;
        $money->save();

        return response()->json([
            'message' => 'Moneda actualizada',
            'data' => $money
        ], 200);
    }

    public function destroy($id)
    {
        $money = CONF_MONEY::find($id);
        $money->delete();

        return response()->json([
            'message' => 'Moneda eliminada',
            'data' => $money
        ], 200);
    }
    
}
