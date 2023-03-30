<?php

include('conexao.php');
include('upload.php');
$id = intval($_GET['id']);

if (count($_POST) > 0) {
    $titulo = $_POST['titulo'];
    $nome_autor = $_POST['nome_autor'];
    $sobrenome_autor = $_POST['sobrenome_autor'];
    $editora = $_POST['editora'];
    $edicao = $_POST['edicao'];
    $isbn = $_POST['isbn'];
    $assunto = $_POST['assunto'];
    $sql = "";

    $error = false;
    if (empty($titulo)) {
        $error = "Digite o título do livro";
    }
    if (empty($edicao)) {
        $error = "Digite a edição do livro";
    }
    if (empty($isbn)) {
        $error = "Digite o ISBN do livro";
    }
    if (empty($assunto)) {
        $error = "Digite o assunto do livro";
    }
    if (empty($nome_autor) && empty($sobrenome_autor)) {
        $error = "Preencha as informações do autor";
    } else {
        $query = $mysqli->query("SELECT * FROM tbl_autor WHERE nome_autor = '$nome_autor' AND sobrenome_autor = '$sobrenome_autor'");
        $dados_autor = $query->fetch_assoc();
        if (!empty($dados_autor['nome_autor']) && !empty($dados_autor['sobrenome_autor'])) {
            $id_autor = $dados_autor['id_autor'];
        } else {
            $query = $mysqli->query("INSERT INTO tbl_autor (nome_autor, sobrenome_autor) VALUES ('$nome_autor', '$sobrenome_autor')");
            $query = $mysqli->query("SELECT * FROM tbl_autor WHERE nome_autor = '$nome_autor' AND sobrenome_autor = '$sobrenome_autor';");
            $dados_autor = $query->fetch_assoc();
            $id_autor = $dados_autor['id_autor'];
        }
    }
    if (empty($editora) && strlen($editora) < 1) {
        $error = "Preencha as informações da editora";
    } elseif (!empty($editora) && strlen($editora) > 0) {
        $query = $mysqli->query("SELECT * FROM tbl_editora WHERE nome_editora = '$editora'");
        $dados_editora = $query->fetch_assoc();
        if (!empty($dados_editora['nome_editora'])) {
            $id_editora = $dados_editora['id_editora'];
        } else {
            $query = $mysqli->query("INSERT INTO tbl_editora (nome_editora) VALUES ('$editora')");
            $query = $mysqli->query("SELECT * FROM tbl_editora WHERE nome_editora = '$editora'");
            $dados_editora = $query->fetch_assoc();
            $id_editora = $dados_editora['id_editora'];
        }
    }

    if (isset($_FILES['capa'])) {
        $arquivo = $_FILES['capa'];
        $path = enviarArq($arquivo['error'], $arquivo['size'], $arquivo['name'], $arquivo['tmp_name']);
        if ($path == false)
            $erro = "Falha ao enviar arquivo, tente novamente!";
        else
            $sql = "path = '$path'";

        if (!empty($_POST['capa_antiga'])) {
            unlink($_POST['capa_antiga']);
        }
    }

    if ($error) {
        echo "<p><b>$error</b></p>";
    } else {
        $query = $mysqli->query(
            "UPDATE tbl_livro SET
            titulo = '$titulo',
            edicao = '$edicao',
            isbn = '$isbn',
            assunto = '$assunto',
            situacao = 1,
            id_autor = $id_autor,
            id_editora = $id_editora,
            $sql
            WHERE id_livro = $id"
        );
        if ($query) {
            echo "<p><b>Alteração realizada com sucesso!</b></p>";
            unset($_POST);
        } else {
            echo "Erro!, não foi possível concluir a alterção!</b></p>";
        }
    }
}

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/cadastroFuncionario.css">
    <link rel="stylesheet" href="./assets/css/cadastrar_aluno.css">
    <script src="https://kit.fontawesome.com/a91a789ba3.js" crossorigin="anonymous"></script>
    <title>Editar Livro - Lib Manager</title>
    <style>
        .container-update{
            display:flex;
        }
        .container-formulario.teste{
            width:100%;
        }
        .imagem{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .container_input label{
            font-size:18px;
            margin:10px 0;
            
        }
        .container_input.update{
            margin:25px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <?php include('./themes/nav.php'); ?>
    </header>
    <!-- Main -->
    <main class="container">
        <section>
            <form class="container-formulario teste" action="" method="post" enctype="multipart/form-data">
               <div class="container-update">
                    <div>
                        <div class="container_input update">
                                <label for="">Título do livro: </label>
                                <input type="text" name="titulo" placeholder="Título do livro" value="<?php echo $livro['titulo']; ?>">
                            </div>    
                            <div class="container_input update">
                                <label for="">Nome do autor: </label>
                                <input type="text" name="nome_autor" placeholder="Nome do Autor" value="<?php echo $tbl_autor['nome_autor']; ?>">
                            </div>    
                            <div class="container_input update">
                                <label for="">Sobrenome do autor: </label>
                                <input type="text" name="nome_autor" placeholder="Sobrenome do autor" value="<?php echo $tbl_autor['sobrenome_autor']; ?>"">
                            </div>    
                            <div class="container_input update">
                                <label for="">Editora: </label>
                                <input type="text" name="editora" placeholder="Editora" value="<?php echo $tbl_editora['nome_editora']; ?>"">
                            </div>   

                            
                            <div class="container_input update">
                                <label for="">Edição: </label>
                                <input type="text" name="edicao" placeholder="Edição" value="<?php echo $livro['edicao']; ?>"">
                            </div>    
                            <div class="container_input update">
                                <label for="">ISBN: </label>
                                <input type="text" name="isbn" placeholder="ISBN" value="<?php echo $livro['isbn']; ?>">
                            </div>    
                            <div class="container_input update">
                                <label for="">Assunto: </label>
                                <input type="text" name="assunto" placeholder="Assunto" value="<?php echo $livro['assunto']; ?>">
                            </div>   
                        </div> 
                    <div class="container-image">
                        <div class="imagem">
                        <img height="300"  src="<?php echo $livro['path']; ?>" alt="">
                            <input type="hidden" name="capa_antiga" value="<?php echo $livro['path']; ?>">
                            <?php if ($livro['path']) { ?>
                        </div>
                            <?php } ?>
                        <p>
                        <label>Alterar Capa:</label>
                        <input type="file" name="capa">
                        </p>
                    </div>
               </div>
               
                <button type="submit" name="enviar">Alterar</button>
            </form>
        </section>
    </main>
</body>

</html>