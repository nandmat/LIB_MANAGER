<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="https://kit.fontawesome.com/a91a789ba3.js" crossorigin="anonymous"></script>
    <title>Login - Lib Manager</title>
</head>

<body>

    <main class="container">
        <form class="container-formulario" action="" method="post">
            <h1 class="titulo">Lib Manager</h1>
            <h2 class="sub-titulo">Login</h2>

            <div class="container_input">
                <input id="txtCpf" oninput="mascaraCPF(this)" type="text" name="cpf">
            </div>
            <div class="container_input">
                <input id="password" type="password" name="senha">
                <i id="olho" class="fa-solid fa-eye olho"></i>
            </div>
            <label class="salvar_senha">
                <input type="checkbox" />
                Me mantenha conectado
            </label>
            <button class="btn-entrar" type="submit">Logar</button>
        </form>
    </main>


    <!-- JS Local -->
    <script src="./assets/js/login.js"></script>

    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>



<!-- PHP  -->
<?php

if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    include('conexao.php');

    $sql_code = "SELECT * FROM tbl_usuario WHERE cpf_usuario = '$cpf' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();
    if (password_verify($senha, $usuario['senha_usuario'])) {
        if (!isset($_SESSION))
            session_start();
        $_SESSION['usuario'] = $usuario['id_usuario'];
        header("Location: home.php");
    } else {

?>
        <script type="text/javascript">
            Swal.fire({

                title: 'Acesso Negado',
                text: 'Socorro!!!! Aministrador!!!!',
                imageUrl: 'https://media.tenor.com/6Njik3Yk4DEAAAAC/esqueceram-de.gif',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            });
        </script>
<?php
    }
}

?>