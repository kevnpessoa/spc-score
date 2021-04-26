<?php 

require_once('./ConsultaSPCService.php');

$spc = new ConsultaSPCService('00752477714');

//$result = $spc->consulta();
$result = $spc->consultaScore();
//$result = $spc->listaProdutos();

echo json_encode($result);