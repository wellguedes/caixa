<?php

require_once("../config/conn.php");

$valor = $_POST["valor"];
$usua_id_inc = $_POST["usua_id_inc"];
$caixa_id = $_POST["caixa_id"];
$conta_id = $_POST["conta_id"];

$query = mysql_query("INSERT INTO lc_fechamento(data,data_hora_inc,valor,usua_id_inc,caixa_id,conta_id)values (CURDATE(),now(),'$valor','$usua_id_inc','$caixa_id','$conta_id')");
echo $sql;
    if ($query) {
        echo false;
    }else {
        echo "Não foi possível fechar o caixa no momento.";
    }
?>