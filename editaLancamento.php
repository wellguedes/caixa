<?php
include 'functions.php';

$functions = new functions();

$objLogin = new Login();


$query = mysql_query("SELECT usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

	$id	= $_GET['id'];

        $sql = "Select lc_movimento.id,tipo, nome, valor, caixa_id, pag_id, DATE_FORMAT(data, '%d/%m/%Y') as data,
                        numero_cheque, banco_nome, referente, servico, convenio,
                        data_hora_inc, DATE_FORMAT(data_hora_inc, '%d/%m/%Y - %H:%i') as data_hora_inc, DATE_FORMAT(data_hora_alt, '%d/%m/%Y - %H:%i')as data_hora_alt, usua_id_alt, lc.usua_nome,
                        (select lc.usua_nome from lc_movimento l left join lc_usuario lc on (l.usua_id_inc = lc.id) where l.id = " . $id .") as nomeInclusao
            from lc_movimento
            left join lc_usuario lc on (lc.id = lc_movimento.usua_id_alt)
            where lc_movimento.id = " . $id;
        $result = mysql_query($sql);

function str_maiuscula($texto) {
    $texto = strtr(strtoupper($texto),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿç","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßÇ");
    return $texto;
}

while($valor = mysql_fetch_array($result)) {
    $cont++;
    $id     = $valor["id"];
    $tipo     = $valor["tipo"];
    $nome     = str_maiuscula($valor["nome"]);
    $total     = $valor["valor"];
    $caixa_id     = $valor["caixa_id"];
    $pag_id     = $valor["pag_id"];
    $data     = $valor["data"];
    $numero_cheque     = $valor["numero_cheque"];
    $banco_nome     = $valor["banco_nome"];
    $referente     = $valor["referente"];
    $servico     = $valor["servico"];
    $convenio     = $valor["convenio"];
    $nomeEdicao     = $valor["usua_nome"];
    $hora_alt     = $valor["data_hora_alt"];
    $hora_inc     = $valor["data_hora_inc"];
    $nomeInclusao     = $valor["nomeInclusao"];
    $total = str_replace(".", ",", $total);

function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

?>
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.mask.js" type="text/javascript"></script>
<script type="text/javascript" src="teste/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="teste/development-bundle/ui/ui.tabs.js"></script>
<script type="text/javascript" src="js/jquery.price_format.1.7.js"></script>

<style type="text/css">
    input{
    border:1px solid #7A9CBC; /* BORDA */
    -moz-box-shadow: 0 0 3px #138AE7; /* BORDA */
    -webkit-box-shadow: 0 0 3px #138AE7;/* BORDA */
    box-shadow: 0 0 3px #138AE7;  /* BORDA */
    }
</style>
<script>
	$(function() {
		$("#tabs").tabs();
	});
/*
$('#valor').priceFormat({
    prefix: ' ',
    centsSeparator: ',',
    thousandsSeparator: '.'
});
*/
$('#nome').autocomplete(
    {
            source: "search.php",
            minLength: 2
    });

</script>

  	    <table width="100%" border="1" cellpadding="3" cellspacing="2">
            <tr>
                <td >Data:</td>
                <td>
                    <input type="text" name="data" size="11" maxlength="10" id="data" value ="<?= $data ?>"/>
                </td>
            </tr>
            <tr>
                <td >Tipo:</td>
                <td>
                <?php
                    if ($tipo == 1 ){
                        $entrada = 'checked="true"';
                    } else if($tipo == 0 ){
                        $saida = 'checked="true"';
                    }
                ?>
              <label>
                  <input type="radio" name="tipo" id="tipo" value="1" <?php echo $entrada ?>/>
                Receita </label>
              <label>
                  <input type="radio" name="tipo" id="tipo" value="0" <?php echo $saida ?>/>
                Desposa </label>
                </td>
            </tr>
            <?php if ($caixa_id == 1){ ?>
            <tr>
                <td>
                <label> Particular: </label>
                </td>
                <td>
                <select name="convenio" id="convenio">
                <option value="">Selecione</option>
                <option value="Particular 15"<?php echo selected( 'Particular 15', $convenio ); ?>>Particular 15</option>
                <option value="Particular 20"<?php echo selected( 'Particular 20', $convenio ); ?>>Particular 20</option>
                <option value="Particular 28"<?php echo selected( 'Particular 28', $convenio ); ?>>Particular 28</option>
                <option value="Particular 32"<?php echo selected( 'Particular 32', $convenio ); ?>>Particular 32</option>
                </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td >Pagamento:</td>
                <td>
                <?php
                    if ($pag_id == 1 ){
                        $pagamento = 'checked="true"';
                    } else if($pag_id == 2 ){
                        $pagamento2 = 'checked="true"';
                    }
                ?>
              <label>
                  <input type="radio" name="pag_id" id="pag_id" value="1" <?php echo $pagamento ?>  onclick="oculta('funcionario')"/>
                Dinheiro </label>
              <label>
                  <input type="radio" name="pag_id" id="pag_id" value="2" <?php echo $pagamento2 ?>  onclick="mostra('funcionario')"/>
                Cheque </label>
                </td>
            </tr>
            <?php if ($pag_id == 2) { ?>
            <tr>
                <td>Banco</td>
  	        <td ><input  name="banco_nome" type="text" value="<?php echo utf8_decode($banco_nome) ?>"  id="banco_nome" size="20" maxlength="30" /></td>

            </tr>
            <tr>
                <td>Nro Cheque</td>
  	        <td ><input  name="numero_cheque" type="text" value="<?php echo $numero_cheque ?>"  id="numero_cheque" size="20" maxlength="30" /></td>

            </tr>
            <?php } ?>
            <tr>
                <td >Escolha:</td>
                <td>
                <?php
                    if ($servico == 1 ){
                        $checked = 'checked="true"';
                    } else if($servico == 2 ){
                        $checked2 = 'checked="true"';
                    }
                ?>
              <label>
                  <input type="radio" name="servico" id="servico" value="1" <?php echo $checked ?>/>
                Prestação de Serviços </label>
              <label>
                  <input type="radio" name="servico" id="servico" value="2" <?php echo $checked2 ?>/>
                Paciente </label>
                </td>
            </tr>
  	      <tr>
                <td >Nome:</td>
  	        <td ><input  name="nome" type="text" value="<?php echo utf8_decode($nome) ?>"  id="nome" size="40" maxlength="150" /></td>
            </tr>
            <tr>
                <td >Referente à:</td>
  	        <td ><input  name="referente" type="text" value="<?php echo utf8_decode($referente) ?>"  id="referente" size="40" maxlength="150" /></td>
            </tr>
            <tr>
                <td >Valor:</td>
                <td ><label style="font-size: 15px;">R$</label><input  name="valor" type="text" value="<?php echo $total ?>"  id="valor" size="8" maxlength="10" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Data de Inclusão:<?php echo $hora_inc ?> Por: <?php echo $nomeInclusao ?> | Última edição: <?php echo $hora_alt ?>  Por: <?php echo $nomeEdicao ?></td>
            </tr>
            <?php
                }
            ?>
          </table>

