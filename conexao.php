<?php
//ajustar a configuracao do banco de dados
$conn = mysqli_connect("localhost", "root", "");

// nao ajustar a partir dessa linha
mysqli_select_db($conn,"cadastro") or die (mysqli_error('Até logo'));

?>