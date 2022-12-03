<?php

namespace App\Http\Controllers\api\lockers;

use App\Http\Controllers\Controller;
use App\Models\Door;
use App\Models\Locker;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ConfigurationController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $codigo_armario
     * @return JsonResponse | Response
     */
    public function updateConfiguration(Request $request, string $codigo_armario)
    {
        /** @var Locker $locker */
        $locker = $request->get("lockerModel");
        if($locker->status === Locker::STATUS_CONFIGURED) {
            return \response()->json([
                "mensagem" => "O armário já estava configurado",
            ], 200);
        }

        $locker->software_config = json_encode($request->except(["tamanhos", "portas", "lockerModel"]));

        $sizes_array = array();
        foreach($request["tamanhos"] as $size_config) {
            $size = new Size();
            $size->width = $size_config["largura"];
            $size->height = $size_config["altura"];
            $size->depth = $size_config["profundidade"];
            $size->description = $size_config["apelido"];
            $size->locker_id = $locker->id;
            $size->save();
            $sizes_array[intval($size_config["tamanho_id"])] = $size;
        }

        foreach($request["portas"] as $door_config) {
            $door = new Door();
            $door->locker_id = $locker->id;
            $door->number = $door_config["numero_porta"];
            $door->size_id = $sizes_array[ intval($door_config[ "tamanho_id" ]) ]->id;
            $door->status = Door::STATUS_EMPTY;
            $door->save();
        }
        $locker->status = Locker::STATUS_CONFIGURED;
        $locker->save();

        return new Response(status: 200);
    }
}
