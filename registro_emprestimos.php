<?php

include('conexao.php');

if (!isset($_SESSION))
    session_start();
$perfil_acesso = $_SESSION['perfil_acesso'];

if (!isset($_SESSION['usuario']) && !$perfil_acesso == 1)
    die(header("Location: negar_acesso.php"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<header>
    <?php include('./themes/nav.php'); ?>
</header>

<body>
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
                WHERE l.status = 'reservado'
                ORDER BY l.id_livro ASC;"
            );

            if ($sql_code->num_rows > 0) {
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
                            <form action="devolver_livro.php" method="post">
                                <button type="submit" name="devolvendo" value="<?php echo $sql_query['id_livro']; ?>">Devolver</button>
                            </form>


                        </div>


                    </div>
                <?php
                }
            } else {
                echo '<p>Não existem livros reservados no momento</p>';
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
                    ORDER BY l.id_livro ASC;"
            );

            while ($sql_query = $sql_code->fetch_assoc()) {
                if ($sql_query['status'] == 'disponivel') {


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
        }
        ?>

    </section>
</body>

</html>