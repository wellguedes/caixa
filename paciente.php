<?php
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
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
<title>Caixa Physiosul</title>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
<link rel='stylesheet' type='text/css' href='css/estilo.css'/>
<link type="text/css" href="menu.css" rel="stylesheet" />
<link type="text/css" href="teste/ajax_search/css.css" rel="stylesheet" />
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="css/global.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="teste/css/redmond/jquery-ui-1.7.3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="teste/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="teste/js/jquery-ui-1.7.3.custom.min.js"></script>
<script src="js/jquery.mask.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<style type="text/css">
input {
	border:1px solid #7A9CBC; /* BORDA */
	-moz-box-shadow: 0 0 3px #138AE7; /* BORDA */
	-webkit-box-shadow: 0 0 3px #138AE7;/* BORDA */
	box-shadow: 0 0 3px #138AE7;  /* BORDA */
	border-radius:4px;
	-moz-border-radius:4px;
	color:#333;
}
.td15 {
	background-color: #D7E6FF;
	border:0px;
	color:#000000;
}
.td16 {
	background-color: #E8EEF7;
	color:#000000;
	border:0px;
}
</style>
<script>
jQuery(function($){
	 $("#telefone").mask("(99) 9999-9999");
	 $("#pess_celular").mask("(99) 9999-9999");
	 $("#paci_data_nascimento").mask("99/99/9999");
	 $("#paci_cep").mask("99999999");
});
	$(function() {
		$("#tabs").tabs();
	});

$('#search').autocomplete(
    {
            source: "cad/buscaPaciente.php",
            minLength: 2
    });

</script>
<script type="text/javascript">
        $(function(){
            // Dialog Link

               	$("#formulario").submit(function() {
		var nome = $("#nome").val();
		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('cad/categoria.php', {nome: nome},
                function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                //alert('foooi');
                $(this).dialog("close");
                location.reload();
                }
            });
                $("#nome").val("");
            });

        });


function cadastraRegistroDialog(){

}

function detalhePaciente(id){
var nome  = $('#nome').attr('value');
$("#dialog").dialog({
    bgiframe: true,
    autoOpen: false,
    height: 470,
    width: 860,
    modal: true,
    buttons: {
        'Salvar': function() {

                var nome = $("#nome").val();
                var paci_data_nascimento = $("#paci_data_nascimento").val();
                var endereco = $("#endereco").val();
                var paci_end_compl = $("#paci_end_compl").val();
                var paci_end_numero = $("#paci_end_numero").val();
                var bairro = $("#bairro").val();
                var paci_cidade = $("#paci_cidade").val();
                var paci_estado = $("#paci_estado").val();
                var paci_cep = $("#paci_cep").val();
                var telefone = $("#telefone").val();
                var paci_celular = $("#paci_celular").val();
                var paci_cpf = $("#paci_cpf").val();
                var paci_rg = $("#paci_rg").val();
                var paci_email = $("#paci_email").val();
                var paci_sexo = $("#paci_sexo").val();
                var data_hora_inc = $("#data_hora_inc").val();

		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('teste/update.php', {id:id,nome: nome,paci_data_nascimento:paci_data_nascimento,endereco:endereco,paci_end_compl:paci_end_compl,bairro:bairro, paci_end_numero:paci_end_numero,paci_cidade:paci_cidade,
                    paci_estado:paci_estado,paci_cep:paci_cep,telefone:telefone,paci_celular:paci_celular,paci_cpf:paci_cpf,paci_rg:paci_rg,paci_email:paci_email
                    ,paci_sexo:paci_sexo,data_hora_inc:data_hora_inc},
                function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                $.blockUI({
                theme:     true,
                title:    'Mensagem do Sistema',
                message:  '<center><p><b>Paciente Editado com Sucesso.</b></p></center>',
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
    url 	: 'editaPaciente.php',
    data: 'id='+id,
    dataType: "text",
    success: function(data){
        $('#dialog').html(data);
    },
    error : function(){alert("Erro ao tentar carregar o arquivo!")}

    });
}

function deletarRegistroDialog(id)
{
 var nome  = $('#nome').attr('value');

    $("#deletar").dialog({
            bgiframe: true,
            height: 140,
            modal: true,
           // title: 'Mensagem do Sistema',
                buttons: {
                    "Não": function() {
                        $(this).dialog("close");
                         location.href='';
                },
                    "Sim": function() {
                        deletarRegistro(id);
                        $(this).dialog("close");

                }
             }
    });
}

function deletarRegistro(id){

            $.ajax({
                    url 	: 'teste/deletar.php',
                    data: 'id='+id,
                    dataType: "text",
                    type : "POST",
                    success: function(data){
                            //alert(data)
                    $( "div.dialog" ).dialog({
                        modal: true,
                        height:200,
                        show: "fold",
                        hide: "explode",
                        buttons: {
                            "Fechar": function() {
                                $( this ).dialog( "close" );
                                 location.href='';

                    }
                }
            });

        }
    });
}
$(document).ready(function(){
	//show loading bar
	function showLoader(){
		$('.search-background').fadeIn(200);
	}
	//hide loading bar
	function hideLoader(){
		$('#sub_cont').fadeIn(1500);
		$('.search-background').fadeOut(200);
	};
	$('#search').keyup(function(e) {

      if(e.keyCode == 13) {

      	showLoader();

		$('#sub_cont').fadeIn(1500);
		$("#content #sub_cont").load("teste/ajax_search/search.php?val=" + $("#search").val(), hideLoader());
      }
      });
	$(".searchBtn").click(function(){
		//show the loading bar
		showLoader();

		$('#sub_cont').fadeIn(1500);
		$("#content #sub_cont").load("teste/ajax_search/search.php?val=" + $("#search").val(), hideLoader());
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
              <div class="titulo">Pacientes</div>
              <p>
              <form class="jNice" name="menu" method="get">
                <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
                  <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Lista de Pacientes</legend>
                  <hr />
                  <div id="busca">
                    <input type="text" value="" size="40" maxlength="100" name="search" id="search">
                    <div class="textBox">
                      <div class="searchBtn"> &nbsp; </div>
                    </div>
                    <br clear="all" />
                    <div id="content">
                      <div class="search-background">
                        <label><img src="loader.gif" alt="" /></label>
                      </div>
                      <p>
                      <div id="sub_cont"> </div>
                      </p>
                    </div>
                  </div>
                  <fieldset class="botao">
                  </fieldset>
                </fieldset>
              </form>
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
    <hr class="noscreen" />
    <div id="dialog" title="Dados do Paciente"> </div>
    <div class="dialog" style="display:none" title="Mensagem do Sistema"><img src="image/sucesso.png" alt="Carregando" /> Paciente Deletado com Sucesso!</div>
    <div class="dialog_sucesso" style="display:none" title="Mensagem do Sistema"><img src="image/sucesso.png" alt="Carregando" /> Paciente Cadastrado com Sucesso!</div>
    <div id="deletar" title="Mensagem do Sistema" style="display:none">Tem certeza de que deseja excluir o paciente? </div>
    <!-- Footer -->
    <div id="rodape">
      <p class="left">&copy; 2012 - Sistema de Caixa Physiosul - Todos os Direitos Reservados</p>
    </div>
    <!-- Footer end -->
  </div>
</div>
</body>
</html>
