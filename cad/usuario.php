<?php

require_once("../config/conn.php");

$usua_nome = $_POST["usua_nome"];
$usua_login = $_POST["usua_login"];
$usua_senha = $_POST["usua_senha"];
$usua_permissao = $_POST["usua_permissao"];


$query = mysql_query("INSERT INTO lc_usuario(usua_nome, usua_login, usua_senha, usua_permissao)values ('$usua_nome','$usua_login',md5('$usua_senha'),'$usua_permissao')");
    if ($query) {
        echo false;
    }else {
        echo "Não foi possível inserir a mensagem no momento.";
    }

?>