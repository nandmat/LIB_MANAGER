<?php 

if(isset($_POST['prosseguir'])){
    header('Location: cadastrar_aluno.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lib Manager</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="sistema_login.php">Já tem cadastro?</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post">
            <p>
                <p>
                    Fazer cadastro como aluno
                </p>
                <button type="submit" name="prosseguir">Prosseguir</button>
            </p>
        </form>
    </main>
</body>
</html>