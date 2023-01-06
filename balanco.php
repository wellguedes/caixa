<?php

ob_start();
//Fazemos a conexão com o mysql, coloque os dados de acesso do seu servidor 


include 'functions.php';

$functions = new functions();

switch (date("m")) {
    case "01": $mes = Janeiro;
        break;
    case "02": $mes = Fevereiro;
        break;
    case "03": $mes = Março;
        break;
    case "04": $mes = Abril;
        break;
    case "05": $mes = Maio;
        break;
    case "06": $mes = Junho;
        break;
    case "07": $mes = Julho;
        break;
    case "08": $mes = Agosto;
        break;
    case "09": $mes = Setembro;
        break;
    case "10": $mes = Outubro;
        break;
    case "11": $mes = Novembro;
        break;
    case "12": $mes = Dezembro;
        break;
}
$ano = date('Y');

$data = $mes . " " . $ano;
$data = strtoupper($data);


$sql = "select id, nome, id_tipo
        from lc_cat
        where id_tipo = 1;";

$query = mysql_query($sql) or die(mysql_error());

$sql = "select *
        from lc_convenio";

$sql_convenio = mysql_query($sql) or die(mysql_error());

$sql = "select sum(valor) as total
        from lc_movimento
        where data >= '2012-11-01'
        and convenio = 'Particular 20'";
$sql_20 = mysql_query($sql) or die(mysql_error());

$sql = "select sum(valor) as total
        from lc_movimento
        where data >= '2012-11-01'
        and convenio = 'Particular 28'";
$sql_28 = mysql_query($sql) or die(mysql_error());

$sql = "select sum(valor) as total
        from lc_movimento
        where data >= '2012-11-01'
        and convenio = 'Particular 32'";
$sql_32 = mysql_query($sql) or die(mysql_error());

$sql = "select sum(valor) as total
        from lc_movimento
        where data >= '2012-11-01'
        and caixa_id = 2
        and tipo = 1";
$sql_loja = mysql_query($sql) or die(mysql_error());

$sql = "select sum(valor) as total
        from lc_movimento
        where data >= '2012-11-01'
        and caixa_id = 2
        and tipo = 0";
$sql_loja2 = mysql_query($sql) or die(mysql_error());

$consulta = mysql_query("SELECT SUM(valor) as total
                        FROM lc_movimento
                        WHERE caixa_id = 4
                        AND data BETWEEN '2012-11-01'
                        AND '2012-11-31'
                        AND tipo = 1;");

$consulta2 = mysql_query("SELECT SUM(valor) as totalSaida
                        FROM lc_movimento
                        WHERE caixa_id = 4
                        AND data BETWEEN '2012-11-01'
                        AND '2012-11-31'
                        AND tipo = 0;");

$pilates = mysql_query("SELECT SUM(valor) as total
                        FROM lc_movimento
                        WHERE caixa_id = 5
                        AND data BETWEEN '2012-11-01'
                        AND '2012-11-31'
                        AND tipo = 1;");

$pilates2 = mysql_query("SELECT SUM(valor) as totalSaida
                        FROM lc_movimento
                        WHERE caixa_id = 5
                        AND data BETWEEN '2012-11-01'
                        AND '2012-11-31'
                        AND tipo = 0;");

$sql_alana = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Alana Romagnoli%'
                            and data >= '2012-11-01'
                            ");

$sql_alessandra = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Alesandra Paines%'
                            and data >= '2012-11-01'
                            ");

$sql_aline = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Aline Campos%'
                            and data >= '2012-11-01'
                            ");

$sql_bianca= mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Bianca Ghirladello%'
                            and data >= '2012-11-01'
                            ");

$sql_debora = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Debora Peixoto%'
                            and data >= '2012-11-01'");

$sql_dina = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Dina'
                            and data >= '2012-11-01'");

$sql_elis = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Elis'
                            and data >= '2012-11-01'");

$sql_leandro = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%leandro%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_leonardo = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Leonardo%ferreira'
                            and data >= '2012-11-01' and tipo = 0");

$sql_nathalia = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%nathalia menger%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_rafel = mysql_query("select sum(valor) as total
                            from lc_movimento
                            where nome like '%Rafael Jacques%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_aluguel = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%aluguel%'
                            and data >= '2012-11-01' and tipo = 0");
$sql_comercial = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%comercial%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_operacional = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%operacional%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_outros = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%outros%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_ecritorio = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%escritorio%'
                            and data >= '2012-11-01' and tipo = 0");

$sql_naoOperacional = mysql_query("select nome, valor as total
                            from lc_movimento
                            where referente like '%Não Operacional%'
                            and data >= '2012-11-01' and tipo = 0");

$entrada = $functions->getEntradaDiaClinica();
                while($valor = mysql_fetch_array($entrada)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";

                    $entrou = $valor['total'];
                }

                $saida = $functions->getSaidaDiaClinica();
                while($valor = mysql_fetch_array($saida)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";
                    $saiu = $valor['total'];
                }

                $resultado = $entrou - $saiu;
                $formata_dinheiro = $functions->formata_Dinheiro($valor);

            $entradaAnterior = $functions->getEntradaDiaClinicaMesAnterior();
                while($valorAnterior = mysql_fetch_array($entradaAnterior)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";

                    $entrouAnterior = $valorAnterior['total'];
                }

                $saidaAnterior = $functions->getSaidaDiaClinicaMesAnterior();
                while($valorAnterior = mysql_fetch_array($saidaAnterior)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";
                    $saiuAnterior = $valorAnterior['total'];
                }

                $resultadoAnterior = $entrouAnterior - $saiuAnterior;
                $formata_dinheiro = $functions->formata_Dinheiro($valorAnterior);
//Mês
            $entradaMes = $functions->getEntradaMesClinicaBalanco();
                while($valorMes = mysql_fetch_array($entradaMes)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";

                    $entrouMes = $valorMes['total'];
                }

                $saidaMes = $functions->getSaidaMesClinica();
                while($valorMes = mysql_fetch_array($saidaMes)) {
                     //echo "<pre>";print_r($valor);echo "</pre>";
                    $saiuMes = $valorMes['total'];
                }
                $resultadoMes = $entrouMes - $saiuMes;
                $formata_dinheiro = $functions->formata_Dinheiro($valorMes);

if (mysql_num_rows($query) == 0) {
    echo "<h2>Nenhum produto cadastrado</h2>";
} else {

    $html = "";
    $html .= "<Table align='center' border='01'>";
    $html .= "<tr style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:15px;'><td  colspan='6' align='center'>BALANÇO MÊS $data</td></tr>
$html </Table>";
    $html .= "<table border='01'>";
    $html .= "<tr style='font-weight:bold;font-family:Arial;font-size:16px;'>";
    $html.= "<td  style='background:#FFFF00;font-size:16px;'>1. Receitas</td>";
    $html.= "<td width='100' style='background:#FFFF00;color:#FF0000;font-size:16px;'></td>";
    $html.= "<td  style='background:#FFFF00;color:#FF0000;font-size:16px;'>2. Custos</td>";
    $html.= "<td  style='background:#FFFF00;color:#FF0000;font-size:16px;'></td>";
    $html.= "<td width='100' style='background:#FFFF00;color:#FF0000;font-size:16px;'></td>";
    $html.= "<td width='100' style='background:#FFFF00;color:#FF0000;font-size:16px;'></td>";
    $html .= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>1.1 Convenios</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>2.1 Pessoal</td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>2.5 Despesa Financeira</td>";
    $html.= "<td width='100' style='color:#FF0000;font-size:16px;'></td>";
    $html.= "</tr>";


    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Afisvec</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Alana</td>";

    while ($romagnoli = mysql_fetch_array($sql_alana)) {
        $alana = $romagnoli["total"];
        $alana = $functions->formata_Dinheiro($alana);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$alana</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'>Empréstimo</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

    $html.= "</tr>";
    
    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Assefaz</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Alessandra</td>";

    while ($paines = mysql_fetch_array($sql_alessandra)) {
        $alessandra = $paines["total"];
        $alessandra = $functions->formata_Dinheiro($alessandra);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$alessandra</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'>Prêvidencia</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Bacen</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Aline</td>";

    while ($campos = mysql_fetch_array($sql_aline)) {
        $aline = $campos["total"];
        $aline = $functions->formata_Dinheiro($aline);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$aline</td>";
    }
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>2.6 Operacional</td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'></td>";

    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Bradesco</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Bianca</td>";

    while ($g = mysql_fetch_array($sql_bianca)) {
        $bianca = $g["total"];
        $bianca = $functions->formata_Dinheiro($bianca);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$bianca</td>";
    }
    $html.= "</tr>";

    while ($operacional = mysql_fetch_array($sql_operacional)) {
    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

    $html.= "<td width='200px'></td>";
        $nome_operacional = $operacional["nome"];
        $valor_operacional = $operacional["total"];
        $valor_operacional = $functions->formata_Dinheiro($valor_operacional);
        $html.= "<td  style='font-family:Arial;font-size:16px;'>$nome_operacional</td>";
        $html.= "<td style='font-family:Arial;font-size:16px;'>$valor_operacional</td>";
    
    $html.= "</tr>";
}
    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Cabergs</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Débora</td>";

    while ($peixoto = mysql_fetch_array($sql_debora)) {
        $debora = $peixoto["total"];
        $debora = $functions->formata_Dinheiro($debora);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$debora</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Capesaude</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";


    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Cassi</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Dina</td>";

    while ($d = mysql_fetch_array($sql_dina)) {
        $dina = $d["total"];
        $dina = $functions->formata_Dinheiro($dina);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$dina</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";


    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Coopersinos</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Elis</td>";

    while ($e = mysql_fetch_array($sql_elis)) {
        $elis = $e["total"];
        $elis = $functions->formata_Dinheiro($elis);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$elis</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";


    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Ebct</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Leandro</td>";

    while ($ross = mysql_fetch_array($sql_leandro)) {
        $leandro = $ross["total"];
        $leandro = $functions->formata_Dinheiro($leandro);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$leandro</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Funcef</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Leonardo</td>";

    while ($ferreira = mysql_fetch_array($sql_leonardo)) {
        $leonardo = $ferreira["total"];
        $leonardo = $functions->formata_Dinheiro($leonardo);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$leonardo</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Fusex</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Nathalia</td>";

    while ($menger = mysql_fetch_array($sql_nathalia)) {
        $natahlia = $menger["total"];
        $natahlia = $functions->formata_Dinheiro($natahlia);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$natahlia</td>";
    }
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>IBCM</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Rafel</td>";

    while ($jacques = mysql_fetch_array($sql_rafel)) {
        $rafael = $jacques["total"];
        $rafael = $functions->formata_Dinheiro($rafael);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$rafael</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'>2.2 Impostos</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>S América</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>INSS</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>S Paz</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>INSS Leandro</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Sas</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>FGTS Leandro</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>2.7 Outros</td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Social Saude</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>PIS</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    while ($outro = mysql_fetch_array($sql_outros)) {
$html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

        $nome_outro = $outro["nome"];
        $valor_outro = $outro["total"];
        $valor_outro = $functions->formata_Dinheiro($valor_outro);
        $html.= "<td  style='font-family:Arial;font-size:16px;'>$nome_outro</td>";
        $html.= "<td style='font-family:Arial;font-size:16px;'>$valor_outro</td>";
        $html.= "</tr>";

}

    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Ugapoci</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>COFINS</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Unimed</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>CSLL</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>1.2 Particular</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>ISSQN/Leandro</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>DESC 20</td>";
        while ($particular = mysql_fetch_array($sql_20)) {
        $p20 = $particular["total"];
        $p20 = $functions->formata_Dinheiro($p20);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$p20</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'>IRPJ</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>DESC 28</td>";
        while ($particular = mysql_fetch_array($sql_28)) {
        $p28 = $particular["total"];
        $p28 = $functions->formata_Dinheiro($p28);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$p28</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>DESC 32</td>";
    while ($particular = mysql_fetch_array($sql_32)) {
        $p32 = $particular["total"];
        $p32 = $functions->formata_Dinheiro($p32);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$p32</td>";
    }
    $html.= "<td style='font-family:Arial;font-size:16px;'>Mensalidade Leandro</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>2.8 Escritório</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-weight:bold;font-family:Arial;font-size:16px;'>1.3 Outros</td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Mensalidade Physiosul</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    while ($escritorio = mysql_fetch_array($sql_ecritorio)) {
    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";

        $nome_escritorio = $escritorio["nome"];
        $valor_escritorio = $escritorio["total"];
        $valor_escritorio = $functions->formata_Dinheiro($valor_escritorio);
        $html.= "<td  style='font-family:Arial;font-size:16px;'>$nome_escritorio</td>";
        $html.= "<td style='font-family:Arial;font-size:16px;'>$valor_escritorio</td>";
        $html.= "</tr>";

}

    $html.= "</tr>";

    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Domicílio</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Simples</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Academia</td>";

    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Alvara</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Loja</td>";
        while ($loja2 = mysql_fetch_array($sql_loja2)) {
        $valor_loja2 = $loja2["total"];
    }
        while ($loja = mysql_fetch_array($sql_loja)) {
        $valor_loja = $loja["total"];
        $v = $valor_loja - $valor_loja2;
        $v = $functions->formata_Dinheiro($v);
        $html.= "<td style='font-family:Arial;font-size:16px;'>$v</td>";
    }
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Pilates</td>";
    
        while ($row = mysql_fetch_array($pilates2)) {
            $saida = $row['totalSaida'];
        }

        while ($row = mysql_fetch_array($pilates)) {
            $entrada = $row['total'];
            $total_pilates = $entrada - $saida;
            $total_pilates = $functions->formata_Dinheiro($total_pilates);

        }

    $html.= "<td style='font-family:Arial;font-size:16px;'>$total_pilates</td>";
    
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'>2.3 Aluguel</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Acupuntura</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    while ($aluguel = mysql_fetch_array($sql_aluguel)) {

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td width='200px'></td>";
        $nome = $aluguel["nome"];
        $valor_comercial = $aluguel["total"];
        $valor_comercial = $functions->formata_Dinheiro($valor_comercial);
        $html.= "<td  style='font-family:Arial;font-size:16px;'>$nome</td>";
        $html.= "<td style='font-family:Arial;font-size:16px;'>$valor_comercial</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";
}
    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Neuro</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'>2.4 Despesa Comercial</td>";
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'>2.8 Despesa Não Operacional</td>";
    
    $html.= "<td style='font-family:Arial;font-size:16px;font-weight:bold;'></td>";

    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Estética</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    while ($comercial = mysql_fetch_array($sql_comercial)) {

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td width='200px'></td>";
        $nome_comercial = $comercial["nome"];
        $valorComercial = $comercial["total"];
        $valorComercial = $functions->formata_Dinheiro($valorComercial);
        $html.= "<td  style='font-family:Arial;font-size:16px;'>$nome_comercial</td>";
        $html.= "<td style='font-family:Arial;font-size:16px;'>$valorComercial</td>";
    $html.= "</tr>";
}
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Bianca</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Nutricionista</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Silvana</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='font-family:Arial;font-size:16px;'>Leonardo</td>";
    $html.= "<td width='200px'></td>";
    $html.= "<td></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='font-family:Arial;font-size:16px;'></td>";
    $html.= "<td></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>Depósito</td>";
    $html.= "<td style='background:#FFFF00;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>Saldo Atual</td>";
    $resultado = $functions->formata_Dinheiro($resultado);
    $html.= "<td style='background:#FFFF00;font-family:Arial;font-size:16px;'>$resultado</td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>RECEITAS - CUSTOS</td>";
    $receita = $resultadoMes + $total_pilates + $valor_loja;
    $receitaFinal = $functions->formata_Dinheiro($receita);

    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>$receitaFinal</td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>Fix</td>";
    $html.= "<td style='background:#FFFF00;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'>Saldo Anterior</td>";
    $resultadoAnterior = $functions->formata_Dinheiro($resultadoAnterior);
    $html.= "<td style='background:#FFFF00;font-family:Arial;font-size:16px;'>$resultadoAnterior</td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;align:center;'>Custodias Academia</td>";
    $html.= "<td style='background:#FFFF00;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "<td style='background:#FFFF00;font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "</tr>";

    $html.= "<tr>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;'>Lucro Academia</td>";
    $html.= "<td style='background:#FFFF00;'></td>";
    $html.= "<td style='background:#FFFF00;'></td>";
    $html.= "<td style='background:#FFFF00;font-family:Arial;font-size:16px;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "<td style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:16px;text-align:center;'></td>";
    $html.= "</tr>";

    echo "</table>";

    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-type: application/msexcel");
}
header("Content-Disposition: attachment; filename=balanco.xls");
echo $html;

mysql_close();
?>
