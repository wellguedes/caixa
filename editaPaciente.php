<?php
include 'functions.php';

$functions = new functions();

$objLogin = new Login();

if (!$objLogin->verificar('login.php'))
    exit;


$query = mysql_query("SELECT usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

	$id	= $_GET['id'];
	$nome	= $_GET['nome'];

        $sql = "Select id,nome,endereco,paci_end_compl, bairro, paci_end_numero,paci_cidade,paci_estado,paci_cep,
            telefone,paci_celular,paci_cpf,paci_rg,paci_email,paci_sexo,DATE_FORMAT(paci_data_nascimento, '%d/%m/%Y') as paci_data_nascimento from lc_paciente where id = " . $id;
        $result = mysql_query($sql);

            while($valor = mysql_fetch_array($result)) {
    $cont++;
    $id     = $valor["id"];
    $cpf     = $valor["paci_cpf"];
    $nome = $valor["nome"];
    $paci_data_nascimento = $valor["paci_data_nascimento"];
    $endereco = $valor["endereco"];
    $paci_end_compl = $valor["paci_end_compl"];
    $paci_end_numero = $valor["paci_end_numero"];
    $paci_cidade = $valor["paci_cidade"];
    $bairro = $valor["bairro"];
    $paci_estado = $valor["paci_estado"];
    $paci_cep = $valor["paci_cep"];
    $telefone = $valor["telefone"];
    $paci_celular = $valor["paci_celular"];
    $paci_cpf = $valor["paci_cpf"];
    $paci_rg = $valor["paci_rg"];
    $paci_email = $valor["paci_email"];
    $paci_sexo = $valor["paci_sexo"];

function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

?>
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.mask.js" type="text/javascript"></script>
<script src="js/jquery.printelement.min.js" type="text/javascript"></script>
<script type="text/javascript" src="teste/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="teste/development-bundle/ui/ui.tabs.js"></script>

<style type="text/css">
    input{
    border:1px solid #7A9CBC; /* BORDA */
    -moz-box-shadow: 0 0 3px #138AE7; /* BORDA */
    -webkit-box-shadow: 0 0 3px #138AE7;/* BORDA */
    box-shadow: 0 0 3px #138AE7;  /* BORDA */
    }
</style>
<script>
jQuery(function($){
	 $("#telefone").mask("(99) 9999-9999");
	 $("#paci_celular").mask("(99) 9999-9999");
	 $("#telefone_comercial").mask("(99) 9999-9999");
	 $("#paci_data_nascimento").mask("99/99/9999");
	 $("#paci_cep").mask("99999999");
});

	$(function() {
		$("#tabs").tabs();
	});

           $("#simplePrint").click(function(){
				$('#toPrint').printElement();
		   });

function exibe(id){
alert(id)
}

function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
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
<script type="text/javascript">
	// Função única que fará a transação
function getEndereco() {
    // Se o campo CEP não estiver vazio
    if($.trim($("#paci_cep").val()) != ""){
            /*
                    Para conectar no serviço e executar o json, precisamos usar a função
                    getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
                    dataTypes não possibilitam esta interação entre domínios diferentes
                    Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
                    http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
            */
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#paci_cep").val(), function(){
                    // o getScript dá um eval no script, então é só ler!
                    //Se o resultado for igual a 1
                    if(resultadoCEP["resultado"]){
                            // troca o valor dos elementos
                            $("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
                            $("#bairro").val(unescape(resultadoCEP["bairro"]));
                            $("#paci_cidade").val(unescape(resultadoCEP["cidade"]));
                            $("#paci_estado").val(unescape(resultadoCEP["uf"]));
                    }else{
                            alert("Endereço não encontrado");
                    }
            });
    }
}
</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Dados Pessoais</a></li>
		<li><a href="#tabs-2">Observações</a></li>
		<li><a href="#tabs-3">Histórico Financeiro</a></li>
	</ul>
	<div id="tabs-1">
<form action="" method="post" enctype="application/x-www-form-urlencoded" id="frmteste">
  	    <table width="100%" border="1" cellpadding="3" cellspacing="2">
  	      <tr class="tp_pacioa_fisica">
            <td >Nome:</td>
  	        <td ><input  name="nome" type="text" value="<?php echo $nome ?>"  id="nome" size="40" maxlength="150" /></td>
  	        <td >Data Nasc.:</td>
  	        <td ><input  name="paci_data_nascimento" value="<?php echo $paci_data_nascimento ?>" type="text"  id="paci_data_nascimento" size="12" maxlength="10"/></td>
	        </tr>
  	      <tr class="tp_pacioa_fisica">
            <td >CPF:</td>
  	        <td ><input  name="paci_cpf" type="text" value="<?php echo $paci_cpf ?>" id="paci_cpf" size="20"/></td>
  	        <td >RG:</td>
  	        <td ><input  name="paci_rg" type="text" value="<?php echo $paci_rg ?>"  id="paci_rg" size="12" maxlength="11"/></td>
	        </tr>
          <tr>
            <td width="13%" >Endere&ccedil;o:</td>
            <td width="35%" ><input  name="endereco" type="text" value="<?php echo utf8_decode($endereco) ?>"  id="endereco" size="40" maxlength="80" />            </td>
            <td width="14%" >Numero:</td>
            <td width="38%" ><input  name="paci_end_numero" type="text" value="<?php echo $paci_end_numero ?>"  id="paci_end_numero" size="12" maxlength="10"/></td>
          </tr>
          <tr>
            <td >Complemento:</td>
            <td ><input  name="paci_end_compl" type="text" value="<?php echo $paci_end_compl ?>" id="paci_end_compl" size="12" maxlength="10"/></td>
            <td >CEP :</td>
            <td ><input  name="paci_cep" type="text" value="<?php echo $paci_cep ?>" id="paci_cep" onBlur="getEndereco()"  size="10" maxlength="9"/></td>
          </tr>
          <tr>
            <td >Bairro:</td>
            <td ><input  name="bairro" type="text" id="bairro" value="<?php echo $bairro ?>"  size="40" maxlength="40" /></td>
            <td >Cidade:</td>
            <td ><input  name="paci_cidade" type="text" id="paci_cidade" value="<?php echo $paci_cidade ?>"  size="20" maxlength="60" /></td>
          </tr>
          <tr>
            <td >Estado:</td>
            <td colspan="3" ><input  name="paci_estado" type="text" value="<?php echo $paci_estado ?>" id="paci_estado"  size="5" maxlength="2" /></td>
          </tr>
          <tr>
            <td >Telefone:</td>
            <td ><input  name="telefone" type="text" id="telefone" value="
            <?php
            if ($id < 2892){
                echo '(51)'. $telefone;
            } else {
                echo $telefone;
            }
                ?>" size="15" maxlength="15"/></td>
            <td >Celular:</td>
            <td ><b>
              <input name="paci_celular" type="text"   id="paci_celular" value="
            <?php
            if ($id < 2892){
                $paci_celular = explode('   ', $telefone);
                echo '(51)'. $paci_celular[1];
            } else {
                echo $paci_celular;
            }
            ?>
                " size="15" maxlength="15"/>
            </b></td>
          </tr>
          <tr>
            <td >Email:</td>
              <td colspan="3" ><b>
                      <input name="paci_email" type="text" value="<?php echo $paci_email ?>"  id="paci_email" size="40" maxlength="40" />
                       </b><font size="1"> </font></td>
          </tr>
             <tr>
              <td >Sexo:</td>
            <td colspan="3" >
<select id="paci_sexo">
    <option value="">Escolha</option>
    <option value="M"<?php echo selected( 'M', $paci_sexo ); ?>>Masculino</option>
    <option value="F"<?php echo selected( 'F', $paci_sexo ); ?>>Feminino</option>
</select>
            </td>
          </tr>
        </table>

</form>
<?php
}
?>
	</div>
	<div id="tabs-2">
	<?php echo $out?>
	</div>
	<div id="tabs-3">
                             <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Caixa</th>
                      <th scope="col">Data</th>
                      <th scope="col">Referente</th>
                      <th scope="col">Valor</th>
                      <th scope="col">Comprovante</th>
                    </tr>
                    <?php
                        $sql = "select lm.id as id ,lp.nome, DATE_FORMAT(data, '%d/%m/%Y') as data, caixa_nome, valor, pag_id, referente
                                from lc_paciente lp
                                join lc_movimento lm on (lm.codPaciente = lp.id)
                                join lc_caixa using(caixa_id)
                                where lp.nome = '$nome'
                                order by 2";
                                $execute = mysql_query($sql);

                            while($value = mysql_fetch_array($execute)) {

                                $cont++;
                                $id     = $value["id"];
                                $nome     = $value["nome"];
                                $caixa_nome     = $value["caixa_nome"];
                                $data     = $value["data"];
                                $referente     = $value["referente"];
                                $valor     = $value["valor"];

                    ?>
                    <tr style="background-color:<? if ($cont % 2 == 0)
            echo "#FFFFFF"; else
            echo "#E6E7E9" ?>">
              <td><?php echo $nome ?></td>
              <td><?php echo $caixa_nome ?></td>
              <td><?php echo $data ?></td>
              <td><?php echo $referente ?></td>
              <td><?php echo $functions->formata_Dinheiro($valor) ?></td>
              <td><input type="image" src="imagens/print.png" onclick="exibe('<?php echo $id ?>')"/></td>
              <td><input type="button" value="Print Div" onclick="PrintElem('#mydiv')" /></td>
                    </tr>
            <div id="mydiv" style="display: none;">
            <?php echo $id . '-' . $valor ?>
            </div>
            <?php
            }
            ?>
          </table>
        </div>
</div>

