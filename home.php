<?php

include('conexao.php');

if (!isset($_SESSION))
    session_start();
$perfil_acesso = $_SESSION['perfil_acesso'];


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
    <link rel="stylesheet" href="./assets/css/home.css">
    <title>Principal - Lib Manager</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <img class="logo" src="./assets/img/logo.png" alt="logolibmanager">
        <nav class="container-menu">
            <ul class="list-menu">
                <a class="link" href="home.php">
                    <li>Home</li>
                </a>
                <?php if ($perfil_acesso == 1) : ?>
                    <a class="link" href="cadastrar_livros.php">
                        <li>Cadastrar Livro</li>
                    </a>
                    <a class="link" href="cadastrar_funcionario.php">
                        <li>Cadastrar Funcionário</li>
                    </a>
                <?php endif ?>
                <a class="link" href="index.php">
                    <li>Pesquisar Livros</li>
                </a>
                <a class="link" href="sistema_logout.php">
                    <li>Sair</li>
                </a>
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
                            id_livro,
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
                                <li>
                                    <p class="title-list-livro">Livro: <?php echo $sql_query['titulo'] ?></p>
                                </li>
                                <li>
                                    <p class="title-list-livro">Autor: <?php echo $sql_query['nome_autor'] ?></p>
                                </li>
                                <li>
                                    <p class="title-list-livro">Editora: <?php echo $sql_query['nome_editora'] ?></p>
                                </li>
                                <li>
                                    <p class="title-list-livro">Gênero: <?php echo $sql_query['assunto'] ?></p>
                                </li>
                                <li>
                                    <p class="title-list-livro">ISBN: <?php echo $sql_query['isbn'] ?></p>
                                </li>
                            </ul>
                            <?php if ($perfil_acesso == 1) : ?>
                                <ul>
                                    <li><a href="./editar_livro.php?id=<?php echo $sql_query['id_livro']; ?>">Editar</a></li>
                                </ul>
                            <?php endif ?>
                        </div>
                    <?php
                    }
                } else {
                    $sql_code = $mysqli->query(
                        "SELECT 
                                id_livro,
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
                        <ul>
                            <li><a href="./editar_livro.php?id=<?php echo $sql_query['id_livro']; ?>">Editar</a></li>
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