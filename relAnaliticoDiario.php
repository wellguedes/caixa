<?php
header("Content-Type: text/html; charset=ISO-8859-1",true) ;

include 'functions.php';
require_once("config/conn.php");

$functions = new functions();

$objLogin = new Login();

if (!$objLogin->verificar('login.php'))
    exit;

$query = mysql_query("SELECT usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Caixa Physiosul</title>
<script type="text/javascript" src="js/utils.js"></script>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
<link rel='stylesheet' type='text/css' href='css/estilo.css'/>
<link type="text/css" href="menu.css" rel="stylesheet" />
<link href="css/global.css" rel="stylesheet" type="text/css" />

<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link type="text/css" href="teste/css/redmond/jquery-ui-1.7.3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="teste/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="teste/js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript" src="js/jquery.price_format.1.7.js"></script>

<script type="text/javascript">
$(document).ready(function(){
         $("#buscaDados").click(function(){
                var date = $("#date").val();
                var data1 = $("#data1").val();
                var caixa_id = $("#caixa_id").val();
                var ordem = $("#ordem").val();

                $.ajax({
                   url: "cad/buscaAnalitico.php",
                   dataType: 'html',
                   data: {date:date,data1:data1,caixa_id:caixa_id,ordem:ordem},
                   type: "POST",

                    beforeSend: function ()   {
                        $('#carregando').show();
                    },
                    success: function(data){
                        $('#carregando').hide();
                                $("#resBusca").html('<b>Resultado da busca</b><br /><br/>'+ data );

                    },
                        error: function(data){
                                $('#carregando').html(data);
                        }
                });
         });
 });
 function detalhePaciente(id){
$("#dialog").dialog({
    bgiframe: true,
    autoOpen: false,
    height: 470,
    width: 860,
    modal: true,
    buttons: {
        'Salvar': function() {
                var tipo = $("#tipo").val();
                var nome = $("#nome").val();
                var valor = $("#valor").val();
                var caixa_id = $("#caixa_id").val();
                var pag_id = $("#pag_id").val();
                var data = $("#data").val();
                var numero_cheque = $("#numero_cheque").val();
                var banco_nome = $("#banco_nome").val();
                var referente = $("#referente").val();
                var servico = $("#servico").val();
                var convenio = $("#convenio").val();
                var usua_id_inc = $("#usua_id_inc").val();
                var data_hora_inc = $("#data_hora_inc").val();
                var usua_id_alt = $("#usua_id_alt").val();
                var data_hora_alt = $("#data_hora_alt").val();

                var tipo = "";
                $('input:radio[name=tipo]').each(function() {
                        if ($(this).is(':checked'))
                                tipo = parseInt($(this).val());
                })
                //alert(tipo);

                var pag_id = "";
                $('input:radio[name=pag_id]').each(function() {
                        if ($(this).is(':checked'))
                                pag_id = parseInt($(this).val());
                })
                //alert(pag_id);

                var servico = "";
                $('input:radio[name=servico]').each(function() {
                        if ($(this).is(':checked'))
                                servico = parseInt($(this).val());
                })


                $("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('teste/updateLancamento.php', {id:id,tipo:tipo,nome: nome,valor:valor,caixa_id:caixa_id,pag_id:pag_id,data:data,numero_cheque:numero_cheque,banco_nome:banco_nome,referente:referente,servico:servico,convenio:convenio,
                usua_id_inc:usua_id_inc,data_hora_inc:data_hora_inc,usua_id_alt:usua_id_alt,data_hora_alt:data_hora_alt},
                function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                $.blockUI({
                theme:     true,
                title:    'Mensagem do Sistema',
                message:  '<center><p><b>Lançamento Editado com Sucesso.</b></p></center>',
                timeout:   1000,
                css: {
                width: '350px',
                opacity: .6,
                color: '#fff'
            }
                });
                }
            });
        },
        'Fechar': function() {
            $(this).dialog('close');
        }

    },
    close: function() {
        location.href = "?";
    }
});

$('#dialog').html("<img src='image/loader.gif' align='absmiddle' /> Aguarde carregando.").dialog('open');
$.ajax({
    url 	: 'editaLancamento.php',
    data: 'id='+id,
    dataType: "text",
    success: function(data){
        $('#dialog').html(data);
    },
    error : function(){alert("Erro ao tentar carregar o arquivo!")}

    });
}
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

        $("div.pop-up").css({'display':'block','opacity':'0'})

        $("a.trigger").hover(
          function () {
            $(this).prev().stop().animate({
              opacity: 1
            }, 500);
          },
          function () {
            $(this).prev().stop().animate({
              opacity: 0
            }, 200);
          }
	)	
 </script>
</head>
<body>
<div id="corpo">
  <div id="inicio">
    <!-- Header -->
    <div id="cabecalho">
      <h1><img src="img/logo.png" /></h1>
      <div id="login">Olá, <?php echo $row->usua_nome ?> <a href="sair.php"><img src="image/exit.png" alt="Sair"></img></a></div>
    </div>
    <?php
        include 'menu.php';
    ?>
    <hr class="noscreen" />
    <div id="conteudo-box">
      <div id="conteudo-box-in"> <a name="skip-menu"></a>
        <!-- conteudo left -->
        <div class="div_centro">
          <div id="content">
            <div class="innercont">
		<div class="titulo">Relatório Análitico Diário</div>
                <p>
                <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
                  <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Relatório de Caixas</legend>
                  <hr />
                  <table border="0" cellspacing="0" cellpadding="0" width="100%">
		<td>
                <p>
                    <label>Data Inicial:</label>
                 <input type="text" name="date" size="11" maxlength="10" id="date" />
                </p>
                <p>
            <label>
                Caixa:
            </label>
                <select name="caixa_id" id="caixa_id" class="select" style="padding:3px; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; ">
                    <?php
                        $result = $functions->getCaixa();

                        while($valor = mysql_fetch_array($result)) {
                        $caixa_id     = $valor["caixa_id"];
                        $caixa_nome = $valor["caixa_nome"];
                    ?>
                        <option value="<?= $valor['caixa_id'] ?>"><?= $valor['caixa_nome'] ?> </option>

                        <? } ?>

                </select>
                </p>
                <div style="text-align:left"><input name="buscaDados" type="submit" id="buscaDados" value="Buscar" style="height:30px; cursor: pointer; margin:2px"/></div>


                </td>
                  </table>
                    <div id="carregando" style="display:none;"><img src="image/load.gif" /></div>
                  <div id="resBusca">
                  </div>
                </fieldset>
               </p>
            </div>
          </div>
          <br/>
        </div>
        <!-- div esquerda -->
        <div class="conteudo-box-left">
          <table>
            <tr> </tr>
          </table>
          <div class="conteudo-box-left-in">
            <div id="teste"> </div>
            <p>
            <div class="menu1"> </div>
            <div class="mensal"> </div>
            </p>
          </div>
        </div>
        <hr class="noscreen" />
        <div class="cleaner">&nbsp;</div>
      </div>
    </div>
    <div id="dialog" title="Editar Lançamento"> </div>

    <hr class="noscreen" />
    <!-- Footer -->
    <div id="rodape">
      <p class="left">&copy; 2012 - Sistema de Caixa Physiosul - Todos os Direitos Reservados</p>
    </div>
    <!-- Footer end -->
  </div>
</div>
</body>
</html>
