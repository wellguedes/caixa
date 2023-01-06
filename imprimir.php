<?php

error_reporting(0);
function runSQL($rsql) {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname   = "caixa";
	$connect = mysql_connect($hostname,$username,$password) or die ("Error: could not connect to database");
	$db = mysql_select_db($dbname);
	$result = mysql_query($rsql) or die ('query not running');
	return $result;
	mysql_close($connect);
}
include 'functions.php';
$functions = new functions();


$id = isset($_GET['id']) ? ($_GET['id']) : false;
$link = isset($_GET['link']) ? ($_GET['link']) : false;

if($id){
   $query = "select *
       from lc_movimento
       join lc_usuario u on (u.id = lc_movimento.usua_id_inc)
       WHERE lc_movimento.id = ".$id."";
   $query = runSQL($query);
   if($query && mysql_num_rows($query) == 1){
	  $rE = mysql_fetch_object($query);
   }
}

?>
<script>
function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'my div');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }



</script>

<div id="mydiv" style="display: none;">
<table>
    <tr>
        <td align="center">Physiosul - Centro de Fisioterapia Exerc&iacute;cio e Sa&uacute;de Porto Alegre</td>
    </tr>
    <tr>
        <td align="center">CNPJ - Telefone: (51) 3241.7574</td>
    </tr>
    <tr>
        <td align="center">Aluno - <?php echo $rE->nome ?></td>
    </tr>
    <tr>
        <td align="center">Valor: <?php echo $rE->valor ?></td>
    </tr>
    <tr>
      <?php
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        $data = "$dia/$mes/$ano";
        ?>
        <td align="center">Data de Pagamento: <?php echo $data ?></td>
    </tr>
    <tr>
      <?php
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        $mesAtual = $functions->mes_extenso2($mes);

        ?>
        <td align="center">Porto Alegre, <?php echo $dia . ' de ' . $mesAtual . ' de ' . $ano  ?></td>
    </tr>
    <tr>
        <td align="center">Atendente: <?php echo $rE->usua_nome?></td>
    </tr>
    <tr>
        <td align="center"><img src="img/logo.png"></td>
    </tr>

</table>
</div>
<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
