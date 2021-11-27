<?php

function nomeTemaLimpo($tema = "") {

    switch ($tema) {
        case 'Pavimentação':
        $temaLimpo = 'pavimentacao';
        break;
        case 'Transporte e Mobilidade':
        $temaLimpo = 'transporte_e_mobilidade';
        break;
        case 'Habitação':
        $temaLimpo = 'habitacao';
        break;
        case 'Saneamento':
        $temaLimpo = 'saneamento';
        break;
        case 'Máquinas e equipamentos':
        $temaLimpo = 'maquinas_e_equipamentos';
        break;
        case 'Defesa Civil':
        $temaLimpo = 'defesa_civil';
        break;
        case 'Segurança Hídrica':
        $temaLimpo = 'seguranca_hidrica';
        break;
        case 'Desenvolvimento Regional e Urbano':
        $temaLimpo = 'desenvolvimento_regional_e_urbano';
        break;
        
        default:
        $temaLimpo = $tema;
        break;
    }

    return $temaLimpo;

}

function iconTema($tema = "") {

    switch ($tema) {
        case 'Pavimentação':
        $icon = '<i class="fas fa-road text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Transporte e Mobilidade':
        $icon = '<i class="fas fa-subway text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Habitação':
        $icon = '<i class="fas fa-house-user text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Saneamento':
        $icon = '<i class="fas fa-hand-holding-water text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Máquinas e equipamentos':
        $icon = '<i class="fas fa-tractor text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Defesa Civil':
        $icon = '<i class="fas fa-cloud-showers-heavy text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Segurança Hídrica':
        $icon = '<i class="fa fa-water text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        case 'Desenvolvimento Regional e Urbano':
        $icon = '<i class="fas fa-city text-secondary" style="font-size: 1.6rem!Important; color: #25A1B3 !Important;"></i>';
        break;
        
        default:
        $icon = $tema;
        break;
    }

    return $icon;

}

function lerCurl($url = '') {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        // Set Here Your Requesred Headers
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    return json_decode($response);

}

function formatarDataComCarbonParaBR($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        return Carbon\Carbon::parse($data)->format('d/m/Y');
    } else {

        return '';
    }
}

function formatarDataComCarbonParaEN($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        return Carbon\Carbon::parse($data)->format('Y-m-d');
    } else {

        return '';
    }
}

function formatarTimeStampComCarbonParaEN($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        return Carbon\Carbon::parse($data)->format('Y-m-d H:i:s');
    } else {

        return '';
    }
}

function formatarTimeStampComCarbonParaBR($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        return Carbon\Carbon::parse($data)->format('d/m/Y à\\s H:i');
    } else {

        return '';
    }
}

function formatarTimeStampComCarbonParaBRSemPalavra($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        return Carbon\Carbon::parse($data)->format('d/m/Y H:i');
    } else {

        return '';
    }
}

function formatarTimeStampComCarbonParaBRFormatoSimples($data = '') {
    Carbon\Carbon::setLocale('pt_BR');

    if($data != '') {

        //return Carbon\Carbon::parse($data)->format('d/m/Y H:i');
        return Carbon\Carbon::parse($data)->format('d/m/Y');
    } else {

        return '';
    }
}

function formatarDataComCarbonForHumans($data = '') {

    if($data != '') {

        Carbon\Carbon::setLocale('pt_BR');
        return Carbon\Carbon::parse($data)->diffForHumans();
    } else {

        return '';
    }
}

function converterTimeStamp($de, $para, $data = "0000-00-00") {

    if ($data == ""){
        return "";
    }
    else{
        if ($de == "EN" && $para == "PTBR") {
            $dataVetor = explode("-", $data);

            if(count($dataVetor) > 2) {

                return $dataVetor[2] . "/" . $dataVetor[1] . "/" . $dataVetor[0];
            } else {

                return NULL;
            }
            
        } elseif ($de == "PTBR" && $para == "EN") {
            $dataVetor = explode("/", $data);
            
            if(count($dataVetor) > 2) {

                $parte = explode(' ', $dataVetor[2]);

                return $parte[0] . "-" . $dataVetor[1] . "-" . $dataVetor[0] . ' ' . $parte[1];
            } else {

                return NULL;
            }
            
        } else
        return $data;
    }
}

function tirarTimeStamp($data) {

    $dataVetor = explode("-", $data);

    if(count($dataVetor) > 1) {

        $parte = explode(' ', $dataVetor[2]);

        if(count($parte) > 0) {

            return $dataVetor[0] . "-" . $dataVetor[1] . "-" . $parte[0];

        } else {

            return $dataVetor[0] . "-" . $dataVetor[1] . "-" . $dataVetor[2];

        }

    } else {

        return $data;

    }

}

function converterTimeStampParaNormal($de, $para, $data = "0000-00-00") {

    if ($data == ""){
        return "";
    }
    else{
        if ($de == "EN" && $para == "PTBR") {
            $dataVetor = explode("-", $data);

            if(count($dataVetor) > 2) {

                return $dataVetor[2] . "/" . $dataVetor[1] . "/" . $dataVetor[0];
            } else {

                return NULL;
            }
            
        } elseif ($de == "PTBR" && $para == "EN") {
            $dataVetor = explode("/", $data);
            
            if(count($dataVetor) > 2) {

                $parte = explode(' ', $dataVetor[2]);

                return $parte[0] . "-" . $dataVetor[1] . "-" . $dataVetor[0];
            } else {

                return NULL;
            }
            
        } else
        return $data;
    }
}

function converterData($de, $para, $data = "0000-00-00") {

    if ($data == ""){
        return "";
    }
    else{
        if ($de == "EN" && $para == "PTBR") {
            $dataVetor = explode("-", $data);

            if(count($dataVetor) > 2) {

                return $dataVetor[2] . "/" . $dataVetor[1] . "/" . $dataVetor[0];
            } else {

                return NULL;
            }
            
        } elseif ($de == "PTBR" && $para == "EN") {
            $dataVetor = explode("/", $data);
            
            if(count($dataVetor) > 2) {

                return $dataVetor[2] . "-" . $dataVetor[1] . "-" . $dataVetor[0];
            } else {

                return NULL;
            }
            
        } else
        return $data;
    }
}

function converterDataBrSimples($de, $para, $data = "0000-00-00") {

    if ($data == ""){
        return "";
    }
    else{
        if ($de == "EN" && $para == "PTBR") {
            $dataVetor = explode("-", $data);
            return $dataVetor[2] . "/" . $dataVetor[1];
        } elseif ($de == "PTBR" && $para == "EN") {
            $dataVetor = explode("/", $data);
            return $dataVetor[2] . "-" . $dataVetor[1] . "-" . $dataVetor[0];
        } else
        
        return $data;
    }
}

function formatarValorFloatMysql($valor) {

    return number_format($valor, 2, '.', '.');
}

function formatarValorFloatMysqlParaTresCasasAposPonto($valor) {

    return number_format($valor, 3, '.', '.');
}


function detectarConverteValor($valor) {

    $valor = str_replace(',', '.', $valor);

    return number_format((float)$valor, 2, ',', '.');

    return $valor;
}

function converteValor($de, $para, $valor) {
    if ($valor == ""){
        return '';
    } else {

        if ($de == "MYSQL" && $para == "PTBR") {
            $valor = str_replace(array(".", ","), array(",", "."), $valor);
            return number_format($valor, 2, ',', '.');
        } elseif ($de == "PTBR" && $para == "MYSQL") {
            $valor = str_replace('.', "", $valor);
            $valor = str_replace(',', '.', $valor);
            return $valor;
        } else {
            return $valor;
        }
    }
}

function converteValorUmaCasaDecimal($de, $para, $valor) {
    if ($valor == ""){
        return '';
    } else {

        if ($de == "MYSQL" && $para == "PTBR") {
            $valor = str_replace(array(".", ","), array(",", "."), $valor);
            return number_format($valor, 1, ',', '.');
        } elseif ($de == "PTBR" && $para == "MYSQL") {
            $valor = str_replace('.', "", $valor);
            $valor = str_replace(',', '.', $valor);
            return $valor;
        } else {
            return $valor;
        }
    }
}

function converteValorSemCasasDecimais($de, $para, $valor) {
    if ($valor == ""){
        return 0;
    } else {

        if ($de == "MYSQL" && $para == "PTBR") {
            $valor = str_replace(array(".", ","), array(",", "."), $valor);
            return number_format($valor, 0, ',', '.');
        } elseif ($de == "PTBR" && $para == "MYSQL") {
            $valor = str_replace('.', "", $valor);
            $valor = str_replace(',', '.', $valor);
            return $valor;
        } else {
            return $valor;
        }
    }
}

function formatarValor($valor = '') {
    if (is_numeric($valor)) {
        $valor = str_replace(',', '.', $valor);
        return number_format($valor, 2, ',', '.');
    } else {
        $valor = $valor;
        return $valor;
    }
}

function formatarNumeroInteiro($valor = '') {
    if (is_numeric($valor)) {
        $valor = str_replace(',', '.', $valor);
        return number_format($valor, 0, ',', '.');
    } else {
        $valor = $valor;
        return $valor;
    }
}

function date_forward($formato_entrada, $formato_saida, $data, $dias, $meses, $anos) {
    if ($data == '')
        return '';

    if ($formato_entrada == 'EN') {
        $data = explode("-", $data);
        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];
    } elseif ($formato_entrada == 'PTBR') {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
    }

    $novaData = mktime(0, 0, 0, $mes + $meses, $dia + $dias, $ano + $anos);

    if ($formato_saida == 'EN')
        return strftime("%Y-%m-%d", $novaData);
    elseif ($formato_saida == 'PTBR')
        return strftime("%d/%m/%Y", $novaData);
}

function data_reward($formato_entrada, $formato_saida, $data, $dias, $meses, $anos) {
    if ($data == '')
        return '';

    if ($formato_entrada == 'EN') {
        $data = explode("-", $data);
        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];
    } elseif ($formato_entrada == 'PTBR') {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
    }

    $novaData = mktime(0, 0, 0, $mes - $meses, $dia - $dias, $ano - $anos);

    if ($formato_saida == 'EN')
        return strftime("%Y-%m-%d", $novaData);
    elseif ($formato_saida == 'PTBR')
        return strftime("%d/%m/%Y", $novaData);
}

function formatarData($formato_entrada, $formato_saida, $data, $dias = 0, $meses = 0, $anos = 0) {
    $data = '';
    $ano = '';
    $mes = '';
    $dia = '';
    if ($data == '')
        return '';

    if ($formato_entrada == 'EN') {
        $data = explode("-", $data);
        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];
    } elseif ($formato_entrada == 'PTBR') {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
    }

    $novaData = mktime(0, 0, 0, $mes - $meses, $dia - $dias, $ano - $anos);

    if ($formato_saida == 'EN')
        return strftime("%Y-%m-%d", $novaData);
    elseif ($formato_saida == 'PTBR')
        return strftime("%d/%m/%Y", $novaData);
}

function calcularDiferencaEntreDatas($dataFim = ''){

    $datetime1 = new DateTime(date('Y-m-d'));
    $datetime2 = new DateTime($dataFim);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%R%a');
}

function verificarVigencia($dias = 0, $sitConvenio = ''){

    if($sitConvenio == 'Em execução' || $sitConvenio == 'Proposta/Plano de Trabalho Aprovado' || $sitConvenio == 'Proposta/Plano de Trabalho Complementado em Análise' || $sitConvenio == 'Proposta/Plano de Trabalho Complementado Enviado para Análise') {
        if($dias >= 30 && $dias <= 45) {
            return 'success';
        } elseif($dias >= 15 && $dias <= 29) {
            return 'warning';
        } elseif($dias >= 0 && $dias < 15) {
            return 'danger';
        } elseif($dias < 0) {
            return 'secondary';
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function verificarVigenciaStyle($dias = 0, $sitConvenio = ''){

    if($sitConvenio == 'Em execução' || $sitConvenio == 'Proposta/Plano de Trabalho Aprovado' || $sitConvenio == 'Proposta/Plano de Trabalho Complementado em Análise' || $sitConvenio == 'Proposta/Plano de Trabalho Complementado Enviado para Análise') {
        if($dias >= 30 && $dias <= 45) {
            return 'background-color: #7eca8f !Important; color: #FFFFFF !Important;';
        } elseif($dias >= 15 && $dias <= 29) {
            return 'background-color: #ffd96a !Important; color: #000000 !Important;';
        } elseif($dias >= 0 && $dias < 15) {
            return 'background-color: #df4957 !Important; color: #FFFFFF !Important;';
        } elseif($dias < 0) {
            return 'background-color: #a6acb1 !Important; color: #FFFFFF !Important;';
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function verificarSituacaoConvenioStyle($sitConvenio = ''){

    if($sitConvenio == 'Cancelado' || $sitConvenio == 'Convênio Anulado') {

        return 'background-color: #df4957 !Important; color: #FFFFFF !Important;';
    } else {
        return '';
    }
}

function verificarSituacaoContratacaoStyle($sitConvenio = ''){

    if($sitConvenio != 'Normal' && $sitConvenio != '') {

        return 'background-color: #df4957 !Important; color: #FFFFFF !Important;';
    } elseif($sitConvenio == '') {

        return '';
    } else {

        return '';
    }
}

function verificarSeExisteValorAPagar($sitConvenio = '', $valorContrato = 0, $valorPago){

    if($sitConvenio == 'Em execução') {

        if($valorPago < $valorContrato) {

            return 'background-color: #ffd96a !Important; color: #000000 !Important;';
        }
    } else {
        return '';
    }
}

function gerar_senha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
    $lmin = 'bcdefhjkmnpqrstuvwxyz';
    $lmai = 'ABCDEFJKMPRXZ';
    $num = '3579';
    $simb = '@#$%';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas)
        $caracteres .= $lmai;
    if ($numeros)
        $caracteres .= $num;
    if ($simbolos)
        $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
}

function date_convert($de, $para, $data) {
    if ($data == ''){
        return '';
    } else {
        if ($de == 'EN' && $para == 'PTBR') {
            $dataVetor = explode('-', $data);
            return $dataVetor[2] . "/" . $dataVetor[1] . "/" . $dataVetor[0];
        } elseif ($de == 'PTBR' && $para == 'EN') {
            $dataVetor = explode('/', $data);
            return $dataVetor[2] . "-" . $dataVetor[1] . "-" . $dataVetor[0];
        } else
        return $data;
    }
    
}

function limpaNomeMinisterio($string) {

            // matriz de entrada
    $what = array('Ministério da ', 'MINISTÉRIO DA ', 'Ministério do ', 'MINISTÉRIO DO ', 'Ministério de ', 'MINISTÉRIO DE ','Ministerio da ', 'MINISTERIO DA ', 'Ministerio do ', 'MINISTERIO DO ', 'Ministerio de ', 'MINISTERIO DE ');

            // matriz de saída
    $by = array('','','','','','','','','','','','');

            // devolver a string
    return str_replace($what, $by, $string);
}

function limpaString($string) {

    // matriz de entrada
    $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'Ã','Â', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º', '.',"d'","D",'.','-',"'");

    // matriz de saída
    $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'A','A', 'E', 'I', 'O', 'U', 'n', 'N', 'c', 'C', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',"d","D",'','',"");

            // devolver a string
    return str_replace($what, $by, $string);
}

function tirarAcentuacao($string) {

            // matriz de entrada
    $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'Ã','Â', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç','Õ');

            // matriz de saída
    $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'A','A', 'E', 'I', 'O', 'U', 'n', 'N', 'c', 'C','O');

            // devolver a string
    return str_replace($what, $by, $string);
}

function limpaStringSemTirarHifem($string) {

            // matriz de formato_entrada
    $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'Ã','Â', 'É','Ê', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç','Ô','Õ',"D'A","T'A");

            // matriz de saída
    $by =   array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'A', 'A', 'E', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C','O','O',"DA","TA");

            // devolver a string
    return str_replace($what, $by, $string);
}

function limpa($string) {

            // matriz de entrada
    $what = array('-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º', '.');

            // matriz de saída
    $by = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

            // devolver a string
    return str_replace($what, $by, $string);
}

function tiraApostrofo($string = '') {

    $what = array("D'","d'");

    $by = array('D ', 'd ');

    return str_replace($what, $by, $string);

}

function primeiraLetraMaiuscula($string, $firstAlwaysUpper = true, $encoding = "UTF-8") {
    $lc = array("aos", "e", "o", "os", "as", "a", "do", "dos", "das", "da", "ante", "após", "até", "com", "contra", "de", "desde", "em", "entre", "para", "perante", "por", "sem", "sob", "sobre", "trás", "que", "seu", "sua", "seus", "suas", "MDS");

    $a = explode(" ", $string);
    $r = "";

    for ($i = 0; $i < count($a); $i++) {
        if (!$firstAlwaysUpper)
            $r .= (strlen($a[$i]) <= 3) ? $a[$i] . ' ' : (in_array(mb_convert_case($a[$i], MB_CASE_LOWER, $encoding), $lc)) ? mb_convert_case($a[$i], MB_CASE_LOWER, $encoding) . ' ' : mb_convert_case($a[$i], MB_CASE_TITLE, $encoding) . ' ';

        else {
            if ($i == 0)
                $r .= mb_convert_case($a[$i], MB_CASE_TITLE, $encoding) . ' ';
            else
                $r .= (strlen($a[$i]) <= 3) ? $a[$i] . ' ' : (in_array(mb_convert_case($a[$i], MB_CASE_LOWER, $encoding), $lc)) ? mb_convert_case($a[$i], MB_CASE_LOWER, $encoding) . ' ' : mb_convert_case($a[$i], MB_CASE_TITLE, $encoding) . ' ';
        }
    }
    return trim($r);
}

function mesExtensoParaNumeral($mesExtenso) {
    switch ($mesExtenso) {
        case 'JANEIRO': $mesNumeral = '01';
        break;
        case 'FEVEREIRO': $mesNumeral = '02';
        break;
        case 'MARÇO': $mesNumeral = '03';
        break;
        case 'ABRIL': $mesNumeral = '04';
        break;
        case 'MAIO': $mesNumeral = '05';
        break;
        case 'JUNHO': $mesNumeral = '06';
        break;
        case 'JULHO': $mesNumeral = '07';
        break;
        case 'AGOSTO': $mesNumeral = '08';
        break;
        case 'SETEMBRO': $mesNumeral = '09';
        break;
        case 'OUTUBRO': $mesNumeral = '10';
        break;
        case 'NOVEMBRO': $mesNumeral = '11';
        break;
        case 'DEZEMBRO': $mesNumeral = '12';
        break;
    }

    return $mesNumeral;
}

function mesNumeralParaExtensoCurto($valor) {

    switch ($valor) {
        case 1;
        $mes = "Jan";
        break;
        case 2;
        $mes = "Fev";
        break;
        case 3;
        $mes = "Mar";
        break;
        case 4;
        $mes = "Abr";
        break;
        case 5;
        $mes = "Mai";
        break;
        case 6;
        $mes = "Jun";
        break;
        case 7;
        $mes = "Jul";
        break;
        case 8;
        $mes = "Ago";
        break;
        case 9;
        $mes = "Set";
        break;
        case 10;
        $mes = "Out";
        break;
        case 11;
        $mes = "Nov";
        break;
        case 12;
        $mes = "Dez";
        break;
    }

    return $mes;
}

function mesNumeralParaExtenso($mes) {

    $mesNumeral = '';

    switch ($mes) {
        case '1': $mesNumeral = 'Janeiro';
        break;
        case '2': $mesNumeral = 'Fevereiro';
        break;
        case '3': $mesNumeral = 'Março';
        break;
        case '4': $mesNumeral = 'Abril';
        break;
        case '5': $mesNumeral = 'Maio';
        break;
        case '6': $mesNumeral = 'Junho';
        break;
        case '7': $mesNumeral = 'Julho';
        break;
        case '8': $mesNumeral = 'Agosto';
        break;
        case '9': $mesNumeral = 'Setembro';
        break;
        case '10': $mesNumeral = 'Outubro';
        break;
        case '11': $mesNumeral = 'Novembro';
        break;
        case '12': $mesNumeral = 'Dezembro';
        break;
    }

    return $mesNumeral;
}

if (!function_exists('uuid')) {

    function uuid() {
        $uuid = openssl_random_pseudo_bytes(16);
        // set variant
        $uuid[8] = chr(ord($uuid[8]) & 0x39 | 0x80);
        // set version
        $uuid[6] = chr(ord($uuid[6]) & 0xf | 0x40);

        return preg_replace(
            '/(\w{8})(\w{4})(\w{4})(\w{4})(\w{12})/', '$1-$2-$3-$4-$5', bin2hex($uuid)
        );
    }

}

if (!function_exists('is_uuid')) {

    function is_uuid($uuid, $version = '[1-5]') {
        $pattern = "/^[0-9a-f]{8}-[0-9a-f]{4}-{$version}[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i";
        return !!preg_match($pattern, $uuid);
    }

}

function descricaoPermissao($permissao) {

    $descricaoPermissao = '';

    switch ($permissao) {
        case '1': $descricaoPermissao = 'Super Administrador - Pessoa que possui o maior nível de acesso ao sistema, com a possibilidade de incluir novas organizaçoes, incluir\administrar usuários, em qualquer nível de acesso e em qualquer organização. Observa e pode atuar como administrador\gestor nos projetos.';
        break;
        case '2': $descricaoPermissao = 'Gestor - Pessoa que atua na gestão dos projetos que estão sob sua responsabilidade.';
        break;
    }

    return $descricaoPermissao;
}

function descricaoCurtaPermissao($permissao) {

    $descricaoPermissao = '';

    switch ($permissao) {
        case '1': $descricaoPermissao = 'Super Administrador';
        break;
        case '2': $descricaoPermissao = 'Gestor';
        break;
    }

    return $descricaoPermissao;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function UR_exists($url){
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_NOBODY, true);
 curl_exec($ch);
 $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 curl_close($ch);
 if($retcode==200) echo 'YES';
 else              echo 'NO';
}

function urlExists($url) {

    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if($httpCode >= 200 && $httpCode <= 400) {
        return true;
    } else {
        return false;
    }

    curl_close($handle);
}

function siglaOrgao($orgao = ''){

    switch ($orgao) {
        case 'CONSELHO NACIONAL DE JUSTIÇA':
        $sigla = 'CNJ';
        break;
        case 'INST.FED.DE EDUC.,CIENC.E TEC.DE MINAS GERAIS':
        $sigla = 'IFMG';
        break;
        case 'MINISTERIO DOS DIREITOS HUMANOS':
        $sigla = 'MDH';
        break;
        case 'MIN.DAS MULH., DA IG.RACIAL E DOS DIR.HUMANOS':
        $sigla = 'MDMIRDH';
        break;
        case 'MINIST. DA INDUSTRIA, COM.EXTERIOR E SERVICOS':
        $sigla = 'MDIC';
        break;
        case 'MINIST.DOS TRANSP.,PORTOS E AVIACAO CIVIL':
        $sigla = 'MTPAC';
        break;
        case 'MINISTERIO DO TRABALHO E EMPREGO':
        $sigla = 'MTB';
        break;
        case 'MINISTERIO DO TRABALHO E PREVIDENCIA SOCIAL':
        $sigla = 'MTPS';
        break;
        case 'MINISTÉRIO DA AGRICULTURA, PECUARIA E ABASTECIMENTO':
        $sigla = 'MAPA';
        break;
        case 'MINISTÉRIO DA CIÊNCIA, TECNOLOGIA, INOVAÇÕES E COMUNICAÇÕES':
        $sigla = 'MCTIC';
        break;
        case 'MINISTERIO DA CULTURA':
        $sigla = 'CULTURA';
        break;
        case 'PRESIDẼNCIA DA REPÚBLICA':
        $sigla = 'PR';
        break;
        case 'PRESIDENCIA DA REPÚBLICA':
        $sigla = 'PR';
        break;
        case 'MINISTERIO DA DEFESA':
        $sigla = 'DEFESA';
        break;
        case 'MINISTERIO DA EDUCACAO':
        $sigla = 'MEC';
        break;
        case 'MINISTERIO DA FAZENDA':
        $sigla = 'FAZENDA';
        break;
        case 'MINISTERIO DA INTEGRACAO NACIONAL':
        $sigla = 'INTEGRACAO';
        break;
        case 'MINISTERIO DA JUSTICA':
        $sigla = 'JUSTICA';
        break;
        case 'MINISTÉRIO DA PESCA E AQUICULTURA':
        $sigla = 'MPA';
        break;
        case 'MINISTERIO DA SAUDE':
        $sigla = 'SAUDE';
        break;
        case 'MINISTÉRIO DA TRANSPARÊNCIA E CONTROLADORIA-GERAL DA UNIÃO':
        $sigla = 'CGU';
        break;
        case 'MINISTERIO DAS CIDADES':
        $sigla = 'CIDADES';
        break;
        case 'MINISTERIO DAS COMUNICACOES':
        $sigla = 'COMUNICACOES';
        break;
        case 'MINISTERIO DAS RELACOES EXTERIORES':
        $sigla = 'MRE';
        break;
        case 'MINISTERIO DE MINAS E ENERGIA':
        $sigla = 'MME';
        break;
        case 'MINISTERIO DO DESENVOLVIMENTO AGRARIO':
        $sigla = 'MDA';
        break;
        case 'MINISTERIO DO DESENVOLVIMENTO SOCIAL':
        $sigla = 'MDS';
        break;
        case 'MINISTERIO DO ESPORTE':
        $sigla = 'ESPORTE';
        break;
        case 'MINISTERIO DO TURISMO':
        $sigla = 'TURISMO';
        break;
        case 'MINISTERIO DO MEIO AMBIENTE':
        $sigla = 'MMA';
        break;
        case 'MINISTERIO DO DESENVOLVIMENTO REGIONAL':
        $sigla = 'MDR';
        break;
        case 'MINISTERIO DA CIDADANIA':
        $sigla = 'CIDADANIA';
        break;
        case 'MINISTERIO DA JUSTICA E SEGURANCA PUBLICA':
        $sigla = 'JUSTIÇA';
        break;
        case 'MINIST. DA CIENCIA, TECNOL., INOV. E COMUNICACOES':
        $sigla = 'MCTIC';
        break;
        case 'MINIST. MULHER, FAMILIA E DIREITOS HUMANOS':
        $sigla = 'MDH';
        break;

        default:
        $sigla = $orgao;
        break;
    }
    return $sigla;
}

function siglaMinisterio($ministerio = ''){

    switch ($ministerio) {
        case 'Ministério da Agricultura, Pecuária e Abastec':
        $sigla = 'Agricultura';
        break;
        case 'Ministério do Desenvolvimento Social':
        $sigla = 'MDS';
        break;
        case 'Ministério da Infraestrutura':
        $sigla = 'Infraestrutura';
        break;
        case 'Ministério da Fazenda':
        $sigla = 'Economia';
        break;
        case 'Ministério do Turismo':
        $sigla = 'MTUR';
        break;
        case 'Ministério da Mulher, Família e Direitos Huma':
        $sigla = 'MDH';
        break;
        case 'Ministério das Relações Exteriores':
        $sigla = 'MRE';
        break;
        case 'Ministério da Justiça e Segurança Pública':
        $sigla = 'Justiça';
        break;
        case 'Ministério do Meio Ambiente':
        $sigla = 'MMA';
        break;
        case 'Ministério da Saúde':
        $sigla = 'Saúde';
        break;
        case 'Ministério do Desenvolvimento Regional':
        $sigla = 'MDR';
        break;
        case 'Ministério de Minas e Energia':
        $sigla = 'MME';
        break;
        case 'Ministério da Ciência, Tecnologia, Inovações ':
        $sigla = 'MCTIC';
        break;
        case 'Ministério da Educação':
        $sigla = 'Educação';
        break;
        case 'Ministério da Defesa':
        $sigla = 'Defesa';
        break;

        default:
        $sigla = $ministerio;
        break;
    }
    return $sigla;
}

function abreviarSituacaoConvenio($situacao = '') {

    switch ($situacao) {
        case 'Aguardando Prestação de Contas':
        $situacaoAbreviada = 'Aguardar P. Contas';
        break;
        case 'Assinatura Pendente Registro TV Siafi':
        $situacaoAbreviada = 'Assin. Pend. Regist. TV SIAFI';
        break;
        case 'Cancelado':
        $situacaoAbreviada = 'Cancelado';
        break;
        case 'Convênio Anulado':
        $situacaoAbreviada = 'Convênio Anulado';
        break;
        case 'Convênio Rescindido':
        $situacaoAbreviada = 'Convênio Rescindido';
        break;
        case 'Em execução':
        $situacaoAbreviada = 'Em execução';
        break;
        case 'Inadimplente':
        $situacaoAbreviada = 'Inadimplente';
        break;
        case 'Prestação de Contas Aprovada':
        $situacaoAbreviada = 'P. Contas Aprovada';
        break;
        case 'Prestação de Contas Aprovada com Ressalvas':
        $situacaoAbreviada = 'P. Contas Aprov. Ressalvas';
        break;
        case 'Prestação de Contas Comprovada em Análise':
        $situacaoAbreviada = 'P. Contas Comprov. em Análise';
        break;
        case 'Prestação de Contas Concluída':
        $situacaoAbreviada = 'P. Contas Concluída';
        break;
        case 'Prestação de Contas em Análise':
        $situacaoAbreviada = 'P. Contas em Análise';
        break;
        case 'Prestação de Contas em Complementação':
        $situacaoAbreviada = 'P. Contas Complementação';
        break;
        case 'Prestação de Contas enviada para Análise':
        $situacaoAbreviada = 'P. Contas Enviada Análise';
        break;
        case 'Prestação de Contas Iniciada Por Antecipação':
        $situacaoAbreviada = 'P. Contas Iniciada Antecipação';
        break;
        case 'Prestação de Contas Rejeitada':
        $situacaoAbreviada = 'P. Contas Rejeitada';
        break;
        case 'Proposta/Plano de Trabalho Aprovado':
        $situacaoAbreviada = 'Prop./Pl. Trab. Aprovada';
        break;
        case 'Proposta/Plano de Trabalho Complementado em Análise':
        $situacaoAbreviada = 'Prop./Pl. Trab. Complem. em Análise';
        break;
        case 'Proposta/Plano de Trabalho Complementado Enviado para Análise':
        $situacaoAbreviada = 'Prop./Pl. Trab. Complem. Enviadp Análise';
        break;
        default:
        $situacaoAbreviada = $situacao;
        break;
    }

    return $situacaoAbreviada;
}

function legenda(){
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <h6>Legenda:</h6>
            <ul class="list-group ">
                <li class="list-group-item bg-primary" style="background-color: #9FCDFF !Important; padding: 3px !Important; padding-left: 17px !Important;">Contrato/convênio concluído</li>
            </ul>
            <small class="text-primary">Contrato de Repasse/Convênio não está mais ativo</small>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <h6>&nbsp;</h6>
            <ul class="list-group ">
                <li class="list-group-item bg-success text-white" style="background-color: #4CA746 !Important; color: #FFFFFF !Important;padding: 3px !Important; padding-left: 17px !Important;">Em execução, mas não precisa mais de Financeiro</li>
            </ul>
            <small class="text-success">Célula da coluna Valor Desembolsado</small>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <h6>&nbsp;</h6>
            <ul class="list-group ">
                <li class="list-group-item bg-danger text-white" style="background-color: #df4957 !Important; color: #FFFFFF !Important;padding: 3px !Important; padding-left: 17px !Important;">Contrato/convênio cancelado ou anulado</li>
            </ul>
            <small class="text-danger">Toda a fonte da linha na cor vermelha</small>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            &nbsp;
        </div>

        <!-- <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <h6>Legenda coluna: <b>Vigência</b></h6>
            <ul class="list-group ">
                <li class="list-group-item bg-success text-white" style="background-color: #7eca8f !Important; color: #FFFFFF !Important; padding: 3px !Important; padding-left: 17px !Important;">30 a 45 dias para vencer => Verde</li>
                <li class="list-group-item bg-warning text-dark" style="background-color: #ffd96a !Important; color: #000000 !Important;padding: 3px !Important; padding-left: 17px !Important;">15 a 29 dias para vencer => Laranja</li>
                <li class="list-group-item bg-danger text-white" style="background-color: #df4957 !Important; color: #FFFFFF !Important;padding: 3px !Important; padding-left: 17px !Important;">Até 14 dias para vencer => Vermelha</li>
                <li class="list-group-item bg-secondary text-white" style="background-color: #a6acb1 !Important; color: #000000 !Important;padding: 3px !Important; padding-left: 17px !Important;">Vigência vencida => Cinza</li>
            </ul>
        </div> -->

        <!-- <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <h6>(*) <b>Possível valor apto</b></h6>
            <ul class="list-group ">
                <li class="list-group-item bg-light text-dark">Informação em fase de análise, conforme Portaria Interministerial Nº 424, de 30/12/2016</li>
            </ul>
        </div> -->
    </div>
    <?php
}

function url_exists($url) {

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($code == 200); // verifica se recebe "status OK"
}

function hslToRgb($h, $s, $l){
    if($s == 0){
        $r = $g = $b = $l;
    }else{
        if($l < 0.5){
            $q =$l * (1 + $s);
        } else {
            $q =$l + $s - $l * $s;
        }
        $p = 2 * $l - $q;
        $r = hue2rgb($p, $q, $h + 1/3);
        $g = hue2rgb($p, $q, $h);
        $b = hue2rgb($p, $q, $h - 1/3);
    }
    $return=array(floor($r * 255), floor($g * 255), floor($b * 255));
    return $return;
}

function hue2rgb($p, $q, $t){
    if($t < 0) { $t++; }
    if($t > 1) { $t--; }
    if($t < 1/6) { return $p + ($q - $p) * 6 * $t; }
    if($t < 1/2) { return $q; }
    if($t < 2/3) { return $p + ($q - $p) * (2/3 - $t) * 6; }
    return $p;
}

function numberToColorHsl($i, $min, $max) {
    $ratio = $i;
    if ($min> 0 || $max < 1) {
        if ($i < $min) {
            $ratio = 0;
        } elseif ($i > $max) {
            $ratio = 1;
        } else {
            $range = $max - $min;
            $ratio = ($i-$min) / $range;
        }
    }
    $hue = $ratio * 1.2 / 3.60;
    $rgb = hslToRgb($hue, 1, .5);
    return 'rgb('.$rgb[0].','.$rgb[1].','.$rgb[2].')'; 
}

function abreviacaoCasaParlamentar($casa = '') {

    switch ($casa) {
        case 'Deputado':
        $abreviacaoCasa = 'DEP ';
        break;
        case 'Senador':
        $abreviacaoCasa = 'SEN ';
        break;
        case 'Governador':
        $abreviacaoCasa = 'Gov ';
        break;
        
        default:
        $abreviacaoCasa = $casa;
        break;
    }

    return $abreviacaoCasa;
}

function ajustarBarra($texto = '') {

    $texto = str_replace("/", ".DIRECTORY_SEPARATOR.", $texto);

    return $texto;
}

function ajustarBarraRoute($texto = '') {

    $texto = str_ireplace("/", "alt47", $texto);

    return $texto;
}

function trocarVirgulaPorBarra($texto = '') {

    $texto = str_replace(",", " <b>/</b> ", $texto);

    return $texto;
}

function perfil($quantidade_cadastro_parlamentar = '', $total_cadastro_parlamentar = '', $total_cadastro) {

    $perfil = "E";
    $calculo = 0;

    if($quantidade_cadastro_parlamentar >= 1) {

        $calculo = ($total_cadastro_parlamentar/$total_cadastro)*100;

        if($calculo > 0.7) {

            $perfil = "A";
        } elseif($calculo > 0.5) {

            $perfil = "B";
        } elseif($calculo > 0.25) {

            $perfil = "C";
        } else {

            $perfil = "D";
        }
    }

    return $perfil;
}

function incluirNumeroZeroSeMenorQueDez($valor = '') {

    $valor != '' && $valor < 10 ? $valor = '0' . $valor : $valor = $valor;

    return $valor;
}

function abreviacaoCargos($cargo = '') {

    $abreviacao = '';

    switch ($cargo) {
        case '1ª Procuradora Adjunta': $abreviacao = '1ªProc_Adj';
        break;
        case 'Presidente': $abreviacao = 'P';
        break;
        case 'Ouvidor-Geral': $abreviacao = 'Ouv_Ger';
        break;
        case 'Relator-Parcial': $abreviacao = 'Rel_Parc';
        break;
        case '2ª Procuradora Adjunta': $abreviacao = '2ªProc_Adj';
        break;
        case 'Coordenadora': $abreviacao = 'Coord';
        break;
        case 'Secretário de Transparência': $abreviacao = 'Sec_Transp';
        break;
        case 'Corregedor': $abreviacao = 'Correg';
        break;
        case '2º Secretário Adjunto': $abreviacao = '2ºSec_Adj';
        break;
        case '4º Suplente de Secretário': $abreviacao = '4ºSupl_Sec';
        break;
        case 'Procurador': $abreviacao = 'Proc';
        break;
        case '3ª Procuradora Adjunta': $abreviacao = '3ªProc_Adj';
        break;
        case 'Relator-Geral': $abreviacao = 'Rel_Geral';
        break;
        case '2º Secretário': $abreviacao = '2ºSec';
        break;
        case '1º Secretário': $abreviacao = '1ºSec';
        break;
        case '3º Secretário': $abreviacao = '3ºSec';
        break;
        case '3º Secretário Adjunto': $abreviacao = '3ºSec_Adj';
        break;
        case 'Secretário de Comunicação Social': $abreviacao = 'SECOM';
        break;
        case '4º Secretário': $abreviacao = '4ºSec';
        break;
        case '1º Secretário Adjunto': $abreviacao = '1ºSec_Adj';
        break;
        case 'Sub-Relator': $abreviacao = 'Sub_Rel';
        break;
        case '2ª Coordenadora Adjunta': $abreviacao = '2ªCoord_Adj';
        break;
        case '3º Suplente de Secretário': $abreviacao = '3ºSupl_Sec';
        break;
        case '1º Vice-Presidente': $abreviacao = '1ºV_P';
        break;
        case 'Procuradora': $abreviacao = 'Proc';
        break;
        case 'Coordenador': $abreviacao = 'Coord';
        break;
        case '2º Suplente de Secretário': $abreviacao = '2ºSupl_Sec';
        break;
        case '2º Vice-Presidente': $abreviacao = '2ºV_P';
        break;
        case 'Secretário de Relações Internacionais': $abreviacao = 'SecRelInter';
        break;
        case 'Relator': $abreviacao = 'Rel';
        break;
        case '3º Vice-Presidente': $abreviacao = '3ºV_P';
        break;
        case 'Vice-Presidente': $abreviacao = 'V_P';
        break;
        case 'Sec de Part Inter e Mídias Digitais': $abreviacao = 'SecPartInterMídDig';
        break;
        case '1ª Coordenadora Adjunta': $abreviacao = '1ªCoord_Adj';
        break;
        case '1º Suplente de Secretário': $abreviacao = '1ºSupl_Sec';
        break;
        case '3ª Coordenadora Adjunta': $abreviacao = '3ªCoord_Adj';
        break;
        case 'Vice-Coordenador': $abreviacao = 'V_Coord';
        break;

        case 'COORDENADOR': $abreviacao = 'Coord';
        break;
        case '2ª VICE-PRESIDENTE': $abreviacao = '2ªV_P';
        break;
        case 'OUVIDOR-GERAL': $abreviacao = 'Ouv_Ger';
        break;
        case 'RELATOR': $abreviacao = 'Rel';
        break;
        case 'PRESIDENTE': $abreviacao = 'P';
        break;
        case 'Relator da Receita': $abreviacao = 'Rel_Rec';
        break;
        case 'CORREGEDOR': $abreviacao = 'Correg';
        break;
        case '1ª VICE-PRESIDENTE': $abreviacao = '1ªV_P';
        break;
        case 'VICE-PRESIDENTE': $abreviacao = 'V_P';
        break;
        case 'RELATORA': $abreviacao = 'Rel';
        break;
        case '2º VICE-PRESIDENTE': $abreviacao = '2ºV_P';
        break;
        case 'Relator do Projeto de Plano Plurianual': $abreviacao = 'RelProjPlPlu';
        break;
        case 'GRÃO-MESTRE': $abreviacao = 'GRÃO-MESTRE';
        break;

        
        default:
        $abreviacao = $cargo;
        break;
    }

    return $abreviacao;

}

function passarTextoParaMaiusculo($texto = '') {

    return mb_strtoupper($texto, 'UTF-8');

}

function passarTextoParaMinusculo($texto = '') {

    return mb_strtolower($texto, 'UTF-8');

}

function sanitizeString($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
    return $str;
}

function coloracaoStatus($tatus = '') {

    switch ($tatus) {
        case 'Pendente':
        $cor = 'badge badge-danger';
        break;

        case 'Em andamento':
        $cor = 'badge badge-warning';
        break;

        case 'Concluída':
        $cor = 'badge badge-success';
        break;
        
        default:
        $cor = 'badge badge-light';
        break;
    }

    return $cor;

}

function estadoPorUf($estado = '') {

    switch ($estado) {
        case 'Acre':
        $uf = 'AC';
        break;

        case 'Alagoas':
        $uf = 'AL';
        break;

        case 'Amazonas':
        $uf = 'AM';
        break;

        case 'Amapá':
        $uf = 'AP';
        break;

        case 'Bahia':
        $uf = 'BA';
        break;

        case 'Ceará':
        $uf = 'CE';
        break;

        case 'Distrito Federal':
        $uf = 'DF';
        break;

        case 'Espírito Santo':
        $uf = 'ES';
        break;

        case 'Goiás':
        $uf = 'GO';
        break;

        case 'Maranhão':
        $uf = 'MA';
        break;

        case 'Minas Gerais':
        $uf = 'MG';
        break;

        case 'Mato Grosso do Sul':
        $uf = 'MS';
        break;

        case 'Mato Grosso':
        $uf = 'MT';
        break;

        case 'Pará':
        $uf = 'PA';
        break;

        case 'Paraíba':
        $uf = 'PB';
        break;

        case 'Pernambuco':
        $uf = 'PE';
        break;

        case 'Piauí':
        $uf = 'PI';
        break;

        case 'Paraná':
        $uf = 'PR';
        break;

        case 'Rio de Janeiro':
        $uf = 'RJ';
        break;

        case 'Rio Grande do Norte':
        $uf = 'RN';
        break;

        case 'Rondônia':
        $uf = 'RO';
        break;

        case 'Roraima':
        $uf = 'RR';
        break;

        case 'Rio Grande do Sul':
        $uf = 'RS';
        break;

        case 'Santa Catarina':
        $uf = 'SC';
        break;

        case 'Sergipe':
        $uf = 'SE';
        break;

        case 'São Paulo':
        $uf = 'SP';
        break;

        case 'Tocantins':
        $uf = 'TO';
        break;



        
        default:
        $uf = $estado;
        break;
    }

    return $uf;

}

function nomeCampoNormalizado($campo) {

    $campos = ['instrumento_ativo','data_retirada_suspensiva','dia_fim_vigenc_conv','motivo_suspensao','percentual_financeiro_desbloqueado','percentual_fisico_aferido','permite_liberar_primeiro_repasse_projeto','status_analise_siconv','vl_empenhado_conv','vl_contrapartida_conv','vl_desembolsado_conv','motivo_suspensao','sit_convenio','subsituacao_conv'];

    $campoNormalizado = '';

    switch ($campo) {
        case 'instrumento_ativo': $campoNormalizado = 'Instrumento ativo';
        break;
        case 'data_retirada_suspensiva': $campoNormalizado = 'Data de retirada da suspensiva';
        break;
        case 'dia_fim_vigenc_conv': $campoNormalizado = 'Data fim da vigẽncia';
        break;
        case 'motivo_suspensao': $campoNormalizado = 'Motivo da suspensão';
        break;
        case 'percentual_financeiro_desbloqueado': $campoNormalizado = 'Percentual financeiro desbloqueado';
        break;
        case 'percentual_fisico_aferido': $campoNormalizado = 'Percentual físico aferido';
        break;
        case 'permite_liberar_primeiro_repasse_projeto': $campoNormalizado = 'Permite liberar primeiro repasse do projeto';
        break;
        case 'status_analise_siconv': $campoNormalizado = 'Status do SICONV após análise do MDR';
        break;
        case 'vl_empenhado_conv': $campoNormalizado = 'Valor empenhado';
        break;
        case 'vl_contrapartida_conv': $campoNormalizado = 'Valor da contrapartida';
        break;
        case 'vl_desembolsado_conv': $campoNormalizado = 'Valor desembolsado';
        break;
        case 'motivo_suspensao': $campoNormalizado = 'Motivo da suspensão';
        break;
        case 'sit_convenio': $campoNormalizado = 'Situação do convênio/contrato';
        break;
        case 'subsituacao_conv': $campoNormalizado = 'Subsituação do convênio/contrato';
        break;

        default:
        $campoNormalizado = $campo;
        break;
    }

    return $campoNormalizado;
}

function nomeCampoTabVisMdrNormalizado($campo) {

    $campoNormalizado = '';

    switch ($campo) {
        case 'NPAC_DBGESTORES': $campoNormalizado = 'Contratos de Repasse';
        break;
        case 'NPAC_FGTS': $campoNormalizado = 'FGTS';
        break;
        case 'NPAC_SICONV': $campoNormalizado = 'Convênios';
        break;
        case 'PAC_MCID': $campoNormalizado = 'PAC Min. Cidades';
        break;
        case 'PAC_MI': $campoNormalizado = 'PAC Min. Integração';
        break;
        case 'origem': $campoNormalizado = 'Origem dos Instrumentos';
        break;
        case 'txt_sigla_area': $campoNormalizado = 'Área(s) do MDR';
        break;
        case 'Contratado - concluído': $campoNormalizado = 'Concluído';
        break;
        case 'Contratado - normal': $campoNormalizado = 'Normal';
        break;
        case 'Contratado - suspensiva': $campoNormalizado = 'Suspensiva';
        break;
        case 'Contratado - em Prestação de Contas': $campoNormalizado = 'Em Prestação de Contas';
        break;
        case 'Contratado - em TCE': $campoNormalizado = 'Em TCE';
        break;
        case 'Contratado - liminar': $campoNormalizado = 'Liminar';
        break;
        case 'Contratado – suspensiva e liminar': $campoNormalizado = 'Suspensiva e Liminar';
        break;
        case 'periodoInicial': $campoNormalizado = 'Período';
        break;
        case 'dsc_situacao_contrato_mdr': $campoNormalizado = 'Situação do Instrumento MDR';
        break;
        case 'uf': $campoNormalizado = 'UF';
        break;
        case 'cod_mdr': $campoNormalizado = 'Código Interno MDR';
        break;
        case 'cod_cipi': $campoNormalizado = 'Código CIPI <small class="text-muted">(Cadastro Integrado de Projetos de Investimento)</small>';
        break;
        case 'num_processo_sei': $campoNormalizado = 'Número do Processo SEI';
        break;
        case 'cod_s2id': $campoNormalizado = 'Código do Sistema S2iD';
        break;
        case '': $campoNormalizado = '';
        break;
        case 'numero_generico_contrato': $campoNormalizado = 'Outro Número do Instrumento';
        break;
        case 'municipio': $campoNormalizado = 'Município';
        break;
        case 'ibge': $campoNormalizado = 'Código IBGE';
        break;
        case 'codigo_saci': $campoNormalizado = 'Código SACI';
        break;
        case 'nm_convenio_siafi': $campoNormalizado = 'Número Convênio SIAFI';
        break;
        case 'tipo_instrumento': $campoNormalizado = 'Tipo do Instrumento';
        break;
        case 'dsc_agente_financeiro': $campoNormalizado = 'Agente Financeiro';
        break;
        case 'txt_fonte': $campoNormalizado = 'Fonte';
        break;
        case 'concedente': $campoNormalizado = 'Concedente';
        break;
        case 'bln_ativo': $campoNormalizado = 'Instrumento Ativo';
        break;
        case 'dsc_modalidade': $campoNormalizado = 'Modalidade';
        break;
        case 'dsc_situacao_contrato': $campoNormalizado = 'Situação do Contrato';
        break;
        case 'dsc_situacao_obra': $campoNormalizado = 'Situação da Obra';
        break;
        case 'txt_empreendimento': $campoNormalizado = 'Nome do Empreendimento';
        break;
        case 'prc_execucao': $campoNormalizado = 'Percentual de Execução Financeira';
        break;
        case 'prc_execucao_fisica': $campoNormalizado = 'Percentual de Execução Física';
        break;
        case 'prc_empenhado': $campoNormalizado = 'Percentual de Empenhado';
        break;
        case 'prc_desembolsado': $campoNormalizado = 'Percentual de Desembolso';
        break;
        case 'prc_desbloqueado': $campoNormalizado = 'Percentual de Desbloqueio';
        break;
        case 'vlr_investimento': $campoNormalizado = 'Valor de Investimento';
        break;
        case 'vlr_repasse': $campoNormalizado = 'Valor de Repasse';
        break;
        case 'vlr_contrapartida': $campoNormalizado = 'Valor Contrapartida';
        break;
        case 'vlr_pago_conta': $campoNormalizado = 'Valor Desembolsado/Liberado';
        break;
        case 'vlr_desbloqueado_vr': $campoNormalizado = 'Valor Desbloqueado';
        break;
        case 'funcional': $campoNormalizado = 'Funcional';
        break;
        case 'dsc_tomador': $campoNormalizado = 'Tomador';
        break;
        case 'bln_carteira_mdr': $campoNormalizado = 'Carteira MDR';
        break;
        case 'bln_carteira_mdr_ativo': $campoNormalizado = 'Carteira MDR Ativa';
        break;
        case 'dsc_situacao_objeto_mdr': $campoNormalizado = 'Situação do Objeto MDR';
        break;
        case 'vlr_empenhado': $campoNormalizado = 'Valor Empenhado';
        break;
        case 'dte_carga': $campoNormalizado = 'Data de Atualização da Carga';
        break;
        case 'cod_contrato': $campoNormalizado = 'Número do Instrumento';
        break;
        case 'cod_pt': $campoNormalizado = 'Código do Plano de Trabalho';
        break;
        case 'cod_ag_operador': $campoNormalizado = 'Cód. Agente Operador';
        break;
        case 'cod_id_proposta': $campoNormalizado = 'ID Proposta';
        break;
        case 'cod_nr_proposta': $campoNormalizado = 'Número da Proposta';
        break;
        case 'siconv_instrumento_ativo': $campoNormalizado = 'SICONV Instrumento Ativo';
        break;
        case 'siconv_convenio_assinado': $campoNormalizado = 'Convênio Assinado';
        break;
        case 'dte_assinatura_contrato': $campoNormalizado = 'Data Assinatura Contrato';
        break;
        case 'dte_inicio_obra_efetiva': $campoNormalizado = 'Data de Início (Realizado)';
        break;
        case 'dte_fim_obra': $campoNormalizado = 'Data do Fim (Realizado)';
        break;
        case 'dte_ult_mov_fin': $campoNormalizado = 'Data da Última Movimentação Financeira';
        break;
        case 'dsc_situacao_contrato_compl': $campoNormalizado = 'Sit. do Contrato Complemento';
        break;
        case 'siconv_dsc_sit_convenio': $campoNormalizado = 'SICONV Situação do Convênio';
        break;
        case 'siconv_dsc_sit_contratacao': $campoNormalizado = 'SICONV Situação da Contratação';
        break;
        case 'siconv_dsc_subsit_convenio': $campoNormalizado = 'SICONV Subsituação do Convênio';
        break;
        case 'siconv_dsc_sit_proposta': $campoNormalizado = 'SICONV Situação da Proposta';
        break;
        case 'dsc_motivo_paralisacao': $campoNormalizado = 'Motivo da Paralisação';
        break;
        case 'par_348': $campoNormalizado = 'Portaria 348';
        break;
        case 'avancar_cidades': $campoNormalizado = 'Avançar Cidades';
        break;
        case 'bln_emenda': $campoNormalizado = 'É emenda';
        break;
        case 'vlr_pago': $campoNormalizado = 'Valor Pago';
        break;
        case 'dsc_paralisada_mdr': $campoNormalizado = 'Paralisada MDR';
        break;
        case 'bln_pro_brasil': $campoNormalizado = 'Pró Brasil';
        break;
        case 'bln_mais_nordeste': $campoNormalizado = 'Mais Nordeste';
        break;
        case 'bln_revitalizacao_bacias': $campoNormalizado = 'Revitalização de Bacias';
        break;
        case 'qtd_dias_ult_mov_fin': $campoNormalizado = 'Quantidade de dias desde a última movimentação financeira';
        break;
        case 'e_pac': $campoNormalizado = 'Fez parte do PAC';
        break;
        case 'num_cnpj_tomador': $campoNormalizado = 'CNPJ do tomador';
        break;
        case 'dte_inicio_obra_prevista': $campoNormalizado = 'Data de Início (Previsto)';
        break;
        case 'dte_fim_obra_prevista': $campoNormalizado = 'Data do Fim (Previsto)';
        break;
        case 'dte_ano_conclusao_previsto': $campoNormalizado = 'Ano Previsto de Cnclusão';
        break;
        case 'vlr_restos_a_pagar': $campoNormalizado = 'Valor de Resto a Pagar';
        break;
        case 'vlr_anual_conclusao_previsto': $campoNormalizado = 'Valor para Conclusão Anual (Conforme CIPI)';
        break;
        case 'bln_apto_inauguracao': $campoNormalizado = 'Entrega Confirmada?';
        break;
        case 'dte_inauguracao': $campoNormalizado = 'Data da Entrega (Realizado)';
        break;
        case 'dsc_familias_beneficiadas': $campoNormalizado = 'Descrição das Famílias Beneficiadas';
        break;
        case 'num_familias_beneficiadas': $campoNormalizado = 'Número das Famílias Beneficiadas';
        break;
        case 'mes_previsto': $campoNormalizado = 'Mês Previsto da Entrega';
        break;
        case 'mes': $campoNormalizado = 'Mês Efetivo da Entrega';
        break;
        case 'tipo_objeto': $campoNormalizado = 'Classificação por Eixo, Tipo e Subtipo';
        break;
        case 'ano_previsto': $campoNormalizado = 'Ano Previsto da Entrega';
        break;
        case 'ano': $campoNormalizado = 'Ano Efetivo da Entrega';
        break;
        case 'dte_inauguracao_prevista': $campoNormalizado = 'Data da Entrega (Previsto)';
        break;
        case 'dsc_beneficios_empreendimento': $campoNormalizado = 'Definição dos Benefícios do Empreendimento';
        break;
        case 'nom_conceito': $campoNormalizado = 'Conceito';
        break;
        case 'dsc_conceito': $campoNormalizado = 'Descrição do Conceito';
        break;
        case 'dsc_status_conceito': $campoNormalizado = 'Status do Conceito';
        break;
        case 'txt_observacao': $campoNormalizado = 'Observação';
        break;
        case 'dsc_aplicacao_destinacao': $campoNormalizado = 'Utilizado em qual aplicação?';
        break;
        case 'prc_execucao_financeira': $campoNormalizado = '% de Execução Financeira';
        break;
        case 'bln_empreendimento_estrategico': $campoNormalizado = 'Empreendimento Estratégico';
        break;
        case 'cod_resultado_primario': $campoNormalizado = 'RP - Resultado Primário';
        break;
        case 'ano_orcamentario': $campoNormalizado = 'Ano Orçamentário';
        break;
        case '': $campoNormalizado = '';
        break;

        default:
        $campoNormalizado = $campo;
        break;
    }

    return $campoNormalizado;
}

function nomeCampoTabelaNormalizado($campo) {

    $campoNormalizado = '';

    switch ($campo) {

        case 'nom_organizacao': $campoNormalizado = 'Nome da Unidade';
        break;
        case 'sgl_organizacao': $campoNormalizado = 'Sigla da Unidade';
        break;
        case 'rel_cod_organizacao': $campoNormalizado = 'Vinculada ou Subordinada a qual Unidade?';
        break;
        case 'dsc_pei': $campoNormalizado = 'Descrição do PEI';
        break;
        case 'num_ano_inicio_pei': $campoNormalizado = 'Ano de Incialização do PEI';
        break;
        case 'num_ano_fim_pei': $campoNormalizado = 'Ano de Finalização do PEI';
        break;
        case 'dsc_missao': $campoNormalizado = 'Missão';
        break;
        case 'dsc_visao': $campoNormalizado = 'Visão';
        break;
        case 'dsc_valores': $campoNormalizado = 'Valores';
        break;
        case 'dsc_perspectiva': $campoNormalizado = 'Perspectiva';
        break;
        case 'dsc_objetivo_estrategico': $campoNormalizado = 'Objetivo Estratégico';
        break;
        case 'num_nivel_hierarquico_apresentacao': $campoNormalizado = 'Código';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;

        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;
        case '': $campoNormalizado = '';
        break;


        default:
        $campoNormalizado = $campo;
        break;
    }

    return $campoNormalizado;
}

function calcularPercentual($valorObtido = 0, $valorTotal = 0) {

    $resultado = formatarValorFloatMysql(0.00);

    if($valorTotal != 0) {

        $resultado = formatarValorFloatMysql((($valorObtido/$valorTotal)*100));

    }

    return $resultado;

}

function to_array($value): array
{
    $arr = (array) $value;
    if (! is_object($value)) {
        return $arr;
    }
    $class = get_class($value);
    $keys = str_replace(["\0*\0", "\0{$class}\0"], '', array_keys($arr));
    return array_combine($keys, $arr);
}

function acresentarZeroADireita($valor = '') {

    $quantidade = strlen($valor);

    $quantidade == 1 ? $valor = '00000'.$valor : $valor = $valor;

    $quantidade == 2 ? $valor = '0000'.$valor : $valor = $valor;

    $quantidade == 3 ? $valor = '000'.$valor : $valor = $valor;

    $quantidade == 4 ? $valor = '00'.$valor : $valor = $valor;

    $quantidade == 5 ? $valor = '0'.$valor : $valor = $valor;

    // $quantidade == 6 ? $valor = '0'.$valor : $valor = $valor;

    return $valor;

}

function contains($palavra, $frase)
{
    return strpos($frase, $palavra) !== false;
}

function formatCnpjCpf($value)
{
  $cnpj_cpf = preg_replace("/\D/", '', $value);

  if (strlen($cnpj_cpf) === 11) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
}

return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);

}

function naoMostrarCpfCompleto($value) {

    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{1})/", "\$1.***.***-*\$5", $cnpj_cpf);
    }

    return preg_replace("/(\d{1})(\d{3})(\d{3})(\d{4})(\d{1})/", "\$1.***.***-*\$6", $cnpj_cpf);

}

function pergarPrimeiraLetraUser($nameUser = "") {

    $partesNome = explode(" ", $nameUser);

    is_array($partesNome) && $partesNome > 1 ? $sigla = mb_substr($partesNome[0],0,1,'UTF-8') . mb_substr($partesNome[count($partesNome)-1],0,1,'UTF-8') : $sigla = mb_substr($partesNome[count($partesNome)-1],0,1,'UTF-8');

    return $sigla;

}

function tratamentoFormatoPorNomeColuna($column_name = "",$conteudo = "") {

    $inicialColumn = substr($column_name,0,3);

    switch ($inicialColumn) {
        case 'dte':
        $conteudo = converterData('EN','PTBR',$conteudo);
        break;
        
        default:
        $conteudo = $conteudo;
        break;
    }

    if($column_name === "cod_cipi") {

        if(isset($conteudo) && !is_null($conteudo) && $conteudo != '') {
            $parte_01 = '';
            $parte_02 = '';
            $parte_03 = '';

            $parte_01 = mb_substr($conteudo,0,2,'UTF-8');
            $parte_02 = mb_substr($conteudo,2,2,'UTF-8');
            $parte_03 = mb_substr($conteudo,4,2,'UTF-8');

            $conteudo = $parte_01.'.'.$parte_02.'.'.$parte_03;
        }

    }

    if($column_name === "num_processo_sei") {

        if(isset($conteudo) && !is_null($conteudo) && $conteudo != '') {
            $len = strlen($conteudo);
            
            if($len === 17) {
                $parte_01 = '';
                $parte_02 = '';
                $parte_03 = '';
                $parte_04 = '';

                $parte_01 = mb_substr($conteudo,0,5,'UTF-8');
                $parte_02 = mb_substr($conteudo,5,6,'UTF-8');
                $parte_03 = mb_substr($conteudo,11,4,'UTF-8');
                $parte_04 = mb_substr($conteudo,15,2,'UTF-8');

                if($parte_01 != '' && $parte_02 != '' && $parte_03 != '' && $parte_04 != '') {
                    $conteudo = $parte_01.'.'.$parte_02.'/'.$parte_03.'-'.$parte_04;
                } else {
                    $conteudo = '-';
                }
            }

            if($len === 15) {
                $parte_01 = '';
                $parte_02 = '';
                $parte_03 = '';
                $parte_04 = '';

                $parte_01 = mb_substr($conteudo,0,5,'UTF-8');
                $parte_02 = mb_substr($conteudo,5,6,'UTF-8');
                $parte_03 = mb_substr($conteudo,11,2,'UTF-8');
                $parte_04 = mb_substr($conteudo,13,2,'UTF-8');

                if($parte_01 != '' && $parte_02 != '' && $parte_03 != '' && $parte_04 != '') {
                    $conteudo = $parte_01.'.'.$parte_02.'/'.$parte_03.'-'.$parte_04;
                } else {
                    $conteudo = '-';
                }
            }
        }

    }

    if($column_name === "bln_apto_inauguracao") {

        if($conteudo === "1") {

            $conteudo = "SIM";

        }

    }

    return $conteudo;

}

function mascaraCodCipi($cod_cipi = '') {
    if(isset($cod_cipi) && !is_null($cod_cipi) && $cod_cipi != '') {
        $parte_01 = '';
        $parte_02 = '';
        $parte_03 = '';
        $parte_04 = '';

        $parte_01 = mb_substr($cod_cipi,0,2,'UTF-8');
        $parte_02 = mb_substr($cod_cipi,2,2,'UTF-8');
        $parte_03 = mb_substr($cod_cipi,4,2,'UTF-8');

        if($parte_01 != '' && $parte_02 != '' && $parte_03 != '') {
            $cod_cipi = $parte_01.'.'.$parte_02.'.'.$parte_03;
        } else {
            $cod_cipi = '-';
        }

        
    }

    return $cod_cipi;
}

function mascaraNumProcessoSei($num_processo_sei = '') {

    if(isset($num_processo_sei) && !is_null($num_processo_sei) && $num_processo_sei != '') {

        $len = strlen($num_processo_sei);
        
        if($len === 17) {
            $parte_01 = '';
            $parte_02 = '';
            $parte_03 = '';
            $parte_04 = '';

            $parte_01 = mb_substr($num_processo_sei,0,5,'UTF-8');
            $parte_02 = mb_substr($num_processo_sei,5,6,'UTF-8');
            $parte_03 = mb_substr($num_processo_sei,11,4,'UTF-8');
            $parte_04 = mb_substr($num_processo_sei,15,2,'UTF-8');

            if($parte_01 != '' && $parte_02 != '' && $parte_03 != '' && $parte_04 != '') {
                $num_processo_sei = $parte_01.'.'.$parte_02.'/'.$parte_03.'-'.$parte_04;
            } else {
                $num_processo_sei = '-';
            }
        }

        if($len === 15) {
            $parte_01 = '';
            $parte_02 = '';
            $parte_03 = '';
            $parte_04 = '';

            $parte_01 = mb_substr($num_processo_sei,0,5,'UTF-8');
            $parte_02 = mb_substr($num_processo_sei,5,6,'UTF-8');
            $parte_03 = mb_substr($num_processo_sei,11,2,'UTF-8');
            $parte_04 = mb_substr($num_processo_sei,13,2,'UTF-8');

            if($parte_01 != '' && $parte_02 != '' && $parte_03 != '' && $parte_04 != '') {
                $num_processo_sei = $parte_01.'.'.$parte_02.'/'.$parte_03.'-'.$parte_04;
            } else {
                $num_processo_sei = '-';
            }
        }
    }

    return $num_processo_sei;
}

function resultadoPrimarioNomeCompleto($cod_resultado_primario = '') {

    $nomeCompleto = '';

    if(isset($cod_resultado_primario) && $cod_resultado_primario != '') {

        switch ($cod_resultado_primario) {
            case '2':
            $nomeCompleto = '2 - PRIMARIO DISCRICIONARIO';
            break;
            case '6':
            $nomeCompleto = '6 - EMENDAS INDIVIDUAIS IMPOSITIVAS';
            break;
            case '7':
            $nomeCompleto = '7 - EMENDAS DE BANCADAS IMPOSITIVAS';
            break;
            case '8':
            $nomeCompleto = '8 - EMENDAS DE COMISSAO';
            break;
            case '9':
            $nomeCompleto = '9 - EMENDAS DE RELATOR';
            break;
            
            default:
            $nomeCompleto = $cod_resultado_primario;
            break;
        }

    }

    return $nomeCompleto;

}

function limpezaTexto($texto = "") {

    // $texto = htmlentities($texto, null, 'utf-8');
    $texto = str_replace("&nbsp;"," ",$texto);
    $texto = str_replace("\n", "", $texto);
    $texto = str_replace("\r", "", $texto);
    $texto = preg_replace('/\s/',' ',$texto);
    $texto = str_replace("  "," ",$texto);

    return $texto;

}

function tirarPontoBarraTraco($texto = '') {

    if(isset($texto) && is_null($texto) && $texto != '') {

        $texto = str_replace(".","",$texto);
        $texto = str_replace("/","",$texto);
        $texto = str_replace("-","",$texto);

    }

    return $texto;
}

function prettify_numbers ( $number = '0', $decimals = 2, $int_only = false ) {
    $number = (string)$number;
    
    $simbol = null;

    // yotta: 1000000000000000000000000
    if ( $number > '99999999999999999999999' ) {
        $number = bcdiv( $number, '1000000000000000000000000', $decimals);
        $simbol = 'Y';
    } 
    
    // Zetta: 1000000000000000000000
    elseif ( $number > '999999999999999999999' ) {
        $number = bcdiv( $number, '1000000000000000000000', $decimals);
        $simbol = 'Z';
    }
    
    // Exa : 1000000000000000000
    elseif ( $number > '999999999999999999' ) {
        $number = bcdiv( $number, '1000000000000000000', $decimals);
        $simbol = 'E';
    }

    // Peta : 1000000000000000
    elseif ( $number > '999999999999999' ) {
        $number = bcdiv( $number, '1000000000000000', $decimals);
        $simbol = 'P';
    }

    // Tera : 1000000000000
    elseif ( $number > '999999999999' ) {
        $number = bcdiv( $number, '1000000000000', $decimals);
        $simbol = 'T';
    }

    // Tera : 1000000000
    elseif ( $number > '999999999' ) {
        $number = bcdiv( $number, '1000000000', $decimals);

        $primeiroNumero = explode('.', $number);

        if(is_array($primeiroNumero)) {

            $primeiroNumero[0] > 1 ? $simbol = ' Bilhões' : $simbol = ' Bilhão';

        }
    }

    // Mega : 1000000
    elseif ( $number > '999999' ) {
        $number = bcdiv( $number, '1000000', $decimals);

        $primeiroNumero = explode('.', $number);

        if(is_array($primeiroNumero)) {

            $primeiroNumero[0] > 1 ? $simbol = ' Milhões' : $simbol = ' Milhão';

        }
        
    }

    // Kilo : 1000
    elseif ( $number > '999' ) {
        $number = bcdiv( $number, '1000', $decimals);
        $simbol = ' Mil';
    }
    
    // Retorna apenas o número inteiro
    if ( $int_only ) return (int)$number . $simbol;

    // Retorna o número e o símbolo
    return $number . $simbol;
}

function qualDadosCicloDeVidaEmpreendimento($prop_dsc_situacao_proposta = '') {
    $dados = [];
    if(isset($prop_dsc_situacao_proposta) && !is_null($prop_dsc_situacao_proposta) && $prop_dsc_situacao_proposta != '') {

        switch ($prop_dsc_situacao_proposta) {
            case 'Proposta/Plano de Trabalho Cadastrados':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'Convenente';
            $dados['codProcesso'] = '06.1.1 - A';
            $dados['faseCicloVida'] = 'A proposta foi cadastrada pelo convenente, porém ainda não enviada para análise.';
            break;

            case 'Proposta/Plano de Trabalho Enviado para Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = '06.1.1 - B';
            $dados['faseCicloVida'] = 'A proposta foi cadastrada e enviada para o MDR, porém ainda não foi analisada.';
            break;

            case 'Proposta/Plano de Trabalho em Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = '06.1.1 - C';
            $dados['faseCicloVida'] = 'A proposta foi cadastrada e enviada para o MDR e está sendo analisada.';
            break;

            case 'Proposta/Plano de Trabalho em Complementação':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'Convenente';
            $dados['codProcesso'] = '06.1.1 - D';
            $dados['faseCicloVida'] = 'A proposta foi analisada pelo MDR e foi solicitado complementação.';
            break;

            case 'Proposta/Plano de Trabalho Complementado Enviado para Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = '06.1.1 - E';
            $dados['faseCicloVida'] = 'A proposta foi complementada, devolvida ao MDR e será analisada.';
            break;

            case 'Proposta/Plano de Trabalho Complementado Enviado para Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = '06.1.1 - F';
            $dados['faseCicloVida'] = 'A proposta foi complementada, devolvida ao MDR e está sendo analisada.';
            break;

            case 'Proposta/Plano de Trabalho Rejeitados':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'FIM';
            $dados['codProcesso'] = '06.1.1 - G1';
            $dados['faseCicloVida'] = 'A proposta foi rejeitada';
            break;

            case 'Proposta/Plano de Trabalho Rejeitados por Impedimento técnico':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'FIM';
            $dados['codProcesso'] = '06.1.1 - G2';
            $dados['faseCicloVida'] = 'A proposta foi rejeitada por impedimento técnico';
            break;

            case 'Proposta Aprovada/Aguardando Plano de Trabalho':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Plano de Trabalho';
            $dados['atorResponsavel'] = 'Convenente';
            $dados['codProcesso'] = '06.1.1 - H';
            $dados['faseCicloVida'] = 'A proposta foi aprovada pelo MDR e o convenente deve incluir e enviar Plano de Trabalho';
            break;

            case 'Proposta Aprovada e Plano de Trabalho em Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Plano de Trabalho';
            $dados['atorResponsavel'] = 'Mandatária';
            $dados['codProcesso'] = '06.1.1 - I';
            $dados['faseCicloVida'] = 'O Plano de Trabalho está sendo analisado pela Mandatária';
            break;

            case 'Proposta Aprovada e Plano de Trabalho em Complementação':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Plano de Trabalho';
            $dados['atorResponsavel'] = 'Convenente';
            $dados['codProcesso'] = '06.1.1 - J';
            $dados['faseCicloVida'] = 'O Plano de Trabalho foi analisado pela Mandatária e foi solicitado complementação';
            break;

            case 'Proposta Aprovada e Plano de Trabalho Complementado Enviado para Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Plano de Trabalho';
            $dados['atorResponsavel'] = 'Mandatária';
            $dados['codProcesso'] = '06.1.1 - K';
            $dados['faseCicloVida'] = 'O Plano de Trabalho foi complementado, devolvido à Mandatária e será analisado.';
            break;

            case 'Proposta Aprovada e Plano de Trabalho Complementado em Análise':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Plano de Trabalho';
            $dados['atorResponsavel'] = 'Mandatária';
            $dados['codProcesso'] = '06.1.1 - L';
            $dados['faseCicloVida'] = 'O Plano de Trabalho foi complementado, devolvido à Mandatária e está sendo analisado.';
            break;

            case 'Proposta/Plano de Trabalho Aprovados':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Proposta de trabalho';
            $dados['atorResponsavel'] = 'Convenente';
            $dados['codProcesso'] = '06.1.1 - M';
            $dados['faseCicloVida'] = 'O Plano de Trabalho foi aprovado';
            break;

            case 'Enviada para Análise Preliminar':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Chamamento Público';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = 'CP1';
            $dados['faseCicloVida'] = 'A proposta foi enviada para análise preliminar';
            break;

            case 'Classificada em Análise Preliminar':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Chamamento Público';
            $dados['atorResponsavel'] = 'MDR';
            $dados['codProcesso'] = 'CP2';
            $dados['faseCicloVida'] = 'A proposta está em análise preliminar';
            break;

            case 'Eliminada em Análise Preliminar':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Chamamento Público';
            $dados['atorResponsavel'] = 'FIM';
            $dados['codProcesso'] = 'CP3';
            $dados['faseCicloVida'] = 'A proposta foi eliminada na análise preliminar ';
            break;

            case 'Proposta Eliminada em Chamamento Público':
            $dados['cicloVida'] = 'Atos preparatórios';
            $dados['propDscSituacaoProposta'] = $prop_dsc_situacao_proposta;
            $dados['cicloVidaSegundoNivel'] = 'Chamamento Público';
            $dados['atorResponsavel'] = 'FIM';
            $dados['codProcesso'] = 'CP4';
            $dados['faseCicloVida'] = 'A proposta foi eliminada em chamamento público';
            break;
        }

    }

    return $dados;
}

function ip_details($ip) {
   $json = file_get_contents("http://ipinfo.io/");
     $details = json_decode($json); // decode json with geolocalization information
     return $details;
 }

 function iconGestaoConhecimento($perspectiva = '') {
    switch ($perspectiva) {
      case 'Dicionário':
      $icon = 'fas fa-spell-check';
      break;

      case 'Catálogo':
      $icon = 'fas fa-book-open';
      break;

      case 'Repositório':
      $icon = 'fas fa-archive';
      break;

      case 'Regras':
      $icon = 'fas fa-project-diagram';
      break;

      case 'Integração':
      $icon = 'fas fa-share-alt';
      break;

      case 'Banco de Dados':
      $icon = 'fas fa-database';
      break;

      case 'Glossário':
      $icon = 'fas fa-book';
      break;

      case '':
      $icon = '';
      break;

      case '':
      $icon = '';
      break;

      default:
      $icon = '';
      break;
  }

  return $icon;
}
