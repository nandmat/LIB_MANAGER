<?php

include('conexao.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['usuario']))
    die('Você não está logado. <a href="sistema_login.php">Clique aqui</a> para logar.');

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Principal - Lib Manager</title>
</head>

<body>
    <header class="header-class">
        <div class="caixa-logo">
        <img src="./assets/img/logo.png" alt="logolibmanager" class="logo">
        </div>
        <nav>
            <ul class="list-menu">
                <li><a href="cadastrar_livros.php">Cadastrar Livro</a></li>
                <li><a href="cadastrar_funcionario.php">Cadastrar Funcionário</a></li>
                <li><a href="index.php">Pesquisar Livros</a></li>
                <li><a href="sistema_logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h4>Sistema de Busca</h4>
        <form action="" method="get">
            <label for="">Digite o nome do livro: </label>
            <input type="text" name="busca">
            <button type="submit">Buscar</button>
        </form>
        <section class="central">
            <div class="livro">
                <?php
                if (empty($busca)) {
                    $sql_code = $mysqli->query(
                        "SELECT 
                            titulo,
                            edicao,
                            isbn,
                            assunto,
                            path,
                            CONCAT(a.nome_autor, ' ', a.sobrenome_autor) as nome_autor,
                            e.nome_editora as nome_editora
                            FROM tbl_livro as l
                            INNER JOIN tbl_autor a
                            ON l.id_autor = a.id_autor
                            INNER JOIN tbl_editora e
                            ON l.id_editora = e.id_editora
                            ORDER BY l.id_livro ASC;"
                    );
                    while ($sql_query = $sql_code->fetch_assoc()) {

                ?>
                        <div class="livro-div-list">
                            <ul style="list-style-type: none;">
                                <li><img src="<?php echo $sql_query['path'] ?>" alt="" height="150px"></li>
                                <li><p class="title-list-livro">Livro: <?php echo $sql_query['titulo'] ?></p></li>
                                <li><p class="title-list-livro">Autor: <?php echo $sql_query['nome_autor'] ?></p></li>
                                <li><p class="title-list-livro">Editora: <?php echo $sql_query['nome_editora'] ?></p></li>
                                <li><p class="title-list-livro">Gênero: <?php echo $sql_query['assunto'] ?></p></li>
                                <li><p class="title-list-livro">ISBN: <?php echo $sql_query['isbn'] ?></p></li>
                            </ul>
                        </div>
                    <?php
                    }
                } else {
                    $sql_code = $mysqli->query(
                        "SELECT 
                                titulo,
                                edicao,
                                isbn,
                                assunto,
                                path,
                                a.nome_autor as nome_autor,
                                CONCAT(a.nome_autor, ' ', a.sobrenome_autor) as nome_autor,
                                e.nome_editora as nome_editora
                                FROM tbl_livro as l
                                INNER JOIN tbl_autor a
                                ON l.id_autor = a.id_autor
                                INNER JOIN tbl_editora e
                                ON l.id_editora = e.id_editora
                                WHERE titulo LIKE '%$busca%' OR isbn LIKE '$$busca$' OR assunto LIKE '%$busca%' OR nome_autor LIKE '%$busca%'
                                ORDER BY l.id_livro ASC;"
                    );

                    while ($sql_query = $sql_code->fetch_assoc()) {

                    ?>
                        <ul style="list-style-type: none;">
                            <li><img src="<?php echo $sql_query['path'] ?>" alt="" height="150px"></li>
                            <li><?php echo $sql_query['titulo'] ?></li>
                            <li><?php echo $sql_query['nome_autor'] ?></li>
                            <li><?php echo $sql_query['nome_editora'] ?></li>
                            <li><?php echo $sql_query['assunto'] ?></li>
                            <li><?php echo $sql_query['isbn'] ?></li>
                        </ul>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>