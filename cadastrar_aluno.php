<?php
include('conexao.php');

$erro = false;
if (count($_POST) > 1) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    if (empty($nome)) {
        $erro = "Preencha o nome";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o campo Email";
    }
    if (empty($cpf) || strlen($cpf) < 14 || !validarCpf($cpf)) {
        $erro = "CPF Inválido. Tente novamente!";
    }
    $sqlQuery = false;
    if (empty($matricula || strlen($matricula) > 25)) {
        $erro = "Infomre uma matrícula válida!";
    } else {
        $sql_code = $mysqli->query(
            "SELECT matricula FROM tbl_matriculas WHERE matricula = '$matricula' LIMIT 1"
        )
            or die($mysqli->error);

        $sqlQuery = $sql_code->fetch_assoc();
        if (!empty($sqlQuery['matricula'])) {
            $matricula = $sqlQuery['matricula'];
        } else {
            $erro = "Número de matrícula inválido!";
        }
    }
    if (empty($senha)) {
        $erro = "Preencha o campo SENHA corretamente";
    } else {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    }
    if (empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão: (11) 98888-8888";
        }
    }

    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
        $sql_code = "INSERT INTO tbl_usuario 
        (nome_usuario, email_usuario, cpf_usuario, senha_usuario, telefone_usuario, endereco_usuario, perfil) 
        VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone', '$endereco', 0);";

        $query = $mysqli->query($sql_code) or die($mysqli->error);

        if ($query) {
            echo "<p><b>Cadastro realizado com sucesso!</b></p>";

            $inserirAluno = $mysqli->query("INSERT INTO tbl_aluno (nome, cpf, matricula, email, data_cadastro)
            VALUES ('$nome', '$cpf', '$matricula', '$email', NOW())");
            unset($_POST);
        } else {
            echo "Erro!, Usuário não cadastrado!</b></p>";
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
    <link rel="stylesheet" href="./assets/css/cadastroFuncionario.css">
    <title>Cadastro - Lib Manager</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <img class="logo" src="./assets/img/logo.png" alt="logolibmanager">
        <nav class="container-menu">
            <ul class="list-menu">
                <a class="link" href="index.php">
                    <li>Voltar a página inicial</li>
                </a>
            </ul>
        </nav>
    </header>

    <!-- Corpo ( container) -->
    <main>
        <section>
            <h2>Lib Manager - Formulário de Cadastro de Aluno</h2>
            <p>
                Informe seus dados cadastrais:
            </p>
            <form action="" method="post">
                <p>
                    <label for="">Nome: </label>
                    <input type="text" name="nome" placeholder="Digite seu nome">
                </p>
                <p>
                    <label for="">Email: </label>
                    <input type="text" name="email" placeholder="seueamail@dominio.com">
                </p>
                <p>
                    <label for="">CPF: </label>
                    <input type="text" name="cpf" placeholder="000.000.000-00">
                </p>
                <p>
                    <label for="">Matrícula: </label>
                    <input type="text" name="matricula" placeholder="202301">
                </p>
                <p>
                    <label for="">Senha: </label>
                    <input type="password" name="senha" placeholder="*********">
                </p>
                <p>
                    <label for="">Telefone: </label>
                    <input type="text" name="telefone" placeholder="DDD + NÚMERO">
                </p>
                <p>
                    <label for="">Endereço: </label>
                    <textarea name="endereco" id="" cols="20" rows="5"></textarea>
                </p>
                <button type="submit" name="click">Cadastrar</button>
            </form>
        </section>
    </main>
</body>

</html>