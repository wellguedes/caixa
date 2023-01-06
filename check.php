<?php
require_once("config/conn.php");

$nome = trim(strtolower($_POST['nome']));
$caixa_id = ($_POST['caixa_id']);
$nome = mysql_escape_string($nome);

$mes_atual = date("m");
$ano_atual = date("Y");
$query = "SELECT lc.id,data, lc.nome, valor,codPaciente, caixa_id,tipo
            FROM `lc_paciente` lc
            left join lc_movimento lm on (lm.codPaciente = lc.id)
            WHERE lc.nome = '$nome'
            AND servico = 2
            AND caixa_id = $caixa_id
            and data between '$ano_atual-$mes_atual-01' and curdate()
            and tipo = 1
            limit 1";

$result = mysql_query($query);

$num = mysql_num_rows($result);

echo $num;
mysql_close();
