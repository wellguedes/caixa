<?php
include 'functions.php';
require_once("config/conn.php");

$functions = new functions();

$objLogin = new Login();

if (!$objLogin->verificar('login.php'))
    exit;

$query = mysql_query("SELECT id, usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
<title>Caixa Physiosul</title>
<link rel="stylesheet" href="js/dialog/themes/redmond/jquery.ui.all.css"/>
<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />
<script class="jsbin" src="j/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="util.js"></script>
<script src="js/dialog/ui/minified/jquery.ui.dialog.min.js"></script>

<script type="text/javascript">
	var $nf = jQuery.noConflict();
</script>
<link type="text/css" href="css/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="js/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="js/ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript" src="js/flexigrid.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
<link rel='stylesheet' type='text/css' href='css/estilo.css'/>
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="js/flexigrid.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript" src="js/jquery.price_format.1.7.js"></script>

<script type="text/javascript">
$(document).ready(function(){

$nf('#nome').autocomplete(
    {
            source: "search.php",
            minLength: 2
    });
    
$nf('#banco_nome').autocomplete(
    {
            source: "cad/bancos.php",
            minLength: 2
    });
$("#flex1").flexigrid
        (
        {
        url: 'interface/loja.php',
        dataType: 'json',
        colModel : [
                {display: 'Dia', name : 'data', width : 40, sortable : true, align: 'center'},
                {display: 'Nome do Cliente', name : 'nome', width : 250, sortable : true, align: 'left'},
                {display: 'Referente à', name : 'referente', width : 250, sortable : true, align: 'left'},
                {display: 'Pagamento', name : 'pag_nome', width : 60, sortable : true, align: 'center'},
                {display: 'Valor', name : 'nome', width : 120, sortable : true, align: 'left'},
                ],

        buttons : [
                //{name: 'Add', bclass: 'add', onpress : test},
                {name: 'Deletar Movimento', bclass: 'delete', onpress : test},
                {name: 'Editar Movimento', bclass: 'edit', onpress : test},
                //{name: 'Imprimir', bclass: 'imprimir', onpress : test},
                ],
        searchitems : [
                {display: 'Valor', name : 'valor'},
                {display: 'Nome', name : 'nome', isdefault: true}
                ],
        sortname: "id",
        sortorder: "asc",
        usepager: true,
        title: 'Movimentos de hoje',
        useRp: true,
        rp: 30,
        showTableToggleBtn: true,
        width: 800,
        height: 255
        }
    );


	$("#formulario").submit(function() {
		var nome = $("#nome").val();
		var valor = $("#valor").val();
		var caixa_id = $("#caixa_id").val();
		var cat = $("#cat").val();
                var data = $("#data").val();
                var tipo = $("#tipo").val();
                var pagamento = $("#pagamento").val();
                var banco_nome = $("#banco_nome").val();
                var numero_cheque = $("#numero_cheque").val();
                var referente = $("#referente").val();

                var tipo = "";
                $('input:radio[name=tipo]').each(function() {
                        if ($(this).is(':checked'))
                                tipo = parseInt($(this).val());
                })
                //alert(tipo);

                var pagamento = "";
                $('input:radio[name=pagamento]').each(function() {
                        if ($(this).is(':checked'))
                                pagamento = parseInt($(this).val());
                })
                //alert(pagamento);
                
                var servico = "";
                $('input:radio[name=servico]').each(function() {
                        if ($(this).is(':checked'))
                                servico = parseInt($(this).val());
                })

                $nf("#cross").empty();

                // Exibe mensagem de carregamento
		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		// requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post('envia.php', {nome: nome, valor: valor, caixa_id:caixa_id, cat:cat, data:data, tipo:tipo, pagamento:pagamento, banco_nome:banco_nome, numero_cheque:numero_cheque,servico:servico,referente:referente}, function(resposta) {

                // Quando terminada a requisição
                // Exibe a div status
                $("#status").slideDown();
                // Se a resposta é um erro
                if (resposta != false) {
                    // Exibe o erro na div
                    $("#status").html(resposta);
                    alert(resposta);

                $("#flex1").flexReload();

                }

                // Se resposta for false, ou seja, não ocorreu nenhum erro
                else {
                $.blockUI({
                theme:     true,
                title:    'Mensagem do Sistema',
                message:  '<center><p><b>Movimento Cadastrado com Sucesso.</b></p></center>',
                timeout:   1000,
                css: {
                width: '350px',
                opacity: .6,
                color: '#fff'
            }
                });
                $("#flex1").flexReload();
                var auto_refresh = setInterval(
                function ()
                {

                //$nf('#load_tweets').load('academia.php').fadeIn("slow");
                $nf("#painel").load('loja.php #painel').fadeIn("slow");
                $nf("#diario").load('loja.php #diario').fadeIn("slow");
                $nf("#caixa").load('loja.php #caixa').fadeIn("slow");
                $nf("#valores").load('loja.php #valores').fadeIn("slow");

                }, 2000); // refresh every 10000 milliseconds

                // Exibe mensagem de sucesso
                // Coloca a mensagem no div de mensagens

                // Limpando todos os campos
                $("#nome").val("");
                $("#valor").val("");
                $("#caixa_id").val();
		$("#cat").val("");
               // $("#tipo").val("");
                //$("#pagamento").val("");
                $("#banco_nome").val("");
                $("#numero_cheque").val("");
                $("#status").val("");
                $("#referente").val("");

                    }
		});
	});
});

function getid(com,grid){
	var id='';
	$('.trSelected', grid).each(function() {
		id = $(this).attr('id');
		id = id.substring(id.lastIndexOf('row')+3);
	});
	return id;
}
$nf(document).ready(function(){
	//define config object
   var dialogAdd = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        height: 370,
        width: 640,
        draggable: true,
        resizeable: true,
        open: function(com,grid) {
            //display correct dialog content
            $("#formadd").load("pembayaran.php");
        }
   };
   $nf("#formadd").dialog(dialogAdd);  //end dialog
   var dialogEdit = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        height: 500,
        width: 640,
        draggable: true,
        resizeable: true,
        open: function(com,grid) {
            //display correct dialog content
            $("#formedit").load("pembayaran.php?id="+getid()+"");
        }
   };
   $nf("#formedit").dialog(dialogEdit);  //end dialog

   var dialogImprimir = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        height: 500,
        width: 640,
        draggable: true,
        resizeable: true,
			buttons: [
                    { text: "Ok",
                        click: function () {
                                $( this ).dialog( "close" );
                            return true;
                        }
                    }
                ],
        open: function(com,grid) {
            //display correct dialog content
            $("#formimprimir").load("imprimir.php?id="+getid()+"");
        }
   };
   $nf("#formimprimir").dialog(dialogImprimir);  //end dialog
});

function caixa(valor){

decisao = confirm("Tem certeza que deseja fechar o caixa?");
    if (decisao){
        	$("#fechar").submit(function() {

		var caixa_id = $("#caixa_id").val();
		var usua_id_inc = $("#usua_id_inc").val();
		var conta_id = $("#conta_id").val();
		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		// requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post('cad/fechamento.php', {valor: valor,usua_id_inc:usua_id_inc,caixa_id:caixa_id,conta_id:conta_id},
                function(resposta) {

                // Quando terminada a requisição
                // Exibe a div status
                $("#status").slideDown();
                // Se a resposta é um erro
                if (resposta != false) {
                    // Exibe o erro na div
                    $("#status").html(resposta);
                    alert(resposta);
                }

                // Se resposta for false, ou seja, não ocorreu nenhum erro
                else {
                $.blockUI({
                theme:     true,
                title:    'Mensagem do Sistema',
                message:  '<center><p><b>Caixa Fechado com Sucesso.</b></p></center>',
                timeout:   1000,
                css: {
                width: '350px',
                opacity: .6,
                color: '#fff'
            }
                });

                // Exibe mensagem de sucesso
                // Coloca a mensagem no div de mensagens

                // Limpando todos os campos
                $("#valor").val("");
                    }
		});
	});
    }
}
function test(com,grid)
{
	if (com=='Deletar Movimento')
	{
	   if($('.trSelected',grid).length>0){
	   if(confirm('Desejar apagar ' + $('.trSelected',grid).length + ' Movimento(s)?')){
		var items = $('.trSelected',grid);
		var itemlist ='';
		for(i=0;i<items.length;i++){
			itemlist+= items[i].id.substr(3)+",";
		}
		$.ajax({
		   type: "POST",
		   dataType: "json",
		   url: "delete.php",
		   data: "items="+itemlist,
		   success: function(data){
                $.blockUI({
                theme:     true,
                title:    'Mensagem do Sistema',
                message:  '<center><p><b>Movimento Deletado com Sucesso.</b></p></center>',
                timeout:   1000,
                css: {
                width: '350px',
                opacity: .6,
                color: '#fff'
            }
                });
                $("#flex1").flexReload();
                var auto_refresh = setInterval(
                function ()
                {

                $nf("#painel").load('loja.php #painel').fadeIn("slow");
                $nf("#diario").load('loja.php #diario').fadeIn("slow");
                $nf("#caixa").load('loja.php #caixa').fadeIn("slow");
                $nf("#valores").load('loja.php #valores').fadeIn("slow");

                }, 2000); // refresh every 10000 milliseconds
                }
		 });
		}
		} else {
			return false;
		}
	}
	else if (com=='Add')
	{
		$nf("#formadd").dialog('open');
	}
	else if (com=='Editar Movimento')
	{
		if($('.trSelected',grid).length>0){
			$nf("#formedit").dialog('open');
		}else{
                        alert('Selecione um lançamento!')
			return false;
		}
	}

      if(com == 'Imprimir'){
            $nf("#formimprimir").dialog('open');
        }
}
    $(function() {
        var availableTags = [
            "Outros",
            "Aluguel",
            "Comercial",
            "Operacional",
            "Nao Operacional",
            "Escritório"
        ];
        $nf( "#referente" ).autocomplete({
            source: availableTags
        });
    });

</script>
</head>
<body>
<div id="corpo">
  <div id="inicio">
    <!-- Header -->
    <div id="cabecalho">
      <h1><img src="img/logo.png" /></h1>
      <?php
        if(date('G') >= 0 && date('G') < 12) {
        $saudacao = 'Bom dia';
        } else if(date('G') >= 12 && date('G') < 18){
            $saudacao = 'Boa tarde';
        } else {
            $saudacao = 'Boa noite';
        }
      ?>
      <div id="login"><?php echo $saudacao.", "; echo $row->usua_nome ?> <a href="sair.php"><img src="image/exit.png" alt="Sair"></img></a></div>
    </div>
    <!-- Header end -->
    <!-- Menu -->
    <?php
                    include 'menu.php';
                ?>
    <!-- Menu end -->
    <hr class="noscreen" />
    <div id="conteudo-box">
      <div id="conteudo-box-in"> <a name="skip-menu"></a>
        <!-- conteudo left -->
        <div class="div_centro">
          <h1 style="color: #FFD700; font-size: 35px; font-family: arial;">Caixa Loja</h1>
          <div class="titulo">Dia Atual</div>
          <br/>
          <form id="formulario" action="javascript:func()" method="post">
            <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
              <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Ficha de Cadastrado</legend>
              <?php
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
                $data = "$dia/$mes/$ano";
                ?>
              Data:
              <input type="text" disabled name="data" size="11" maxlength="10" id="data" value ="<?= $data ?>" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />
              <input type="hidden" name="data" value="<?= $data ?>"/>
              <input type="hidden" name="caixa_id" id="caixa_id" value="2"/>
              <input type="hidden" name="link" id="link" value="loja.php"/>

              <br/>
              <p>
                <label>Tipo:</label>
                <label>
                  <input type="radio" name="tipo" id="tipo" value="1" />
                  Receita </label>
                <label>
                  <input type="radio" name="tipo" id="tipo" value="0" />
                  Despesa </label>
              </p>
              <p>
                  <!--
                <label> Categoria: </label>
                <select name="cat" id="cat" class="select" style="padding:3px; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; ">
                  <?php
                        $result = $functions->getCategoria();

                        while($valor = mysql_fetch_array($result)) {
                        $id     = $valor["id"];
                        $nome = $valor["nome"];
                        echo "<option value=\"$id\">$nome</option>\n";
                    }
                    ?>
                </select>
                  -->              </p>
              <label>Pagamento:</label>
              <label>
                <input type="radio" name="pagamento" id="pagamento" value="1" checked="true" onclick="oculta('funcionario')" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; "/>
                Dinheiro </label>
              <label>
                <input type="radio" name="pagamento" id="pagamento" value="2" onclick="mostra('funcionario')" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />
                Cheque </label>
              <p>
              <div id="funcionario" style="display:none; margin-bottom:10px">
                <label> Banco: </label>
              <input name="banco_nome" type="text" id="banco_nome" size="30" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />

                <p>
                  <label> Núm. Cheque </label>
                  <input name="numero_cheque" type="text" id="numero_cheque" size="20" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
                </p>
              </div>
              <label>
                <input type="radio" name="servico" id="servico" value="1" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; "/>
                Prestação de Serviços </label>
              <label>
                  <input type="radio" name="servico" id="servico" value="2" checked ="true" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />
                Paciente </label>

              </p>
              <p>
              <label>Nome do Cliente:</label>
              <input name="nome" type="text" id="nome" size="50" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
              <div id="cross">Este Paciente já fez um pagamento este mês</div>
              </p>
              <label>Referente à:</label>
              <input name="referente" type="text" id="referente" size="50" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
              <p>
                <label> Valor:
                  R$
                  <input name="valor" type="text" id="valor" size="8" maxlength="10" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " value="" onfocus="if (this.value == '') {this.value=''; this.style.color='#000'}" onblur=" if (this.value == '') { this.value = ''; this.style.color='#999'} "  />
                </label>
              </p>
            </fieldset>
            <div style="text-align:left">
              <input name="enviar" type="submit" id="enviar" value="Cadastrar" onclick="return validaForm();" style="height:30px; margin:2px; cursor: pointer" />
            </div>
          </form>
          <div id="caixa">
          <form id="fechar" action="javascript:func()" method="post">
            <?php
            $entrada = $functions->getEntradaLoja();
            while($valorDia = mysql_fetch_array($entrada)) {
                 //echo "<pre>";print_r($valorDia);echo "</pre>";

                $entrouDia = $valorDia['total'];
            }

            $saidaDia = $functions->getSaidaLoja();
            while($valor = mysql_fetch_array($saidaDia)) {
                // echo "<pre>";print_r($valor);echo "</pre>";
                $saiuDia = $valor['total'];
            }

                $valor = $entrouDia - $saiuDia;
                $formata_dinheiro = $functions->formata_Dinheiro($valorDia);
            ?>
               <input name="1" type="submit" id="1" value="Fechar Caixa" onclick="caixa('<?php echo $valor ?>');" style="height:30px; margin:2px;cursor: pointer" />
              <input type="hidden" name="caixa_id" id="caixa_id" value="2"/>
              <input type="hidden" name="usua_id_inc" id="usua_id_inc" value="<?php echo $row->id ?>"/>
              <input type="hidden" name="conta_id" id="conta_id" value="1"/>
          </form>
          </div>
        </div>
        <!-- div esquerda -->
        <div class="conteudo-box-left">
          <table>
            <tr> </tr>
          </table>
          <?php
                        $entrada = $functions->getEntradaLoja();
                        while($valor = mysql_fetch_array($entrada)) {
                             //echo "<pre>";print_r($valor);echo "</pre>";

                            $entrou = $valor['total'];
                        }

                        $saida = $functions->getSaidaLoja();
                        while($valor = mysql_fetch_array($saida)) {
                             //echo "<pre>";print_r($valor);echo "</pre>";
                            $saiu = $valor['total'];
                        }

                        $resultado = $entrou - $saiu;
                        $formata_dinheiro = $functions->formata_Dinheiro($valor);
                    ?>
          <div class="conteudo-box-left-in">
            <table id="flex1" style="display:none">
              <tr>
                <td></td>
              </tr>
            </table>
            <div id="formadd" style="display:none" title="Mensagem do Sistema">Sucesso!</div>
            <div id="teste">
                                    <div id="diario">

              <table width="200">
                <tr>
                  <td><strong style="font-size:22px; color:<? if ($resultado < 0)
                echo "#C00"; else
                echo "#000" ?>"></strong></td>
                  <td align="center"><strong style="font-size:22px; color:<? if ($resultado < 0)
                echo "#C00"; else
                echo "#000" ?>">
                    <?= $functions->formata_Dinheiro($resultado) ?>
                    </strong></td>
                </tr>
              </table>
                                        </div>
            </div>
            <p>
              <style type="text/css">

.menu1 { float: left; padding-left: 200px; }
.mensal { float: right; width: 200px; }
#nome{
    padding:3px;
    border:1px #7AC6E7 solid;
}

    #tick{display:none}
    #cross{display:none}
</style>
              <?php
            $entrada = $functions->getEntradaDiaLoja();
            while($valorDia = mysql_fetch_array($entrada)) {
                 //echo "<pre>";print_r($valorDia);echo "</pre>";

                $entrouDia = $valorDia['total'];
            }

            $saidaDia = $functions->getSaidaDiaLoja();
            while($valor = mysql_fetch_array($saidaDia)) {
                // echo "<pre>";print_r($valor);echo "</pre>";
                $saiuDia = $valor['total'];
            }

                $resultado_dia = $entrouDia - $saiuDia;
                $formata_dinheiro = $functions->formata_Dinheiro($valorDia);

            $emDinheiro = $functions->getDinheiroLoja();
            while($valor = mysql_fetch_array($emDinheiro)) {
                // echo "<pre>";print_r($valor);echo "</pre>";
                $entrouDinheiro = $valor['total'];
            }

            $emCheque = $functions->getChequeLoja();
            while($valor = mysql_fetch_array($emCheque)) {
                // echo "<pre>";print_r($valor);echo "</pre>";
                $entrouCheque = $valor['total'];
            }

            ?>
        <div id="painel">
            <div class="menu1">
              <fieldset style="width: 350px; height: 100px">
                <?php //echo date("t/m/Y"); ?>
                <legend><strong>Entradas e Saídas de hoje</strong></legend>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td><span style="font-size:18px; color:#000">Entradas:</span></td>
                    <td align="right"><span style="font-size:18px; color:#000">
                      <?= $functions->formata_Dinheiro($entrouDia) ?>
                      </span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size:18px; color:#C00">Saídas:</span></td>
                    <td align="right"><span style="font-size:18px; color:#C00">
                      <?= $functions->formata_Dinheiro($saiuDia) ?>
                      </span></td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr size="1" /></td>
                  </tr>
                  <tr>
                    <td><strong style="font-size:22px; color:<? if ($resultado_dia < 0)
                echo "#C00"; else
                echo "#000" ?>">Total Diário:</strong></td>
                    <td align="right"><strong style="font-size:22px; color:<? if ($resultado_dia < 0)
                echo "#C00"; else
                echo "#000" ?>">
                      <?= $functions->formata_Dinheiro($resultado_dia) ?>
                      </strong></td>
                  </tr>
                </table>
                <div id="valores">
                Em dinheiro: <?php echo $functions->formata_Dinheiro($entrouDinheiro) ?> - Em Cheque: <?php echo $functions->formata_Dinheiro($entrouCheque) ?>
                </div>
              </fieldset>
            </div>
            </div>
            </p>
          </div>
        </div>
        <!-- conteudo left end -->
        <hr class="noscreen" />
        <!-- conteudo right -->
        <!-- conteudo right end -->
        <div class="cleaner">&nbsp;</div>
      </div>
    </div>
    <hr class="noscreen" />
    <!-- Footer -->
    <div id="rodape">
        <a href="#top"> <img src="image/up.png" border="0" title="Voltar ao Topo"></img></a>
      <p class="left">&copy; 2012 - Sistema de Caixa Physiosul - Todos os Direitos Reservados</p>
    </div>
    <!-- Footer end -->
  </div>
</div>
    <div id="deletar" title="Mensagem do Sistema" style="display:none">Tem certeza de que deseja excluir o usuário? </div>
<div id="formadd" style="display:none" title=""></div>
<div id="formedit" style="display:none" title="Alteração de Lançamento"></div>
<div id="formimprimir" style="display:none" title="Alteração de Lançamento"></div>

</body>
</html>
