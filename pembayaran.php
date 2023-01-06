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

$id = isset($_GET['id']) ? ($_GET['id']) : false;
	
if($id){
   $query = "select * from lc_movimento WHERE id = ".$id."";
   $query = runSQL($query);
   if($query && mysql_num_rows($query) == 1){
	  $rE = mysql_fetch_object($query);
   }
}

$rE->data = date('d/m/Y'); // Formato DATE: 2009-03-12

function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="util.js"></script>


</head>
<style>
    body,td,th,tr {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin: 0; padding: 0;}
input, select, textarea, .select{background-image:url(../img/fundo_input.jpg);
font: 14px Verdana; background-repeat:repeat-x; border:1px solid #ccc; background-color: #fff; color: #000;}

.input2{
    height: 32px;
    border:1px solid #E1E1E1; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px;
     background:url(imagens/bg_inputs_inverso.png) repeat-x;
}
input:focus, textarea:focus {
	outline: none;
}

.td01 {
	color: #000;
	font-weight: bold;
}

</style>
<script>
$nf('#nome').autocomplete(
    {
            source: "search.php",
            minLength: 2
    });

    $(function() {
        var availableTags = [
            "Outros",
            "Aluguel",
            "Comercial",
            "Operacional",
            "Nao Operacional",
            "Escritório",
            "Empréstimo"
        ];
        $nf( "#referente" ).autocomplete({
            source: availableTags
        });
    });

    function cancelar(){
              location.href = "?";
    }
</script>
<body>
<!-- div esquerda -->

<form id="form1" name="form1" method="post" action="process.php">
    <table border="0" align="center" cellpadding="0" cellspacing="10">
      <tr>
        <td  class="td01"><div align="right"  style="margin-bottom:10px;">Data:</div></td>
        <td width="320"><div align="left">
              <?php
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
                $data = "$dia/$mes/$ano";
                ?>

            <input type="text" disabled class="input2" name="data" size="11" maxlength="10" id="data" value ="<?= $data ?>"  style="color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "/>
              <input type="hidden" name="data" value="<?= $data ?>"/>
              <input type="hidden" name="caixa_id" id="caixa_id" value="<?php echo $rE->caixa_id ?>"/>
          </div></td>
      </tr>
      <tr>
          <td class="td01" ><div align="right">Tipo:</div></td>
        <td width="320"><div align="left">
                <?php
                    if ($rE->tipo == 1 ){
                        $entrada = 'checked="true"';
                    } else if($tipo == 0 ){
                        $saida = 'checked="true"';
                    }
                ?>
              <label>
                  <input type="radio" name="tipo" id="tipo" value="1" <?php echo $entrada ?> onclick="mostra('categoria1')" />
                Receita </label>
              <label>
                  <input type="radio" name="tipo" id="tipo" value="0" <?php echo $saida ?>  onclick="oculta('categoria1')"/>
                Despesa </label>
            </div>
        </td>
      </tr>
            <?php if ($rE->caixa_id == 1){ ?>
               <div id ="categoria1" style="display:none; margin-bottom:10px">
            <tr>
                  <td class="td01" ><div align="right">Particular:</div></td>
                <td>
                <select name="convenio" id="convenio">
                <option value="">Selecione</option>
                <option value="Particular 15"<?php echo selected( 'Particular 15', $rE->convenio ); ?>>Particular 15</option>
                <option value="Particular 20"<?php echo selected( 'Particular 20', $rE->convenio ); ?>>Particular 20</option>
                <option value="Particular 28"<?php echo selected( 'Particular 28', $rE->convenio ); ?>>Particular 28</option>
                <option value="Particular 32"<?php echo selected( 'Particular 32', $rE->convenio ); ?>>Particular 32</option>
                </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
            </div>
      <tr>
        <td  class="td01" ><div align="right">Pagamento:</div></td>
        <td width="320">
                <?php
                    if ($rE->pag_id == 1 ){
                        $pagamento = 'checked="true"';
                    } else if($rE->pag_id == 2 ){
                        $pagamento2 = 'checked="true"';
                    }
                ?>
              <label>
                  <input type="radio" name="pag_id" id="pag_id" value="1" <?php echo $pagamento ?>  onclick="oculta('funcionario1')"/>
                Dinheiro </label>
              <label>
                  <input type="radio" name="pag_id" id="pag_id" value="2" <?php echo $pagamento2 ?>  onclick="mostra('funcionario1')"/>
                Cheque </label>
        </td>
      </tr>
            <tr>
        <td  class="td01" ><div align="right"></div></td>
        <td width="320">

                    <div id="funcionario1" style="display:none; margin-bottom:10px">
                <label> Banco: </label>
              <input name="banco_nome" class="input2" value="<?php echo $rE->numero_cheque ?>" type="text" id="banco_nome" size="30" style="margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
              <br>
              <label> Num. Cheque: </label>
                  <input name="numero_cheque" class="input2" value="<?php echo $rE->banco_nome ?>" type="text" id="numero_cheque" size="20" style="margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
              </div>
        </td>
      </tr>


      <tr>
        <td  class="td01"><div align="right">Escolha:</div></td>
        <td width="320">
                <?php
                    if ($rE->servico == 1 ){
                        $checked = 'checked="true"';
                    } else if($rE->servico == 2 ){
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
        <td  class="td01"  ><div align="right">Nome:</div></td>
        <td width="320">
        <input  name="nome" class="input2" type="text" value="<?php echo $rE->nome ?>"  id="nome" size="40" maxlength="150" />
        </td>
      </tr>
      <tr>
        <td  class="td01"  ><div align="right" style="margin-bottom:10px;">Referente:</div></td>
        <td width="320">
        <input  name="referente" class="input2" type="text" value="<?php echo $rE->referente ?>"  id="referente" size="40" maxlength="150" style="margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />
        </td>
      </tr>
      <tr>
        <td  class="td01" ><div align="right" style="margin-bottom:10px;">Valor:</div></td>
        <td width="320">
        <label style="font-size: 12px;">R$</label><input class="input2" name="valor" type="text" value="<?php echo $rE->valor ?>"  id="valor" size="8" maxlength="10" style="margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
            <p>
	      <input type="submit" name="Submit" value="Salvar Alterações" style="height:30px; margin:2px; cursor: pointer" />
	  	 <input type="hidden" id="ID" name="ID" value="<?php echo $rE->id;?>">
                 <input type="" name="submit" value="Cancelar" style="text-align: center;height:26px; margin:2px; cursor: pointer" onclick="cancelar()" />

            </p>
          </div></td>
      </tr>
    </table>
  </form>
</div>
<!-- div esquerda -->

