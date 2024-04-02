<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;

class ArquivosController extends Controller {

    public function show($ano = '', $cod_evolucao_indicador = '') {

        $pdf = Arquivo::find($cod_evolucao_indicador);

        $content = base64_decode($pdf->data);
        return response($content)->header('Content-Type', $pdf->dsc_tipo);
    }

}
