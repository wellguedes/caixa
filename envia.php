<?php

require_once("config/conn.php");

$objLogin = new Login();

if (!$objLogin->verificar('login.php'))
    exit;

$query = mysql_query("SELECT id, usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

$nome = $_POST["nome"];
$valor = $_POST["valor"];
$tipo = $_POST["tipo"];
$cat = $_POST["cat"];
$caixa_id = $_POST["caixa_id"];
$data = $_POST["data"];
$pag_id = $_POST["pagamento"];
$banco_nome = $_POST["banco_nome"];
$numero_cheque = $_POST["numero_cheque"];
$servico = $_POST["servico"];
$referente = $_POST["referente"];
$convenio = $_POST["convenio"];
$usua_id_inc = $row->id;

$data = date("Y/m/d h:i:s");

$valor = str_replace(",", ".", $valor);

$checkn = "SELECT * FROM lc_paciente WHERE nome = '$nome'";
$sqlcheckn = mysql_query($checkn);
$rowsn = mysql_num_rows($sqlcheckn);

if ($tipo == 0){
    $convenio = null;
}

if ($rowsn == 0){
    $insere = mysql_query("insert into lc_paciente(nome) values ('$nome')");
    if ($insere) {
        echo false;
    } else {
        echo "Não foi possível inserir a o paciente no momento.";
    }
}

$sql = mysql_query("SELECT id FROM lc_paciente WHERE nome = '$nome'");
$row = mysql_fetch_object($sql);

$codPaciente = $row->id;

$query = mysql_query("INSERT INTO lc_movimento(tipo,cat,nome,valor,caixa_id,pag_id,data,banco_nome,numero_cheque,referente,codPaciente,servico,convenio,usua_id_inc,data_hora_inc)values ('$tipo','$cat','$nome','$valor','$caixa_id','$pag_id','$data','$banco_nome','$numero_cheque','$referente','$codPaciente',$servico,'$convenio','$usua_id_inc',now())");
if ($query) {
    echo false;
} else {
    echo "Não foi possível inserir a o paciente no momento.";
}
?>