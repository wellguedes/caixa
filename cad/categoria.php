<?php

require_once("../config/conn.php");

$nome = $_POST["nome"];

$query = mysql_query("INSERT INTO lc_cat(nome)values ('$nome')");
    if ($query) {
        echo false;
    }else {
        echo "Não foi possível inserir a mensagem no momento.";
    }

?>