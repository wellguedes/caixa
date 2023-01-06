<?php

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

//inclui a conexao com o banco
$host = "localhost"; //endereço do servidor
$login = "root"; //login
$senha = ""; //senha
$banco = "caixa"; //nome do banco
$conexao = mysql_connect($host, $login, $senha) or die(mysql_error());
mysql_select_db($banco);

// Procurar as informações do BD
$SQL = "SELECT * FROM lc_convenio";
$executa = mysql_query($SQL);

$sql_convenio = "select sum(valor) as total  from lc_movimento where data >= '2013-01-01' and convenio = 'Particular 20'";
$convenio = mysql_query($sql_convenio) or die(mysql_error());

$sql28 = "select sum(valor) as total  from lc_movimento where data >= '2013-01-01' and convenio = 'Particular 28'";
$sql_28 = mysql_query($sql28) or die(mysql_error());

$sql32 = "select sum(valor) as total  from lc_movimento where data >= '2013-01-01' and convenio = 'Particular 32'";
$sql_32 = mysql_query($sql32) or die(mysql_error());

$sql_15 = "select sum(valor) as total  from lc_movimento where data >= '2013-01-01' and convenio = 'Particular 15'";
$sql_15 = mysql_query($sql_15) or die(mysql_error());


$sql_alana = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Alana Romagnoli%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_alessandra = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Alesandra Paines%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_aline = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Aline Campos%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_bianca = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Bianca Ghirladello%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_debora = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Debora Peixoto%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_dina = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Dina' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_elis = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Elis' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' AND tipo = 0");

$sql_leandro = mysql_query("select sum(valor) as total from lc_movimento where nome like '%leandro%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_leonardo = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Leonardo%ferreira' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_nathalia = mysql_query("select sum(valor) as total from lc_movimento where nome like '%nathalia menger%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_rafael = mysql_query("select sum(valor) as total from lc_movimento where nome like '%Rafael Jacques%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_sara = mysql_query("select sum(valor) as total from lc_movimento where nome like 'Sara%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_aluguel = mysql_query("select nome, valor total from lc_movimento where referente like '%aluguel%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_comercial = mysql_query("select nome, valor as total from lc_movimento where referente like '%comercial%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_operacional = mysql_query("select nome, valor as total from lc_movimento where referente like 'operacional%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_outros = mysql_query("select nome, valor as total from lc_movimento where referente like '%outros%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_escritorio = mysql_query("select nome, valor as total from lc_movimento where referente like '%escritorio%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_naoOperacional = mysql_query("select nome, valor as total from lc_movimento where referente like '%Nao%Operacional%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");

$sql_emprestimo = mysql_query("select nome, valor as total from lc_movimento where referente like 'emprestimo%' and data >= '2013-".MES."-01' and data <= '2013-".MES."-31' and tipo = 0");
//Saldo Atual

    $entrada = $functions->getEntradaDiaClinicaBalanco();
        while($valor = mysql_fetch_array($entrada)) {
            // echo "<pre>";print_r($valor);echo "</pre>";
            $entrou = $valor['total'];
        }

        $saida = $functions->getSaidaDiaClinicaBalanco();
        while($valor = mysql_fetch_array($saida)) {
            // echo "<pre>";print_r($valor);echo "</pre>";
            $saiu = $valor['total'];

        }
        $resultado = $entrou - $saiu;
        $resultado1 = $functions->formata_Dinheiro($resultado);

//Mês
    $entradaMes = $functions->getEntradaMesClinicaBalanco();
        while($valorMes = mysql_fetch_array($entradaMes)) {
             //echo "<pre>";print_r($valor);echo "</pre>";

            $entrouMes = $valorMes['total'];
        }

        $saidaMes = $functions->getSaidaMesClinicaBalanco();
        while($valorMes = mysql_fetch_array($saidaMes)) {
             //echo "<pre>";print_r($valor);echo "</pre>";
            $saiuMes = $valorMes['total'];
        }
        $resultadoMes = $entrouMes - $saiuMes;
        $formata_dinheiro = $functions->formata_Dinheiro($valorMes);

//Saldo Anterior

        $entradaAnterior = $functions->getEntradaDiaClinicaBalancoAnterior();
            while($valorAnterior = mysql_fetch_array($entradaAnterior)) {
                 //echo "<pre>";print_r($valor);echo "</pre>";

                $entrouAnterior = $valorAnterior['total'];
            }

            $saidaAnterior = $functions->getSaidaDiaClinicaBalancoAnterior();
            while($valorAnterior = mysql_fetch_array($saidaAnterior)) {
                 //echo "<pre>";print_r($valor);echo "</pre>";
                $saiuAnterior = $valorAnterior['total'];
            }

            $resultadoAnterior = $entrouAnterior - $saiuAnterior;
            $formata_dinheiro = $functions->formata_Dinheiro($valorAnterior);

//Saldo Academia

        $entradaAcademia = $functions->getSaldoAcademiaEntrada();
            while($AcademiaAnterior = mysql_fetch_array($entradaAcademia)) {
                 //echo "<pre>";print_r($valor);echo "</pre>";

                $AAnterior = $AcademiaAnterior['total'];
                //echo $AAnterior;
            }

        $saidaAcademia = $functions->getSaldoAcademiaSaida();
            while($AcademiaAnterior = mysql_fetch_array($saidaAcademia)) {
                 //echo "<pre>";print_r($valor);echo "</pre>";

                $saidaAcademiaAnterior = $AcademiaAnterior['total'];
                //echo $saidaAcademiaAnterior;
            }
                $result = $AAnterior - $saidaAcademiaAnterior;

//Particular
        $convenioParticular = $functions->getEntradaParticular();
            while($l = mysql_fetch_array($convenioParticular)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalConvenios = $l['total'];
                $totalConvenios = $functions->formata_Dinheiro($totalConvenios);
            }

        $saidaComercial = $functions->getSaidaComercial();
            while($l = mysql_fetch_array($saidaComercial)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalComercial = $l['total'];
                $totalComercial = $functions->formata_Dinheiro($totalComercial);
            }

        $saidaAluguel = $functions->getSaidaAluguel();
            while($l = mysql_fetch_array($saidaAluguel)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalAluguel = $l['total'];
                $totalAluguel = $functions->formata_Dinheiro($totalAluguel);
            }

        $saidaOperacional = $functions->getSaidaOperacional();
            while($l = mysql_fetch_array($saidaOperacional)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalOperacional = $l['total'];
                $totalOperacional = $functions->formata_Dinheiro($totalOperacional);
            }

        $saidaOutros = $functions->getSaidaOutros();
            while($l = mysql_fetch_array($saidaOutros)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalOutros = $l['total'];
                $totalOutros = $functions->formata_Dinheiro($totalOutros);
            }

        $saidaEmprestimo = $functions->getSaidaEmprestimo();
            while($l = mysql_fetch_array($saidaEmprestimo)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalEmprestimo = $l['total'];
                $totalEmprestimo = $functions->formata_Dinheiro($totalEmprestimo);
            }

        $saidaEscritorio = $functions->getSaidaEscritorio();
            while($l = mysql_fetch_array($saidaEscritorio)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalEscritorio = $l['total'];
                $totalEscritorio = $functions->formata_Dinheiro($totalEscritorio);
            }

        $saidaNOperacional = $functions->getSaidaNOperacional();
            while($l = mysql_fetch_array($saidaNOperacional)) {
                 //echo "<pre>";print_r($l);echo "</pre>";
                $totalNOpercional = $l['total'];
                $totalNOpercional = $functions->formata_Dinheiro($totalNOpercional);
            }

// Escolher o formato do arquivo
header("Content-type: application/msexcel");
// Nome que arquivo será salvo
header("Content-Disposition: attachment; filename=balanco.xls");

$stiloFundo = "style = height='100%';font-weight:bold;background:#FFFF00;'";
$stiloFundoRed = "style = 'font-weight:bold;background:#FFFF00;color:#FF0000;'";
$stilo = "style = 'font-weight:bold;'";
// Criar a tabela para receber os dados
echo "<table border='1'>";
echo"<tr style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:15px;'><td  colspan='6' align='center'>BALANÇO MÊS JANEIRO 2013</td></tr>";
echo "</table>";

echo "<table>";
echo "<tr>";
echo "<td>";
echo "<table border='1'>";
echo "<tr>";
echo "<td colspan='2'$stiloFundo align='center'>1.RECEITAS</td>";
echo "</tr>";

echo "<tr>";
echo "<td $stilo>1.1 Convênios</td>";
echo "<td $stilo>=SOMA(B4:B21)</td>";
echo "</tr>";

while ($r = mysql_fetch_array($executa)) {
    echo "<tr>";
    $descricao = $r["descricao"];
    $val = $functions->formata_Dinheiro(0);
    echo "<td>" . utf8_decode($descricao) . "</td>";
    echo "<td>$val</td>";
}

echo "</tr>";

echo "<tr>";
echo "<td $stilo></td>";
echo "<td $stilo></td>";
echo "</tr>";

echo "<tr>";
echo "<td $stilo>1.2 Particular</td>";
echo "<td $stilo>$totalConvenios</td>";
echo "</tr>";

echo "<tr>";
echo "<td>DESC 15</td>";
while ($particular1 = mysql_fetch_array($sql_15)) {
    $p15 = $particular1["total"];
    $p15 = $functions->formata_Dinheiro($p15);
    echo "<td>$p15</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>DESC 20</td>";
while ($particular = mysql_fetch_array($convenio)) {
    $p20 = $particular["total"];
    $p20 = $functions->formata_Dinheiro($p20);
    echo "<td>$p20</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>DESC 28</td>";
while ($particular = mysql_fetch_array($sql_28)) {
    $p28 = $particular["total"];
    $p28 = $functions->formata_Dinheiro($p28);
    echo "<td>$p28</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>DESC 32</td>";
while ($particular = mysql_fetch_array($sql_32)) {
    $p32 = $particular["total"];
    $p32 = $functions->formata_Dinheiro($p32);
    echo "<td>$p32</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td $stilo>1.3 Outros</td>";
echo "<td $stilo>=SOMA(B30:B40)</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Domicílio</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Academia</td>";
echo "<td>$formata</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Pilates</td>";
echo "<td>$total_pilates1</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Acupuntura</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Neuro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Estética</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Bianca</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Nutri</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Silvana</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Leonardo</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Loja</td>";
echo"<td></td>";

echo "</tr>";

echo "</table>";
echo "</td>";
echo "<td>";

echo "<table border='1'>";
echo "<tr>";
echo "<td colspan='2' $stiloFundoRed align='center'>2.CUSTOS</td>";
echo "</tr>";
echo "<tr>";
echo "<td $stilo>2.1 Pessoal</td>";
echo "<td $stilo>=SOMA(D4:D15)</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Alana Romagnoli</td>";
while ($romagnoli = mysql_fetch_array($sql_alana)) {
    $alana = $romagnoli["total"];
    $alana = $functions->formata_Dinheiro($alana);
    echo "<td>$alana</td>";
}
echo "</tr>";


echo "</tr>";
echo "<tr>";
echo "<td>Alesandra Paines</td>";
while ($paines = mysql_fetch_array($sql_alessandra)) {
    $alessandra = $paines["total"];
    $alessandra = $functions->formata_Dinheiro($alessandra);
    echo "<td>$alessandra</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Aline Campos</td>";
while ($campos = mysql_fetch_array($sql_aline)) {
    $aline = $campos["total"];
    $aline = $functions->formata_Dinheiro($aline);
    echo "<td>$aline</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Bianca Ghirladello</td>";
while ($g = mysql_fetch_array($sql_bianca)) {
    $bianca = $g["total"];
    $bianca = $functions->formata_Dinheiro($bianca);
    echo "<td>$bianca</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Débora Peixoto</td>";
while ($peixoto = mysql_fetch_array($sql_debora)) {
    $debora = $peixoto["total"];
    $debora = $functions->formata_Dinheiro($debora);
    echo "<td>$debora</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Dina</td>";
while ($d = mysql_fetch_array($sql_dina)) {
    $dina = $d["total"];
    $dina = $functions->formata_Dinheiro($dina);
    echo "<td>$dina</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Elis</td>";
while ($e = mysql_fetch_array($sql_elis)) {
    $elis = $e["total"];
    $elis = $functions->formata_Dinheiro($elis);
    echo "<td>$elis</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Leandro</td>";

while ($ross = mysql_fetch_array($sql_leandro)) {
    $leandro = $ross["total"];
    $leandro = $functions->formata_Dinheiro($leandro);
    echo "<td>$leandro</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Leonardo</td>";
while ($ferreira = mysql_fetch_array($sql_leonardo)) {
    $leonardo = $ferreira["total"];
    $leonardo = $functions->formata_Dinheiro($leonardo);
    echo "<td>$leonardo</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Nathalia</td>";
while ($menger = mysql_fetch_array($sql_nathalia)) {
    $natahlia = $menger["total"];
    $natahlia = $functions->formata_Dinheiro($natahlia);
    echo "<td>$natahlia</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Rafael</td>";
while ($jacques = mysql_fetch_array($sql_rafael)) {
    $rafael = $jacques["total"];
    $rafael = $functions->formata_Dinheiro($rafael);
    echo "<td>$rafael</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Sara</td>";
while ($alves = mysql_fetch_array($sql_sara)) {
    $sara = $alves["total"];
    $sara = $functions->formata_Dinheiro($sara);
    echo "<td>$sara</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";


echo "<tr>";
echo "<td $stilo>2.2 Impostos</td>";
echo "<td $stilo>=SOMA(D18:D30)</td>";
echo "</tr>";

echo "<tr>";
echo "<td>INSS</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>INSS Leandro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>FGTS Leandro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>PIS</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>COFINS</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>CSLL</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>ISSQN/Leandro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IRPJ</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Mensalidade Leandro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Tarifa banco-seguro</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Contador</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Simples</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Alvará</td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";

echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td $stilo>2.3 Aluguel</td>";
echo "<td $stilo>$totalAluguel</td>";
echo "</tr>";

while ($aluguel = mysql_fetch_array($sql_aluguel)) {
    echo "<tr border='1'>";
    $nome = $aluguel["nome"];
    $valor_comercial = $aluguel["total"];
    $valor_comercial = $functions->formata_Dinheiro($valor_comercial);
    echo "<td>" . utf8_decode($nome) . "</td>";
    echo "<td>$valor_comercial</td>";
    echo "</tr>";
}

echo "<tr border='1'>";
echo "<td $stilo></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td $stilo>2.4 Despesa Comercial</td>";
echo "<td $stilo>$totalComercial</td>";
echo "</tr>";

while ($comercial = mysql_fetch_array($sql_comercial)) {
    echo "<tr border='1'>";
    $nome_comercial = $comercial["nome"];
    $valorComercial = $comercial["total"];
    $valorComercial = $functions->formata_Dinheiro($valorComercial);
    echo "<td border='1'>" . utf8_decode($nome_comercial) . "</td>";
    echo "<td border='1'>$valorComercial</td>";
    echo "</tr>";
}

echo "</table>";
//table 3
echo "<td>";
echo "<table border = '1'>";
echo "<tr>";
echo "<td $stiloFundo></td>";
echo "<td $stiloFundo></td>";
echo "</tr>";

echo "<tr>";
echo "<td $stilo>2.5 Despesa Financeira</td>";
echo "<td $stilo>$totalEmprestimo</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Empréstimo</td>";
echo "<td>$totalEmprestimo</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Previdência</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr border='1'>";
echo "<td $stilo>2.6 Despesa Operacional</td>";
echo "<td $stilo>$totalOperacional</td>";
echo "</tr>";

while ($operacional = mysql_fetch_array($sql_operacional)) {
    echo "<tr border='1'>";
    $nome_operacional = $operacional["nome"];
    $valor_operacional = $operacional["total"];
    $valor_operacional = $functions->formata_Dinheiro($valor_operacional);
    echo "<td border='1'>" . utf8_decode($nome_operacional) . "</td>";
    echo "<td border='1'>$valor_operacional</td>";
    echo "</tr>";
}

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr border='1'>";
echo "<td $stilo>2.7 Outros</td>";
echo "<td $stilo>$totalOutros</td>";
echo "</tr>";

while ($outros = mysql_fetch_array($sql_outros)) {
    echo "<tr border='1'>";
    $nome_outros = $outros["nome"];
    $valor_outros = $outros["total"];
    $valor_outros = $functions->formata_Dinheiro($valor_outros);
    echo "<td border='1'>" . utf8_decode($nome_outros) . "</td>";
    echo "<td border='1'>$valor_outros</td>";
    echo "</tr>";
}

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr border='1'>";
echo "<td $stilo>2.8 Escritório</td>";
echo "<td $stilo>$totalEscritorio</td>";
echo "</tr>";

while ($escritorio = mysql_fetch_array($sql_escritorio)) {
    echo "<tr border='1'>";
    $nome_escritorio = $escritorio["nome"];
    $valor_escritorio = $escritorio["total"];
    $valor_escritorio = $functions->formata_Dinheiro($valor_escritorio);
    echo "<td border='1'>" . utf8_decode($nome_escritorio) . "</td>";
    echo "<td border='1'>$valor_escritorio</td>";
    echo "</tr>";
}

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr border='1'>";
echo "<td $stilo>2.8 Despesa Não Operacional</td>";
echo "<td $stilo>$totalNOpercional</td>";
echo "</tr>";

while ($n = mysql_fetch_array($sql_naoOperacional)) {
    echo "<tr border='1'>";
    $nome_nOperacional = $n["nome"];
    $valor_nOperacional = $n["total"];
    $valor_nOperacional = $functions->formata_Dinheiro($valor_nOperacional);
    echo "<td border='1'>" . utf8_decode($nome_nOperacional) . "</td>";
    echo "<td border='1'>$valor_nOperacional</td>";
    echo "</tr>";
}


echo "</table>";
echo "</td>";
// fim table 3

echo "</td>";
echo "</tr>";
echo "</table>";
echo "<table border ='2'>";
echo "<tr>";
echo "<td $stiloFundo align='center'>Depósito</td>";
echo "<td align='center' $stiloFundo></td>";
echo "<td align='center' $stiloFundo>Saldo Atual</td>";

$receitaAtual = $resultado;
$receitaAtual = $functions->formata_Dinheiro($receitaAtual);
echo "<td align='center' $stiloFundo>$receitaAtual</td>";

    $resultadoMes = $functions->formata_Dinheiro($resultadoMes);

echo "<td align='center' $stiloFundo>RECEITAS - CUSTOS</td>";
echo "<td align='center' $stiloFundo>$resultadoMes</td>";
echo "</tr>";
echo "<tr>";
echo "<td $stiloFundo align='center'>Fix</td>";
echo "<td align='center' $stiloFundo></td>";
echo "<td align='center' $stiloFundo>Saldo Anterior</td>";

$resultadoAnterior = $functions->formata_Dinheiro($resultadoAnterior);

echo "<td align='center' $stiloFundo>$resultadoAnterior</td>";
echo "<td align='center' $stiloFundo></td>";
echo "<td align='center' $stiloFundo></td>";
echo "</tr>";
echo "</table>"
?>
