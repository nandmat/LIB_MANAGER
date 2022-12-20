<?php 

include('conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario']))
    die('Você não está logado. <a href="sistema_login.php">Clique aqui</a> para logar.');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Lib Manager</h1>
        <nav>
            <ul>
                <li><a href="#">Cadastrar Livro</a></li>
                <li><a href="cadastrar_funcionario.php">Cadastrar Funcionário</a></li>
                <li><a href="index.php">Pesquisar Livros</a></li>
                <li><a href="sistema_logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <h1>aqui</h1>
</body>
</html>