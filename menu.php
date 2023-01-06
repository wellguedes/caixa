<?php
require_once("config/conn.php");

$functions = new functions();

$objLogin = new Login();

if (!$objLogin->verificar('login.php'))
    exit;

$query = mysql_query("SELECT id, usua_nome, usua_permissao FROM lc_usuario WHERE id = {$objLogin->getID()}");
$row = mysql_fetch_object($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link type="text/css" href="css/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="js/menu.js"></script>
</head>
<body>


    <div id="menu">
      <ul class="menu">
        <li><a href="index.php" class="parent"><span>Caixas</span></a>
          <ul>
            <li><a href="index.php" class=""><span>Clínica</span></a></li>
            <li><a href="loja.php"><span>Loja</span></a></li>
            <li><a href="leandro.php"><span>Leandro</span></a></li>
            <li><a href="academia.php"><span>Academia</span></a></li>
            <li><a href="pilates.php"><span>Pilates</span></a></li>
          </ul>
        </li>
        <li><a href="#" class="parent"><span>Cadastros</span></a>
          <ul>
            <li><a href="paciente.php"><span>Pacientes</span></a></li>
            <?php if ($row->usua_permissao == 1){ ?>

            <li><a href="transferencia.php"><span>Transferência Entre Contas</span></a></li>
            <li><a href="categoria.php" class=""><span>Categorias</span></a></li>
            <li><a href="usuario.php" class=""><span>Usuários</span></a></li>
            <li><a href="#"><span>Contas</span></a></li>
			<?php } ?>
          </ul>
        </li>
        <li><a href="#"><span>Relatórios</span></a>
        <ul>
            <li><a href="relAnaliticoDiario.php"><span>Relatório Análitico Diário</span></a></li>
            <li><a href="relAnaliticoClinica.php"><span>Relatório Análitico Clinica</span></a></li>
		            <?php if ($row->usua_permissao == 1){ ?>

            <li><a href="relBalanco.php"><span>Balanço</span></a></li>
            <li><a href="detalhamento.php"><span>Detalhamento</span></a></li>
	<?php } ?>
        </ul>
        </li>
      </ul>
    </div>
    <div id="copyright"><a href="http://apycom.com/"></a></div>
</body>
</html>