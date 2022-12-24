<?php 

if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    include('conexao.php');

    $sql_code = "SELECT * FROM tbl_usuario WHERE cpf_usuario = '$cpf' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();
    if(password_verify($senha, $usuario['senha_usuario'])){
        if(!isset($_SESSION))
            session_start();
        $_SESSION['usuario'] = $usuario['id_usuario'];
        header("Location: home.php");
    } else {
        echo 'falha ao logar, usuário ou senha incorretos';
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=form, initial-scale=1.0">
    <title>Login - Lib Manager</title>
</head>
<body>
    <header>
        <h1>Login - Lib Manager</h1>
    </header>
    <main>
    <form action="" method="post">
        <h1>Entre com seu usuário e senha:</h1>
        <p>
            <label for="">CPF</label>
            <input type="text" name="cpf">
        </p>
        <p>
            <label for="">Senha</label>
            <input type="password" name="senha">
        </p>
        <button type="submit">Logar</button>
    </form>
    </main>
</body>
</html>