<style type="text/css">

#total
{
    font-size: 15px;
    font-weight: bold;
    font-family: tahoma;
    float: right; width: 23%;
}
</style>

<?php

include '../functions.php';

$functions = new functions();

$date = $_POST['date'];
$data1 = $_POST['data1'];
$caixa_id = $_POST['caixa_id'];
$ordem = $_POST['ordem'];

$date = $functions->datasql($date);
$data1 = $functions->datasql($data1);

function str_maiuscula($texto) {
    $texto = strtr(strtoupper($texto),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿç","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßÇ");
    return $texto;
}

$sql = "SELECT id, nome,caixa_nome, valor, DATE_FORMAT(data, '%d/%m/%Y') as data, pag_nome, tipo, referente,caixa_id
                            FROM lc_movimento
                            Join lc_caixa using(caixa_id)
                            left join lc_pagamento_tipo using(pag_id)
                            WHERE  data BETWEEN '$date' AND '$data1'
                            AND caixa_id =" . $caixa_id;
                            if($ordem == "N"){
                                $sql .= " ORDER BY data";
                            } else {
                                $sql .= " ORDER BY nome";
                            }
$executa = mysql_query($sql);

$total_rows = mysql_num_rows($executa);

$consulta = mysql_query("SELECT SUM(valor) as total
                        FROM lc_movimento
                        WHERE caixa_id = $caixa_id
                        AND data BETWEEN '$date'
                        AND '$data1'
                        AND tipo = 1;");

$consulta2 = mysql_query("SELECT SUM(valor) as totalSaida
                        FROM lc_movimento
                        WHERE caixa_id = $caixa_id
                        AND data BETWEEN '$date'
                        AND '$data1'
                        AND tipo = 0;");

    if ($total_rows == 0) {

        echo "Nenhum resultado encontrado";
    } else {
            while ($row = mysql_fetch_array($consulta2)) {
                $saida = $row['totalSaida'];
            }

        while ($row = mysql_fetch_array($consulta)) {
            $entrada = $row['total'];
            $total = $entrada - $saida;
            $total = $functions->formata_Dinheiro($total);
        }
   echo "
        <table border='1' cellspacing='0' cellpadding='0' width='100%'>
        <tr>
            <th width='22%' scope='col'>Nome do Cliente</th>
            <th width='11%' scope='col'>Tipo</th>
            <th width='10%' scope='col'>Data</th>
            <th width='12%' scope='col'>Pagamento</th>
            <th width='20%' scope='col'>Referente</th>
            <th width='15%' scope='col'>Valor</th>
            <th width='10%' scope='col'>Editar</th>
            </tr>
            ";
        while ($result = mysql_fetch_array($executa)) {
            $row = $result['valor'];
            $formata_dinheiro = $functions->formata_Dinheiro($row);
            $tipo = $result['tipo'] == 1 ? "Receita" : "Despesa";

           echo "<tr><td>". str_maiuscula($result['nome']) . "<br /></td>";
           echo "<td>" .strtoupper($tipo) . "<br /></td>";
           echo "<td align ='center'>" . $result['data'] . "<br /></td>";
           echo "<td align ='center'>" . strtoupper($result['pag_nome']) . "<br /></td>";
           echo "<td>" . strtoupper($result['referente']) . "<br /></td>";
           echo "<td>" . $formata_dinheiro . "<br /></td>";
           echo "<td><img src='imagens/editar.png' border='0' align='middle' style='cursor:pointer;' onclick='detalhePaciente(" . $result['id'] . ")'></img><br /></td></tr>";
           echo "<input type='hidden' name='data' value='".$result['data']."'/>";
           $caixa = $result['caixa_id'];
           }
           ;
        "
    </table>";
     echo"<table width='50%' border='0'>";
  echo"<tr>";
    echo"<td width='17%'><div id='total'>$total</div></td>";
  echo"</tr>";
echo"</table>";

    echo "<div id='total'></div>";
}
