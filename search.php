<?php
$mysqli = new mysqli('localhost', 'root', '', 'caixa');

$text = $mysqli->real_escape_string($_GET['term']);

$query = "SELECT distinct nome FROM lc_paciente WHERE nome LIKE '$text%' ORDER BY nome ASC";

$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['nome'].'"}';
}
$json .= ']';
echo $json;
?>