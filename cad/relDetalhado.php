<?php
 ob_start();
//Fazemos a conexão com o mysql, coloque os dados de acesso do seu servidor 

include '../config/conn.php';
$caixa_id = $_POST['caixa_id'];
$sql = "SELECT *
        FROM lc_movimento
        Join lc_caixa using(caixa_id)
        ORDER BY data";
//Executamos a query
$query = mysql_query($sql) or die(mysql_error());
//Verificamos se retornou algum valor
if(mysql_num_rows($query)==0){
echo "<h2>Nenhum resultado encontrado</h2>";
}
else{
//Caso retornar algum valor então criamos a tabela HTML e inserimos os dados
//Cabeçalho a tabela 
$html = "";
$html .= "<Table align='center' border='01'>";
$html .= "<tr style='background:#FFFF00;font-weight:bold;font-family:Arial;font-size:15px;'><td  colspan='6' align='center'>RELATÓRIO ANALITÍCO DE CAIXAS $caixa_id</td></tr>
$html </Table>";
$html .= "<table border='01'>";
$html .= "<tr style='font-weight:bold;'>";
$html .= "<td>NOME DO CLIENTE</td>";
$html .= "<td>CAIXA</td>";
$html.= "<td>VALOR</td>";
$html .= "<td>DATA</td>";
$html .= "<td>FORMA PAGAMENTO</td>";
$html .= "<td>REFERENTE</td>";
$html .= "<td>TIPO</td>";
$html .= "</tr>";

//Atribuindo os resultados em um array
while($resultados = mysql_fetch_array($query)){
$nome = $resultados["nome"];
$caixa_nome = $resultados["caixa_nome"];
$valor = $resultados["valor"];
$data = $resultados["data"];
$pag_id = $resultados["pag_id"];
$referente = $resultados['referente'];
$tipo = $resultados['tipo'] == 1 ? "Receita" : "Despesa";


$pag_id = $pag_id == 1 ? "Dinheiro" : "Cheque";

//Criamos as linhas restantes da tabela com os valores das variáveis
$html.= "<tr style='background:#F0F0F0;height:30px;'>";
$html.= "<td>$nome</td>";
$html.= "<td>$caixa_nome</td>";
$html.= "<td>R$ $valor</td>";
$html.= "<td>$caixa_id</td>";
$html.= "<td>$pag_id</td>";
$html.= "<td>$referente</td>";
$html.= "<td>$tipo</td>";
$html.= "</tr>";
//Fechamos o laço while
}
//Fechamos a tabela 
echo "</table>";

//Criamos os headers para forçar o download do arquivo
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header("Content-type: application/msexcel");
}
header("Content-Disposition: attachment; filename=detalhamento.xls");
echo $html;

mysql_close();

//Aqui  no primeiro header definimos o tipo do arquivo
header('Content-type: application/msexcel');
//Neste header definimos como será gravado e o nome do arquivo
header('Content-Disposition: attachment; filename="relatorio_caixas.xls"');
//Criamos uma tabela em HTML normal
/*
echo "<table>";
echo "<tr>";
echo "<td>COLUNA 1</td>";
echo "<td>COLUNA 2</td>";
echo "</tr>";
echo "<tr>";
echo "<td>1</td>";
echo "<td>2</td>";
echo "</tr>";
echo "</table>";
 * 
 */
?>
