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

        $sql = "Select id, usua_nome, usua_login, usua_permissao from lc_usuario where id = " . $id;
        $result = mysql_query($sql);

            while($valor = mysql_fetch_array($result)) {
    $cont++;
    $id     = $valor["id"];
    $usua_nome     = $valor["usua_nome"];
    $usua_login = $valor["usua_login"];
    $usua_login = $valor["usua_login"];
    $usua_permissao = $valor["usua_permissao"];

?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.mask.js" type="text/javascript"></script>
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
</script>
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
            <td width="35%" ><input  name="endereco" type="text" value="<?php echo $endereco ?>"  id="endereco" size="40" maxlength="80" />            </td>
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
            <td ><input  name="bairro" type="text" id="bairro" value="<?php echo $paci_cidade ?>"  size="40" maxlength="40" /></td>
            <td >Cidade:</td>
            <td ><input  name="paci_cidade" type="text" id="paci_cidade" value="<?php echo $paci_cidade ?>"  size="20" maxlength="60" /></td>
          </tr>
          <tr>
            <td >Estado:</td>
            <td colspan="3" ><input  name="paci_estado" type="text" value="<?php echo $paci_estado ?>" id="paci_estado"  size="5" maxlength="2" /></td>
          </tr>
          <tr>
            <td >Telefone:</td>
            <td ><input  name="telefone" type="text" id="telefone" value="<?php echo $telefone ?>" size="15" maxlength="15"/></td>
            <td >Celular:</td>
            <td ><b>
              <input name="paci_celular" type="text"   id="paci_celular" value="<?php echo $paci_celular ?>" size="15" maxlength="15"/>
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
                <select name="paci_sexo" class="textBox" id="paci_sexo">
                                          <option value="S">Selecione...</option>
                                          <option value="M">Masculino</option>
                                          <option value="F">Feminino</option>
                                          </select>
            </td>
          </tr>
        </table>

</form>
<?php
}
?>

