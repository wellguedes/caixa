<?php

require_once("../config/conn.php");

$valor = $_POST["valor"];
$data = $_POST["data"];
$conta = $_POST["conta_id"];

$data = date("Y/m/d");

$update = mysql_query("SELECT * FROM lc_contabil WHERE conta_id = $conta");

if(mysql_num_rows($update) > 0) {

$query = mysql_query("update lc_contabil set valor = valor + $valor where conta_id = $conta");
    if ($query) {
        $query = mysql_query("UPDATE lc_fechamento SET valor = 0");
        echo false;
    }else {
        echo $query;

        echo "Não foi possível transferir valores no momento.";
    }

}  else {

$query = mysql_query("INSERT INTO lc_contabil(valor,data,conta_id)values ('$valor','$data','$conta')");
    if ($query) {
        $query = mysql_query("UPDATE lc_fechamento SET valor = 0");
        echo false;
    }else {
        echo $query;

        echo "Não foi possível transferir valores no momento.";
    }
}
?>