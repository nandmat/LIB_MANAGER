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
    <script src="https://kit.fontawesome.com/a91a789ba3.js" crossorigin="anonymous"></script>
    <title>Principal - Lib Manager</title>
    <style>
        .cards {
            width: 100vw;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            margin: 40px;
            position: relative;
            max-width: 250px;
            max-height: 350px;
            box-shadow: 0 40px 60px -6px black;
        }

        .card-title {
            display: block;
            text-align: center;
            color: #fff;
            background-color: #6184a8;
            padding: 2%;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
        }

        .card img {
            width: 100%;
            height: 98%;
            object-fit: cover;
            display: block;
            position: relative;
        }

        .card-desc {
            width: 100%;
            display: block;
            font-size: 1.2rem;
            position: absolute;
            height: 0;
            top: 0;
            opacity: 0;
            padding: 18px 8%;
            background-color: white;
            overflow-y: hidden;
            transition: 0.8s ease;
        }

        .card:hover .card-desc {
            opacity: 1;
            height: 100%;
        }

        h1 {
            font-size: 2.8rem;
            color: #fff;
            margin: 40px 0 20px 0;
            text-align: center;
        }

        .buttonClass {
            text-decoration: none;
            font-size: 1.3rem;
            padding: .2rem 1rem;
            margin-top: 20px;
            width: 14rem;
            height: 5rem;
            border-width: .1rem;
            color: #fff;
            border-color: #d02718;
            font-weight: bold;
            border-top-left-radius: .6rem;
            border-top-right-radius: .6rem;
            border-bottom-left-radius: .6rem;
            border-bottom-right-radius: .6rem;
            box-shadow: inset 0px 1px 0px 0px #f5978e;
            text-shadow: inset 0px 1px 0px #810e05;
            background: linear-gradient(#f24537, #c62d1f);

        }

        .buttonClass:hover {
            background: linear-gradient(#c62d1f, #f24537);
        }
        .container_input {
            position: relative;
            width: 100%;
            height: 2.5rem;
            margin: 10px;
            margin-left:40px;
        }
        .container_input input {
            width: 30%;
            height: 2.5rem;
            font-size: 0.9rem;
            background: #ffffff;
            border: 1px solid #c8c3c3;
            border-radius: 4px;
            outline: none;
            padding: 0 0 0 1rem;
        }
        .lupa {
            position: absolute;
            color: #1165bb;
            right: 72%;
            top: 25%;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <?php include('./themes/nav.php'); ?>
    </header>
    <main> 
        <form action="" method="get">
            <div class="container_input">
                <input id="txtCpf" type="text" name="busca" placeholder="Buscar Livro">
                <button type="submit"><i class="fa-solid fa-magnifying-glass lupa"></i></button>
            </div>
        </form>
        <section class="cards">

            <?php
            if (empty($busca)) {
                $sql_code = $mysqli->query(
                    "SELECT 
                            id_livro,
                            titulo,
                            edicao,
                            isbn,
                            assunto,
                            status,
                            path,
                            CONCAT(a.nome_autor, ' ', a.sobrenome_autor) as nome_autor,
                            e.nome_editora as nome_editora
                            FROM tbl_livro as l
                            INNER JOIN tbl_autor a
                            ON l.id_autor = a.id_autor
                            INNER JOIN tbl_editora e
                            ON l.id_editora = e.id_editora
                            WHERE l.status = 'disponivel'
                            ;"
                );
                while ($sql_query = $sql_code->fetch_assoc()) {
            ?>
                    <div class="card">
                        <div>

                            <h2 class="card-title"><?php echo $sql_query['titulo'] ?></h2>
                        </div>
                        <img src="<?php echo $sql_query['path'] ?>" alt="<?php echo $sql_query['titulo'] ?>" />

                        <div class="card-desc">
                            <p>Livro: <?php echo $sql_query['titulo'] ?></p>
                            <p>Autor: <?php echo $sql_query['nome_autor'] ?></p>
                            <p>Editora: <?php echo $sql_query['nome_editora'] ?></p>
                            <p>Gênero: <?php echo $sql_query['assunto'] ?></p>
                            <p>ISBN: <?php echo $sql_query['isbn'] ?></p>
                            <?php if ($perfil_acesso == 1) : ?>

                                <a href="./editar_livro.php?id=<?php echo $sql_query['id_livro']; ?>" class="buttonClass">Editar</a>

                            <?php endif ?>
                            <a href="./emprestimos_livros.php?id=<?php echo $sql_query['id_livro']; ?>" class="buttonClass">Reservar</a>
                        </div>
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
                                status,
                                path,
                                a.nome_autor as nome_autor,
                                CONCAT(a.nome_autor, ' ', a.sobrenome_autor) as nome_autor,
                                e.nome_editora as nome_editora
                                FROM tbl_livro as l
                                INNER JOIN tbl_autor a
                                ON l.id_autor = a.id_autor
                                INNER JOIN tbl_editora e
                                ON l.id_editora = e.id_editora
                                WHERE titulo LIKE '%$busca%' 
                                OR isbn LIKE '$$busca$' 
                                OR assunto LIKE '%$busca%' 
                                ;"
                );

                while ($sql_query = $sql_code->fetch_assoc()) {
                    if ($sql_query['status'] == 'disponivel') {


                    ?>
                    <div class="card">
                        <div>

                            <h2 class="card-title"><?php echo $sql_query['titulo'] ?></h2>
                        </div>
                        <img src="<?php echo $sql_query['path'] ?>" alt="<?php echo $sql_query['titulo'] ?>" />

                        <div class="card-desc">
                            <p>Livro: <?php echo $sql_query['titulo'] ?></p>
                            <p>Autor: <?php echo $sql_query['nome_autor'] ?></p>
                            <p>Editora: <?php echo $sql_query['nome_editora'] ?></p>
                            <p>Gênero: <?php echo $sql_query['assunto'] ?></p>
                            <p>ISBN: <?php echo $sql_query['isbn'] ?></p>

                            <?php if ($perfil_acesso == 1) : ?>

                                <a href="./editar_livro.php?id=<?php echo $sql_query['id_livro']; ?>" class="buttonClass">Editar</a>

                            <?php endif ?>
                            <a href="./emprestimos_livros.php?id=<?php echo $sql_query['id_livro']; ?>" class="buttonClass">Reservar</a>
                        </div>
                    </div>
            <?php
                    }
                }
            }
            ?>

        </section>
    </main>
</body>

</html>