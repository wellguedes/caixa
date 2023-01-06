<?php
$mysqli = new mysqli('localhost', 'root', '', 'caixa');
$text = $mysqli->real_escape_string($_GET['term']);

$query = "SELECT distinct banco_nome FROM lc_movimento WHERE banco_nome LIKE '%$text%' ORDER BY banco_nome ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['banco_nome'].'"}';
}
$json .= ']';
echo $json;
?>