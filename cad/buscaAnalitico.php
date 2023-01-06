<?php
header("Content-Type: text/html; charset=ISO-8859-1",true) ;
?>
<style type="text/css">
#movimento{
font-size: 18px;
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
margin-top: 275px;

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
margin-bottom: 10px;
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

div.pop-up {
  display: none;
  text-align: left;
  position: absolute;
  margin-top: -100px;
  width: 300px;
  padding: 0px 13px;
  background: #FFFFFF;
  color: #000000;
  border: 1px solid #1a1a1a;
  font-size: 10px;
  margin-left: 80px;
}

a {
  text-decoration: none;
  color:#000;

}

 a:hover {
  cursor:default ;
color:#000;

 }

 a:visited
{
color:#000;
}
 a:active
{
background-color:#000;
}

</style>
   <script type="text/javascript">
      $(document).ready(function() {
        //If Javascript is running, change css on product-description to display:block
        //then hide the div, ready to animate
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
      });
    </script>
<?php

include '../functions.php';

$functions = new functions();

$date = $_POST['date'];
$data1 = $_POST['data1'];
$caixa_id = $_POST['caixa_id'];
$ordem = $_POST['ordem'];

$date = $functions->datasql($date);
$data1 = $functions->datasql($data1);

$sql = "SELECT tipo, nome, referente,usua_nome,
            CASE tipo
            WHEN 1 THEN Valor
            END as entrada,
            CASE tipo
            WHEN 0 THEN Valor
            END as saida
            FROM lc_movimento
            left join lc_usuario on (lc_movimento.usua_id_inc = lc_usuario.id)
            Where data = '".$date."'
            and caixa_id = ".$caixa_id."
            Order by data_hora_inc";

$executa = mysql_query($sql);

$entrada = "SELECT tipo, sum(valor) as total
            FROM lc_movimento
            Where data = '".$date."'
            AND tipo = 1
            and caixa_id = ".$caixa_id;
$executaEntrada = mysql_query($entrada);

$saida = "SELECT tipo, sum(valor) as total
            FROM lc_movimento
            Where data = '".$date."'
            AND tipo = 0
            and caixa_id = ".$caixa_id;
$executaSaida = mysql_query($saida);

$dia = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = ".$caixa_id." and data < '$date'";
$executaDia = mysql_query($dia);

$diaS = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = ".$caixa_id." and data < '$date'";
$executaDiaS = mysql_query($diaS);


$total_rows = mysql_num_rows($executa);

    if ($total_rows < 0) {

        echo "Nenhum resultado encontrado";
    } else { ?>

              <form class="jNice" name="menu" method="get">
                <fieldset style="padding:20px; border:1px solid #e1e1e1; margin:0px 0px 10px 0px">
                  <legend style="padding:10px; background-color:#f5f5f5; border:1px solid #e1e1e1; margin: 0px 0px 10px 0px">Relatório Análitico Diário</legend>
                  <div id="total">
                  <div id="movimento">
                      <?php
                        if ($caixa_id == 1){
                            $caixa = "CLÍNICA";
                        } elseif ($caixa_id == 2) {
                            $caixa = "LOJA";
                        } elseif ($caixa_id == 3) {
                            $caixa = "LEANDRO";
                        } elseif ($caixa_id == 4) {
                            $caixa = "ACADEMIA";
                        } else{
                            $caixa = "PILATES";
                        }
                      ?>
                      MOVIMENTO DO CAIXA <?php echo $caixa ?>
                  </div>
                  <div id="data">
                      <?php
                       $date = implode("/",array_reverse(explode("-",$date)));
                        $m =  $date[3] . $date[4];
                        $mes = $functions->mes_extenso($m);

                      ?>
                      DATA: <?php
                       $date = implode("/",array_reverse(explode("-",$date)));
                      echo $date ?>
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
                    while($l = mysql_fetch_array($executa)) {
                     //echo "<pre>";print_r($l);echo "</pre>";
                    $nome = $l['nome'];
                    $nome = mb_strtoupper(utf8_decode($nome));
                    $entrou = $l['entrada'];
                    $saiu = $l['saida'];
                    $tipo= $l['tipo'];
                    $referente = $l['referente'];
                    $pagamento = $l['pag_id'];
                    $usuario = $l['usua_nome'];
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
					/*
                    echo "<tr>";
                    echo "<td>$nome</td>";
                    echo "<td></td>";
                    echo "<td align='center'>$entrou</td>";
                    echo "<td align='center'>$saiu</td>";
                    echo "</tr>";
					*/

                
                 ?>
				 
			  <div class="profile">
            <tr>
                <td>
        <div class="pop-up">
          <p>
		  <?php
			$tipo = $tipo == 1 ? "Receita" : "Despesa";
			$pagamento = $pagamento == 1 ? "Dinheiro" : "Cheque";
			
			if ($tipo == "Receita"){
				$valor = $entrou;

			} else {

				$valor = $saiu;
			}

		  ?>
            Valor: <?php echo $valor ?><br />
            Referente à: <?php echo utf8_decode($referente) ?><br />
            Tipo: <?php echo $tipo ?><br />
            Pagamento: <?php echo $pagamento ?><br />
            Atendente: <?php echo $usuario ?><br />
          </p>
        </div>

        <a href="#" class="trigger">
              <span class="name"><?php echo ($nome) ?></span>
        </a>
                </td>
			<td align='center'></td>
			<td align='center'><?php echo $entrou ?></td>
            <td align='center'><?php echo $saiu ?></td>

            </tr>
        <!-- Show the hidden div on hover -->
      </div>    
	  
	  <?php } ?>
                </table>
                  </div>        
                      <div id="totalDia">
                          <table>
                              <tr>
                                  <td width="49%" <?php echo $stilo ?>>TOTAIS POR DIA</td>
                            <?php
                              $totalDia =  $executaEntrada;
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
                              $totalDiaS =  $executaSaida;
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
                                    $entrada = $executaDia;
                                    while($valor = mysql_fetch_array($entrada)) {
                                         //echo "<pre>";print_r($valor);echo "</pre>";

                                        $entrouDia = $valor['total'];
                                    }

                                    $saida = $executaDiaS;
                                    while($valor = mysql_fetch_array($saida)) {
                                         //echo "<pre>";print_r($valor);echo "</pre>";
                                        $saiuDia = $valor['total'];
                                    }

                                    $resultado = $entrouDia - $saiuDia;
                                    $resultado1 = $functions->formata_Dinheiro($resultado);
                                    echo '<td align="center"><span style="color:#006400;font-weight: bold;">'.$resultado1.'</span> </td>';

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

  <?php  } ?>
