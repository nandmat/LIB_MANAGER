<?php

include('conexao.php');
$id = intval($_GET['id']);

$sqlLivro = $mysqli->query("SELECT * FROM tbl_livro WHERE id_livro = '$id'") or die($mysqli->error);
if ($sqlLivro->num_rows != 0) {
    $livro = $sqlLivro->fetch_assoc();
    $id_autor = $livro['id_autor'];
    $id_editora = $livro['id_editora'];

    $sqlAutor = $mysqli->query("SELECT * FROM tbl_autor WHERE id_autor = '$id_autor'");
    $sqlEditora = $mysqli->query("SELECT * FROM tbl_editora WHERE id_editora = '$id_editora'");

    if ($sqlAutor->num_rows != 0) {
        $tbl_autor = $sqlAutor->fetch_assoc();
    }
    if ($sqlEditora->num_rows != 0) {
        $tbl_editora = $sqlEditora->fetch_assoc();
    }
}

if (isset($_POST['reservar_livro'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $error = false;
    if (empty($cpf)) {
        $error = 'Informe seu CPF!';
        return;
    }

    if (empty($senha)) {
        $error = 'Informe sua senha!';
        return;
    } else {
        $consultaCpf = $mysqli->query("SELECT senha_usuario FROM tbl_usuario WHERE cpf_usuario = '$cpf'");
        if($consultaCpf->num_rows > 0) {
            $pesquisaSenhaDb = $consultaCpf->fetch_assoc();
            if(password_verify($senha, $pesquisaSenhaDb['senha_usuario'])){

                $mysqli->query("UPDATE tbl_livro SET
                status = 'reservado'
                WHERE id_livro = $id");

                $mysqli->query("INSERT INTO tbl_emprestimo (id_livro, cpf_aluno, status, data_emprestimo)
                VALUES ('$id', '$cpf', 'ativo', NOW())");
                echo 'livro reservado';
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header class="header">
    <a href="home.php">voltar pro home</a>
</header>

<body>


    <div class="card">
        <div>

            <h2 class="card-title"><?php echo $livro['titulo'] ?></h2>
        </div>
        <img src="<?php echo $livro['path'] ?>" alt="<?php echo $livro['titulo'] ?>" />

        <div class="card-desc">
            <p>Livro: <?php echo $livro['titulo'] ?></p>
            <p>Autor: <?php echo $tbl_autor['nome_autor'] . ' ' . $tbl_autor['sobrenome_autor'] ?></p>
            <p>Editora: <?php echo $tbl_editora['nome_editora'] ?></p>
            <p>Gênero: <?php echo $livro['assunto'] ?></p>
            <p>ISBN: <?php echo $livro['isbn'] ?></p>
        </div>

        <form method="post">
            <p>
                <label>CPF: </label>
                <input type="text" name="cpf">
            </p>
            <p>
                <label>Digite sua senha: </label>
                <input type="password" name="senha">
            </p>
            <button class="buttonClass" type="submit" name="reservar_livro">Reservar Livro</button>
        </form>
</body>

</html>