<?php

class Data {

    // Exibir data e hora de um DATETIME obtido de um banco de dados
    function bd2datahora($datahora = '') {
        if ($datahora == "0000-00-00 00:00:00" || $datahora == '') {
            return "";
        } else {
            $datahora = explode(" ", $datahora);
            $data = $datahora[0];
            $hora00 = $datahora[1];
            $dataformat = explode("-", $data);
            $data = $dataformat[2] . "/" . $dataformat[1] . "/" . $dataformat[0];

            $hora = explode(":", $hora00);
            $hora = $hora[0] . ":" . $hora[1];

            return $data . " " . $hora;
        }
    }

    // Exibir apenas a data de um DATETIME obtido de um banco de dados
    function bd2data($datahora = '') {
        if ($datahora == "0000-00-00 00:00:00" || $datahora == '') {
            return "";
        } else {
            $datahora = explode(" ", $datahora);
            $data = $datahora[0];
            $dataformat = explode("-", $data);
            $data = $dataformat[2] . "/" . $dataformat[1] . "/" . $dataformat[0];

            return $data;
        }
    }

    // Exibir apenas a hora de um DATETIME ou TIME obtido de um banco de dados
    function bd2hora($datahora = '') {
        if ($datahora == "0000-00-00 00:00:00" || $datahora == '') {
            return "";
        } else {
            $datahora = explode(" ", $datahora);

            if (isset($datahora[1])) {
                $hora00 = $datahora[1];
                $hora = explode(":", $hora00);
            } else {
                $hora = explode(":", $datahora[0]);
            }

            return $hora[0] . ":" . $hora[1];
        }
    }

    // Converter dados de data e hora em um DATETIME de banco de dados
    function datahora2bd($datahora = '') {
        if ($datahora == "") {
            return "";
        } else {
            $exp = explode(" ", $datahora);
            $data = isset($exp[0]) ? $exp[0] : '';
            $hora = isset($exp[1]) ? $exp[1] : '';

            $dexp = explode("/", $data);
            $dia = isset($dexp[0]) ? $dexp[0] : date('d');
            $mes = isset($dexp[1]) ? $dexp[1] : date('m');
            $ano = isset($dexp[2]) ? $dexp[2] : date('Y');

            $hexp = explode(":", $hora);
            $hora = isset($hexp[0]) ? $hexp[0] : date('H');
            $min = isset($hexp[1]) ? $hexp[1] : date('i');
            $seg = isset($hexp[2]) ? $hexp[2] : date('s');

            $datahora = $ano."-".$mes."-".$dia.' '.$hora.':'.$min.':'.$seg;

            return $datahora;
        }
    }

    // Converter dados de data em um DATE de banco de dados
    function data2bd($data, $completar = false) {
        if ($data == "") {
            return "";
        } else {

            $comp_ano = $comp_mes = $comp_dia = '';
            if ($completar) {
                $comp_ano = date('Y');
                $comp_mes = date('m');
                $comp_dia = date('d');
            }

            $dataformat = explode("/", $data);
            $ano = isset($dataformat[2]) ? $dataformat[2] : $comp_ano;
            $mes = isset($dataformat[1]) ? $dataformat[1] : $comp_mes;
            $dia = isset($dataformat[0]) ? $dataformat[0] : $comp_dia;

            return $ano . "-" . $mes . "-" . $dia;
        }
    }

    // Converter dados de data em um DATE de banco de dados
    function mes2bd($data) {
        if ($data == "") {
            return "";
        } else {
            
            $dataformat = explode("/", $data);
            $ano = isset($dataformat[1]) ? $dataformat[1] : '';
            $mes = isset($dataformat[0]) ? $dataformat[0] : '';

            return $ano . '-' . $mes;
        }
    }

    // Converter dados de data e hora (juntos) em um DATETIME de banco de dados
    function datetime2bd($data) {
        $hora = substr($data,10);
        $data = substr($data, 0, 10);
        $data_array = explode("/", $data);
        $nova_data = @$data_array[2] . "-" . @$data_array[1] . "-" . @$data_array[0];
        return $nova_data . $hora;
    }

    // Converter uma data em formato de data americano
    // Se não estiver completo a expressão DD/MM/AAAA, ela é completada
    // com os valores atuais
    function data2famericano($datahora) {
        $dhe = explode(' ',$datahora);
        $data = isset($dhe[0]) ? $dhe[0] : '';
        $hora = isset($dhe[1]) ? $dhe[1] : '';

        $dataformat = explode("/", $data);
        $dia = isset($dataformat[0]) ? $dataformat[0] : date('d');
        $mes = isset($dataformat[1]) ? $dataformat[1] : date('m');
        $ano = isset($dataformat[2]) ? $dataformat[2] : date('Y');
        $data = $ano . "-" . $mes . "-" . $dia . ' ' . $hora;

        //echo $data;

        return $data;
    }

    // Validar Hora retirado de: http://blog.shiguenori.com/2009/01/14/validar-data-hora-em-php/
    function validar_hora($time) {
        list($hour, $minute) = explode(':', $time);

        if ($hour > -1 && $hour < 24 && $minute > -1 && $minute < 60) {
            return true;
        }
    }

    // Validar Data retirado de: http://blog.shiguenori.com/2009/01/14/validar-data-hora-em-php/
    function validar_data($date) {
        if (!isset($date) || $date == "") {
            return false;
        }

        list($dd, $mm, $yy) = explode("/", $date);
        if ($dd != "" && $mm != "" && $yy != "") {
            if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd)) {
                return checkdate($mm, $dd, $yy);
            }
        }
        return false;
    }

    // Retirado de: http://forum.wmonline.com.br/topic/163602-formatar-data-sql-server/
    function mssql2datahora($data) {
        if ($data == "")
            return "";

        $dtTimeStamp = strtotime($data);
        $datahora = date('d/m/Y H:i', $dtTimeStamp);

        return $datahora;
    }

    // Transforma Horas em Minutos partindo do formato HH:MM
    function horas2minutos($hora) {
        $hora = explode(':', $hora);
        $minutos = ($hora[0]*60) + $hora[1];

        return $minutos;
    }

    // Transforma Minutos em Horas no formato HH:MM
    function minutos2horas($minutos) {
        $hora2 = intval($minutos/60);
        $minutos2 = $minutos - ($hora2*60);

        $hora = str_pad( str_replace('-', '', $hora2), 2, "0", STR_PAD_LEFT);
        $minutos = str_pad( str_replace('-', '', $minutos2), 2, "0", STR_PAD_LEFT);

        $hora = ($minutos2 < 0) ? '-'.$hora : $hora;

        return $hora.':'.$minutos;
    }

    // Somar ou subtrai horas em formato HH:MM
    function calcularhoras($hora1, $hora2, $operacao = '+') {
        $hora1 = horas2minutos($hora1);
        $hora2 = horas2minutos($hora2);

        if ($operacao == '-') {
            $total = minutos2horas($hora1-$hora2);
        } else {
            $total = minutos2horas($hora1+$hora2);
        }

        return $total;
    }

    // Multiplica horas em formato HH:MM
    function multiplicarhoras($hora, $multiplicador) {
        
        $total = minutos2horas( horas2minutos($hora) * $multiplicador );

        return $total;
    }

    // Imprime o nome do mes literalmente. Ex.: 2 - Fevereiro
    function mesliteral($mes = '') {
        
        $mes = (int) $mes;
        $meses = array(
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        );

        return isset($meses[$mes]) ? $meses[$mes] : '';
    }

    // Verifica se o dia informado eh um dia util - exemplo 2014-10-10
    function dia_util($data) {
        
        // N - Representação numérica ISO-8601 do dia da semana
        // 1 (para Segunda) até 7 (para Domingo)
        $dia_semana = date('N', strtotime($data));

        $res = true;
        if ($dia_semana == 6 || $dia_semana == 7) {
            $res = false;
        }

        return $res;
    }

    // Verifica se o dia informado eh um dia util, se nao for, mostra o proximo dia util. - Exemplo 2014-10-10
    function proximo_dia_util($data) {
        
        // N - Representação numérica ISO-8601 do dia da semana
        // 1 (para Segunda) até 7 (para Domingo)
        $dia = strtotime($data);
        $dia_semana = date('N', $dia);
        //echo date('d/m/Y', $dia).'-'.$dia_semana.'<br/>';

        for ($d=1; $dia_semana >= 6; $d++) {

            $dia = strtotime('+'.$d.' days', strtotime($data));
            $dia_semana = date('N', $dia);
            //echo $d.'-'.date('d/m/Y', $dia).'-'.$dia_semana.'<br/>';
        }

        return  date('Y-m-d', $dia);
    }

    // Dias entre 2 datas. Formato: 2013-12-11
    function dias_entre_datas($data1, $data2) {
        $data1 = new DateTime($data1);
        $data2 = new DateTime($data2);

        return $data1->diff($data2);
    }

    // Formata a data de uma maneira que possa ser comparada com operadores de > < - Parametro: 2015-10-02
    function datacomparavel($datahora) {
        
        if ($datahora == "") {
            return "";
        } else {
            $exp = explode(' ', $datahora);
            $data = isset($exp[0]) ? $exp[0] : '';
            $datacomparavel = str_replace("-", '', $data);

            return $datacomparavel;
        }
    }

    // Converter DATETIME do banco de dados para um array de valores de dia, mes, ano, hora, minutos e segundos
    // separados
    function bd2explode($datahora = '') {
        
        $exp = explode(" ", $datahora);
        $data = isset($exp[0]) ? $exp[0] : '';
        $hora = isset($exp[1]) ? $exp[1] : '';

        $dexp = explode("-", $data);
        $dia = isset($dexp[2]) ? $dexp[2] : '';
        $mes = isset($dexp[1]) ? $dexp[1] : '';
        $ano = isset($dexp[0]) ? $dexp[0] : '';

        $hexp = explode(":", $hora);
        $hora = isset($hexp[0]) ? $hexp[0] : '';
        $min = isset($hexp[1]) ? $hexp[1] : '';
        $seg = isset($hexp[2]) ? $hexp[2] : '';

        $explode = array(
            'dia' => ($dia != '') ? $dia : date('d'),
            'mes' => ($mes != '') ? $mes : date('m'),
            'ano' => ($ano != '') ? $ano : date('Y'),
            'hora' => ($hora != '') ? $hora : date('H'),
            'minutos' => ($min != '') ? $min : date('i'),
            'segundos' => ($seg != '') ? $seg : date('s'),
        );

        return $explode;
    }
}