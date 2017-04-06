<?php

session_start();
require 'conexao.php';

$id = $_SESSION['UsuarioID'];
$msg = $_POST['msg_coment'];

$query = mysqli_query($conn, "INSERT INTO comentario (COMENTARIO, CRIACAO, MOD_CRIACAO,id_coment, id_fk) VALUES('" . $msg . "', now(), now(),'', '" . $id . "')");
$_SESSION['coment'] = $msg;
?>

<?php
echo '<meta http-equiv="refresh" content="0, URL=comentarios.php">';
?>