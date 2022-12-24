<?php

include('conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario']))
    die(header("Location: redirecionar_login.php"));

if(isset($_POST['enviar'])){

    $titulo = $_POST['titulo'];
    $edicao = $_POST['edicao'];
    $isbn = $_POST['isbn'];
    $assunto = $_POST['assunto'];
    $editora = $_POST['editora'];
    $nome_autor = $_POST['nome_autor'];
    $sobrenome_autor = $_POST['sobrenome_autor'];

    $error = false;
    if(empty($titulo)){
        $error = "Digite o título do livro";
    }
    if(empty($edicao)){
        $error = "Digite a edição do livro";
    }
    if(empty($isbn)){
        $error = "Digite o ISBN do livro";
    }
    if(empty($assunto)){
        $error = "Digite o assunto do livro";
    }
    if(empty($nome_autor) && empty($sobrenome_autor)){
        $error = "Preencha as informações do autor";
    } else{
        $query = $mysqli->query("SELECT * FROM tbl_autor WHERE nome_autor = '$nome_autor' AND sobrenome_autor = '$sobrenome_autor'");
        $dados_autor = $query->fetch_assoc();
        if(!empty($dados_autor['nome_autor']) && !empty($dados_autor['sobrenome_autor'])){
            $id_autor = $dados_autor['id_autor'];
        } else {
            $query = $mysqli->query("INSERT INTO tbl_autor (nome_autor, sobrenome_autor) VALUES ('$nome_autor', '$sobrenome_autor')");
            $query = $mysqli->query("SELECT * FROM tbl_autor WHERE nome_autor = '$nome_autor' AND sobrenome_autor = '$sobrenome_autor';");
            $dados_autor = $query->fetch_assoc();
            $id_autor = $dados_autor['id_autor'];
        }
    }
    if(empty($editora) && strlen($editora) < 1){
        $error = "Preencha as informações da editora";
    } elseif(!empty($editora) && strlen($editora) > 0){
        $query = $mysqli->query("SELECT * FROM tbl_editora WHERE nome_editora = '$editora'");
        $dados_editora = $query->fetch_assoc();
        if(!empty($dados_editora['nome_editora'])){
            $id_editora = $dados_editora['id_editora'];
        } else {
            $query = $mysqli->query("INSERT INTO tbl_editora (nome_editora) VALUES ('$editora')");
            $query = $mysqli->query("SELECT * FROM tbl_editora WHERE nome_editora = '$editora'");
            $dados_editora = $query->fetch_assoc();
            $id_editora = $dados_editora['id_editora'];
        }
    }

    if(isset($_FILES['arquivo'])){
        $arquivo = $_FILES['arquivo'];
    
        if($arquivo['error']){
            die("Falha ao enviar arquivo");
        }
    
        if($arquivo['size'] > 2097152)
            die("O Tamanho do arquivo não pode ultrapssar 2MB");
    
        $pasta = "capas/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        if($extensao != 'jpg' && $extensao != 'png')
            die("Tipo de arquivo não aceito. Tipos permitidos: jpg e png");
    
        $path = $pasta . $novoNomeArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);
    }

    if($error){
        echo "<p><b>$error</b></p>";
    } else {
        $query = $mysqli->query("INSERT INTO tbl_livro (titulo, edicao, isbn, assunto, situacao, id_autor, id_editora, path) 
        VALUES ('$titulo', '$edicao', '$isbn', '$assunto', 1, $id_autor, $id_editora, '$path')") or die ($mysqli->error);
        if($query){
            echo "<p><b>Cadastro realizado com sucesso!</b></p>";
            unset($_POST);
        }else{
            echo "Erro!, livro não cadastrado!</b></p>";
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
    <title>Cadastrar Livros - Lib Manager</title>
</head>
<body>
    <header>
        <h1>Cadastrar Livros</h1>
        <nav>
            <ul>
                <li><a href="cadastrar_livros.php">Cadastrar Livro</a></li>
                <li><a href="cadastrar_funcionario.php">Cadastrar Funcionário</a></li>
                <li><a href="home.php">Pesquisar Livros</a></li>
                <li><a href="sistema_logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="">Título do livro: </label>
                    <input type="text" name="titulo">
                </p>
                <p>
                    <label for="">Nome do autor: </label>
                    <input type="text" name="nome_autor">
                </p>
                <p>
                    <label for="">Sobrenome do autor: </label>
                    <input type="text" name="sobrenome_autor">
                </p>
                <p>
                    <label for="">Editora: </label>
                    <input type="text" name="editora">
                </p>
                <p>
                    <label for="">Edição: </label>
                    <input type="text" name="edicao">
                </p>
                <p>
                    <label for="">ISBN: </label>
                    <input type="text" name="isbn">
                </p>
                <p>
                    <label for="">Assunto: </label>
                    <input type="text" name="assunto">
                </p>
                <p>
                    <label for="">Capa: </label>
                    <input type="file" name="arquivo">
                </p>
                <button type="submit" name="enviar">Cadastrar</button>
            </form>
        </section>
    </main>
</body>
</html>