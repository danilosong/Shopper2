<?php
// A sessão precisa ser iniciada em cada página diferente
session_start();
?>

<?php
$nivel_necessario = 0;
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ( $_SESSION['UsuarioNivel'] < $nivel_necessario)) {
    exit;
}
?>
<?php 

if(empty($_SESSION['UsuarioImagem']))
{
    $imagem = "beta.png";
    $_SESSION['UsuarioImagem'] = $imagem;
    echo "<img src='fotos/" . $imagem . "' alt='Foto de Exibição' class='profile-img-card'/>";
}
else
echo "<img src='fotos/" . $_SESSION['UsuarioImagem'] . "' alt='Foto de Exibição' class='profile-img-card'/>";
?>

<?php
require 'conexao.php';
$consulta_coment = mysqli_query($conn, "SELECT id, NOME, IMG, COMENTARIO, CRIACAO , MOD_CRIACAO,id_coment FROM usuario right JOIN comentario on usuario.id = comentario.id_fk;")
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <title>Comentários Beta Labs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="estilos/comentarios.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
    <style type="text/css">
        body{ background: #fafafa;}
        body .no-padding {
        padding: 0;
}
    </style>
           <link rel="stylesheet" type="text/css" href="estilos/msgbox.css" />
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Comentários</h3>
                </div>
            </div>

            <!-- INICIO -->
            <form id="Editar" name="Editar" method="get" action="edit.php">
             <div class="rolagem2">
            <?php
            while ($consulta = mysqli_fetch_array($consulta_coment)) {
                ?>
                <div class="row">
                    <div class="col-sm-1">
                        <div class=".profile-img-card2">
                            <img class='profile-img-card2' <?php echo "src='fotos/" . $consulta['IMG'] . "'" ?>/>
                        </div>
                    </div>
                    <?php
                    // Invertendo a data
                    $data = $consulta['CRIACAO'];

                    ?>
                    <div class="col-sm-5 col-lg-offset-0">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong><?php echo $consulta['NOME']; ?></strong> <span class="text-muted">Comentado em <?php echo date('d/m/Y H:i:s', strtotime($data)); ?></span>
                            </div>
                            <div class="panel-body rolagem"><i><?php echo wordwrap($consulta['COMENTARIO'],50, "<br />\n", true);?></i></div>
                        </div>
                        <?php
                        // botao
                        $user = $_SESSION['UsuarioNivel'];
                        $iduser = $consulta['id'];

                         if (empty($user)) {
                        $_SESSION['UsuarioID'] = 0;
                                          }

                        else if ($iduser == $_SESSION['UsuarioID'] || $_SESSION['UsuarioNivel'] == 2) {
                            ?>
                            <div class="col-sm-2 col-lg-offset-0">
                            <button id="edit_msg" name="edit_msg" class="btn btn-success" type="submit">Editar</button>
                            </div>
                            <?php
                        } else {
                            ?>
                        <?php } ?>
                       
                        <?php
                        $user = $_SESSION['UsuarioNivel'];

                        if (empty($user)) {
                            $_SESSION['UsuarioNivel'] = 0;
                        }
                        if ($_SESSION['UsuarioNivel'] == 2) {
                            ?>
                            <div class="col-sm-5 col-lg-offset-0">
                            <button id="del_msg" name="del_msg" class="btn btn-danger">Apagar</button>
                            </div>
                            <?php
                        } else {
                            ?>
                        <?php } ?>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
        </form>
        </div>
        </div>
        <script type="text/javascript"></script>

        <!-- COMENTARIOS -->

        <div class="container">
            <div class="row">
                <div class="span6">
				<div class="widget-area no-padding blank">
                   <div class="status-upload">
                    <form id="msg" name="msg" method="post" action="inserir_comentario.php">
            <?php
                if($_SESSION['UsuarioNivel'] == 1 || $_SESSION['UsuarioNivel'] == 2){
            ?>
                    
						
                			<textarea placeholder="Digite seu comentario..." id="msg_coment" name="msg_coment"></textarea>
							<button type="submit" class="btn btn-success green"><em class="fa fa-share"></em> Enviar</button>
                		</div>                 
                </div>
            </div>
            <?php }
            else
            {
            ?>
            <?php }?>

        </form>
          </div>
		</div>
    </div>
</body>
</html>