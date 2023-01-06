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

$stilo = "style = 'font-weight:bold;'";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
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
<style type="text/css">
#movimento{
font-size: 20px;
border: 1px solid #999;
-moz-border-radius: 10px; /* Para Firefox */
-webkit-border-radius: 10px; /*Para Safari e Chrome */
border-radius: 10px; /* Para Opera 10.5+*/
position:absolute;
width:300px;
top:140px;
margin-left:17px;
padding:5px;
text-align: center;
margin-top: 10px;

}

#mes{
font-size: 20px;
border: 1px solid #999;
-moz-border-radius: 10px; /* Para Firefox */
-webkit-border-radius: 10px; /*Para Safari e Chrome */
border-radius: 10px; /* Para Opera 10.5+*/
text-align: center;
margin-top: 45px;
width: 700px;
margin-left: 15px;
}
#data{
margin-left: 400px;
border: 1px solid #999;
-moz-border-radius: 10px; /* Para Firefox */
-webkit-border-radius: 10px; /*Para Safari e Chrome */
border-radius: 10px; /* Para Opera 10.5+*/
padding:5px;
padding-top: 20px;
font-size: 10px;
text-align: center;
margin-right: 19px;
margin-top: 10px;
}

#total{
 border: 1px solid #999;
-moz-border-radius: 10px; /* Para Firefox */
-webkit-border-radius: 10px; /*Para Safari e Chrome */
border-radius: 10px; /* Para Opera 10.5+*/
padding-bottom: inherit;

}

#tabela{
font-size: 20px;
width: 700px;
margin-top: 10px;
margin-left: 15px;
}

#totalDia{
width: 700px;
border: 0px;
margin-left: 15px;
}
</style>
<script type="text/javascript">

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
		<div class="titulo">Relatório</div>
                <p>
              <form class="jNice" name="menu" method="get">
                <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
                  <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Relatório Análitico Diário</legend>
                  <div id="total">
                  <div id="movimento">
                      MOVIMENTO DO CAIXA
                  </div>
                  <div id="data">
                      <?php
                        $dia = date('d/m/Y');
                        $m = date('m');
                        $mes = $functions->mes_extenso($m);

                      ?>
                      DATA: <?php echo $dia ?>
                  </div>
                  <div id="mes">
                      <?php echo $mes ?>
                  </div>
                  <div id ="tabela">
                  <table class="table"border="1">
                  <tr align="center">
                    <td>HISTÓRICO</td>
                    <td>&nbsp;</td>
                    <td>ENTRADAS</td>
                    <td>SAÍDAS</td>
                  </tr>
                  <?php
                    $analitico = $functions->retornaDiaAnalitico();
                    while($l = mysql_fetch_array($analitico)) {
                     //echo "<pre>";print_r($l);echo "</pre>";
                    $nome = $l['nome'];
                    $nome = strtoupper($nome);
                    $entrou = $l['entrada'];
                    $saiu = $l['saida'];
                    $tipo= $l['tipo'];
                    $referente = $l['referente'];
                    $entrou = $functions->formata_Dinheiro($entrou);
                    $saiu = $functions->formata_Dinheiro($saiu);
                
                    if ($entrou == 'R$ 0,00'){
                        $entrou = "";
                    }


                    if ($saiu == 'R$ 0,00'){
                        $saiu = "";
                    }

                    if($tipo == 1){
                        $entrou = '<span style="color:#000;font-weight: bold;"> + '.$entrou.' </span>';
                    } elseif($tipo == 0){
                        $saiu = '<span style="color:#C00;font-weight: bold;"> - '.$saiu.' </span>';
                    }
                    echo "<tr>";
                    echo "<td>". utf8_decode($nome)."</td>";
                    echo "<td></td>";
                    echo "<td align='center'>$entrou</td>";
                    echo "<td align='center'>$saiu</td>";
                    echo "</tr>";

                }
                 ?>
                </table>
                  </div>
                      <div id="totalDia">
                          <table>
                              <tr>
                                  <td width="49%" <?php echo $stilo ?>>TOTAIS POR DIA</td>
                            <?php
                              $totalDia =  $functions->retornaDiaAnaliticoEntrada();
                                while($l = mysql_fetch_array($totalDia)) {
                                    $tDia = $l['total'];
                                    $tipoDia = $l['tipo'];
                                    $tDia1 = $functions->formata_Dinheiro($tDia);
                                    if($tDia == 0){
                                        $tDia1 = '<span style="color:#000;font-weight: bold;"> '.$tDia1.' </span>';
                                    } elseif($tDia < 0){
                                        $tDia1 = '<span style="color:#C00;font-weight: bold;"> - '.$tDia1.' </span>';
                                    } elseif ($tDia > 0){
                                        $tDia1 = '<span style="color:#000;font-weight: bold;"> + '.$tDia1.' </span>';
                                    }
                                    echo "<td align='center' width='25%'>$tDia1</td>";
                                    }
                             ?>
                            <?php
                              $totalDiaS =  $functions->retornaDiaAnaliticoSaida();
                                while($l = mysql_fetch_array($totalDiaS)) {
                                    $tDiaS = $l['total'];
                                    $tipoSaida = $l['tipo'];
                                    $tDiaS1 = $functions->formata_Dinheiro($tDiaS);
                                if($tipoSaida == 0){
                                    $tDiaS1 = '<span style="color:#C00;font-weight: bold;"> - '.$tDiaS1.' </span>';
                                }
                                echo "<td align='center'>$tDiaS1</td>";
                            }
                             ?>
                              </tr>
                          </table>

                          <table>
                              <tr>
                                  <td width="49%" <?php echo $stilo ?>>SALDO ANTERIOR</td>
                                <?php
                                    $entrada = $functions->getEntradaClinicaMenosDia();
                                    while($valor = mysql_fetch_array($entrada)) {
                                         //echo "<pre>";print_r($valor);echo "</pre>";

                                        $entrouDia = $valor['total'];
                                    }

                                    $saida = $functions->getSaidaClinicaMenosDia();
                                    while($valor = mysql_fetch_array($saida)) {
                                         //echo "<pre>";print_r($valor);echo "</pre>";
                                        $saiuDia = $valor['total'];
                                    }

                                    $resultado = $entrouDia - $saiuDia;
                                    $resultado1 = $functions->formata_Dinheiro($resultado);
                                    echo "<td align='center'>$resultado1</td>";
                                ?>
                              </tr>
                          </table>
                      
                          <table>
                              <tr>
                                  <td width="49%" <?php echo $stilo ?>>SALDO ATUAL</td>
                            <?php
                                    $saldoAtual = $resultado + $tDia;
                                    $saldoAtual1 = $functions->formata_Dinheiro($saldoAtual);
                                    if ($saldoAtual < 0){
                                        $saldoAtual1 = '<span style="color:#C00;font-weight: bold;"> - '.$saldoAtual1.' </span>';
                                    } else if($saldoAtual >= 0){
                                        $saldoAtual1 = '<span style="color:#000000;font-weight: bold;"> + '.$saldoAtual1.' </span>';
                                    }
                                    echo "<td align='center'>$saldoAtual1</td>";
                             ?>
                              </tr>
                          </table>

                          <table>
                              <tr>
                                  <td width="49%"<?php echo $stilo ?>>PARA CONFERÊNCIA</td>
                            <?php
                                    $saldoConferencia = $saldoAtual - $tDiaS;
                                    $saldoConferencia1 = $functions->formata_Dinheiro($saldoConferencia);
                                    if ($saldoConferencia < 0){
                                        $saldoConferencia1 = '<span style="color:#C00;font-weight: bold;"> - '.$saldoConferencia1.' </span>';
                                    } else if($saldoConferencia >= 0){
                                        $saldoConferencia1 = '<span style="color:#000000;font-weight: bold;"> + '.$saldoConferencia1.' </span>';
                                    }
                                    echo "<td align='center'>$saldoConferencia1</td>";
                             ?>
                              </tr>
                          </table>
                    </div>
                      </div>
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
</body>
</html>
