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
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection, tv" />
<link rel='stylesheet' type='text/css' href='css/estilo.css'/>
    <link type="text/css" href="menu.css" rel="stylesheet" />

<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="css/global.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="teste/css/redmond/jquery-ui-1.7.3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="teste/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="teste/js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript">
        $(function(){
            $('#dialog').dialog({
                modal: true,
                height:380,
                width: 450,
                show: "fold",
                hide: "explode",
                autoOpen: false,
                buttons: {
                    'Salvar': function() {

		var valor = $("#valor").val();
		var data = $("#data").val();
                var conta_id = $("#conta_id").val();
		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('cad/transConta.php', {valor:valor,data:data,conta_id: conta_id},

                function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                        $( "div.dialog_sucesso" ).dialog({
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

                $(this).dialog("close");
                }
            });
        },
                    "Cancelar": function() {
                        $(this).dialog("close");
                }
             }
        });

            // Dialog Link
            $('#dialog_link').click(function(){
                    $('#dialog').dialog('open');
                    return false;
            });

               	$("#formulario").submit(function() {
		var usua_nome = $("#usua_nome").val();
		var usua_login = $("#usua_login").val();
		var usua_senha = $("#usua_permissao").val();
		var usua_permissao = $("#usua_senha").val();
		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('cad/usuario.php', {usua_nome: usua_nome,usua_login:usua_login,usua_senha:usua_senha,usua_permissao:usua_permissao}, function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                $(this).dialog("close");
                location.reload();
                }
            });
                $("#usua_nome").val("");
                $("#usua_login").val("");
                $("#usua_permissao").val("");
            });

        });
function formTeste()
{
    $("#teste").dialog({
            bgiframe: true,
            height: 140,
            modal: true,
            title: 'Mensagem do Sistema',
                buttons: {
                    "Não": function() {
                        $(this).dialog("close");
                },
                    "Sim": function() {
                        $(this).dialog("close");
                }
             }
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
			url 	: 'teste/deletaUsuario.php',
			data: 'id='+id,
			dataType: "text",
			type : "POST",
			success: function(data){
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

function detalhePaciente(){
var nome  = $('#nome').attr('value');
$("#dialogUsuario").dialog({
    bgiframe: true,
    autoOpen: false,
    height: 420,
    width: 860,
    modal: true,
    buttons: {
        'Salvar': function() {

                var nome = $("#nome").val();

		$("#status").html("<img src='loader.gif' alt='Enviando' />");
		$.post('cad/usuario.php', {id:id,nome: nome},
                function(resposta) {

                $("#status").slideDown();
                if (resposta != false) {
                    $("#status").html(resposta);
                    alert(resposta);

                } else {
                        $( "div.dialog_sucesso" ).dialog({
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

                $(this).dialog("close");
                }
            });
        },
        'Fechar': function() {
            $(this).dialog('close');
            location.href='';

        }

    },
    close: function() {
        location.href = "?";
        //			alert('asdsa');
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
		<div class="titulo">Contas</div>
                <p>
              <form class="jNice" name="menu" method="get">
                <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
                  <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Transferência Entre Contas</legend>
                  <hr />
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th scope="col">Conta</th>
                      <th scope="col">Valor</th>
                      <th  scope="col">Data</th>
                    </tr>
                    <?php
                        $result = $functions->getFechamentoDiario();
                        while($valorDario = mysql_fetch_array($result)) {
                        $cont++;
                        $id     = $valorDario["id"];
                        $nomebanco     = $valorDario["banco"];
                        $dinheiro    = $valorDario["valor"];
                        $usuario    = $valorDario["usua_login"];

                        $resultado = $functions->getCaixaPhysiosul();
                        while ($row = mysql_fetch_array($resultado)){
                            $contador ++;
                            $conta_id = $row["conta_id"];
                            $bancoNome = $row["banco"];
                        }

                        $dia = date('d');
                        $mes = date('m');
                        $ano = date('Y');
                        $data = "$dia/$mes/$ano";

                    ?>
                    <tr style="background-color:<? if ($cont % 2 == 0)
            echo "#FFFFFF"; else
            echo "#E6E7E9" ?>">
              <td><?php echo $bancoNome ?></td>
              <td><?php echo $functions->formata_Dinheiro($dinheiro) ?></td>
              <td><?php echo $data; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                  </table>
                  <fieldset class="botao">
                    <input type="submit" value="Transferir" id="dialog_link" style="cursor:pointer;" />
                  </fieldset>

                                    <hr />
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th scope="col">Banco</th>
                      <th scope="col">Conta</th>
                      <th scope="col">Número</th>
                      <th class="acoes" scope="col">Valor</th>
                    </tr>
                    <?php
                        $result = $functions->getConta();
                        while($valorDario = mysql_fetch_array($result)) {
                        $cont++;
                        $id     = $valorDario["id"];
                        $banco     = $valorDario["banco"];
                        $conta    = $valorDario["conta"];
                        $numero    = $valorDario["numero"];
                        $valor_dinheiro    = $valorDario["valor"];
                    ?>
                    <tr style="background-color:<? if ($cont % 2 == 0)
            echo "#FFFFFF"; else
            echo "#E6E7E9" ?>">
              <td><?php echo $banco ?></td>
              <td><?php echo $conta ?></td>
              <td><?php echo $numero; ?></td>
              <td><?php echo $functions->formata_Dinheiro($valor_dinheiro) ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                  </table>

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
    <hr class="noscreen" />
    <!-- Footer -->
    <div id="rodape">
      <p class="left">&copy; 2012 - Sistema de Caixa Physiosul - Todos os Direitos Reservados</p>
    </div>
    <!-- Footer end -->
  </div>
</div>
<div id="dialog" title="Transferência entre Contas">
  <form id="formulario" action="javascript:func()" method="post">
    <label>Conta de origem:</label>
    <input name="conta_origem" type="text" id="conta_origem" size="20" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; "
           value=<?php echo $bancoNome ?> />
    <p>
      <label>Conta de Destino:</label>
                <select name="conta_id" id="conta_id" class="select" style="padding:3px; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; ">
                  <option value="">Selecione</option>
                  <?php
                        $result = $functions->getConta();

                        while($valor = mysql_fetch_array($result)) {
                        $conta_id     = $valor["conta_id"];
                        $banco = $valor["banco"];
                        $conta = $valor["conta"];
                        $numero = $valor["numero"];
                        //echo "<option value=\"$caixa_id\" name=\"$caixa_id\" id=\"$caixa_id\">$caixa_nome</option>\n";
                    //}
                    ?>
                  <option value="<?= $valor['conta_id'] ?>">
                  <?= $banco . ' - ' . $conta . ' - ' . $numero ?>
                  </option>
                  <? } ?>
                </select>
<p>
    <label>Valor: R$</label>
    <input name="valor" type="" id="valor" size="10" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; "
           value="<?php echo $dinheiro ?>" />
</p>
      <?php
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        $data = "$dia/$mes/$ano";
        ?>
      Data:
      <input type="text" disabled name="data" size="11" maxlength="10" id="data" value ="<?= $data ?>" style="padding:3px; color:#999; margin-bottom:10px;border-style:solid;border-width:2;border-color:#7AC6E7; " />
      <input type="hidden" name="data" value="<?= $data ?>"/>

</p>

  </form>
    <div id="deletar" title="Mensagem do Sistema" style="display:none">Tem certeza de que deseja excluir o usuário? </div>
    <div class="dialog" style="display:none" title="Mensagem do Sistema"><img src="image/sucesso.png" alt="Carregando" /> Usuário Deletado com Sucesso!</div>
    <div id="dialogUsuario" title="Dados do Usuário"> </div>
    <div class="dialog_sucesso" style="display:none" title="Mensagem do Sistema"><img src="image/sucesso.png" alt="Carregando" /> Usuário Cadastrado com Sucesso!</div>

</div>
</body>
</html>
