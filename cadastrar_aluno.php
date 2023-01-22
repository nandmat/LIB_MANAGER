<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/cadastroFuncionario.css">
    <link rel="stylesheet" href="./assets/css/cadastrar_aluno.css">
    <script src="https://kit.fontawesome.com/a91a789ba3.js" crossorigin="anonymous"></script>

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
    <main class="container">
        <form class="container-formulario" action="" method="post">
            <h1 class="titulo">Lib Manager</h1>
            <h2 class="sub-titulo">ALUNO</h2>

            <div class="container-cpfMatricula">
                <!-- CPF -->
                <div class="container_input">
                    <input id="txtCpf" oninput="mascaraCPF(this)" type="text" name="cpf" placeholder="CPF">
                </div>
                <!-- Matricula-->
                <div class="container_input">
                    <input type="number" name="matricula" placeholder="Matricula">
                </div>
            </div>
            <!-- Nome -->
            <div class="container_input">
                <input type="text" name="nome" placeholder="Digite seu nome">
            </div>
            <!-- Email -->

            <div class="container_input">
                <input type="text" name="email" placeholder="seueamail@dominio.com">
            </div>
            <div class="container-foneSenha">
                <!-- FONE -->
                <div class="container_input">
                    <input oninput="mascaraFone(this)" type="fone" name="telefone" placeholder="DDD + NÚMERO">
                </div>
                <!-- SENHA-->
                <div class="container_input">
                    <input id="password" type="password" name="senha">
                    <i id="olho" class="fa-solid fa-eye olho"></i>
                </div>
            </div>
            <!-- Endereço -->
            <div class="container_input">
                <input id="txtEndereco" type="text" name="endereco" placeholder="Endereço completo">
            </div>

            <button class="btn-entrar" type="submit" name="click">Cadastrar</button>
        </form>
    </main>

    <!-- JS Local -->
    <script src="./assets/js/login.js"></script>

    <!-- jquery-3.6.3.js -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <!-- notify.min.js -->
    <script src="./assets/js/notify.min.js"></script>
</body>

</html>

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
?>
        <script type="text/javascript">
            $.notify("Preencha o nome", "warn");
        </script>
    <?php
        //$erro = "Preencha o nome";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ?>
        <script type="text/javascript">
            $.notify("Preencha o campo Email", "warn");
        </script>
    <?php
        //$erro = "Preencha o campo Email";
    }
    if (empty($cpf) || strlen($cpf) < 14 || !validarCpf($cpf)) {
    ?>
        <script type="text/javascript">
            $.notify("CPF Inválido. Tente novamente!", "error");
        </script>
    <?php
        //$erro = "CPF Inválido. Tente novamente!";
    }
    $sqlQuery = false;
    if (empty($matricula || strlen($matricula) > 25)) {
    ?>
        <script type="text/javascript">
            $.notify("Informe uma matrícula válida!", "warn");
        </script>
        <?php
        //$erro = "Infomre uma matrícula válida!";
    } else {
        $sql_code = $mysqli->query("SELECT matricula FROM tbl_aluno WHERE matricula = '$matricula' LIMIT 1");
        $sqlQuery = $sql_code->fetch_assoc();

        if (!empty($sqlQuery['matricula'])) {
        ?>
            <script type="text/javascript">
                $.notify("Essa matrícula já está vinculada a um aluno registrado no sistema!", "error");
            </script>
    <?php
            //$erro = "Essa matrícula já está vinculada a um aluno registrado no sistema!";
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
    }
}
if (empty($senha)) {
    ?>
    <script type="text/javascript">
        $.notify("Preencha o campo SENHA corretamente", "warn");
    </script>
    <?php
    //$erro = "Preencha o campo SENHA corretamente";
} else {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
}
if (empty($telefone)) {
    $telefone = limpar_texto($telefone);
    if (strlen($telefone) != 15) {
    ?>
        <script type="text/javascript">
            $.notify("O telefone deve ser preenchido no padrão: (11) 98888-8888", "warn");
        </script>
    <?php
        //$erro = "O telefone deve ser preenchido no padrão: (11) 98888-8888333";
    }
}

if ($erro) {

    //echo "<p><b>$erro</b></p>";
} else {
    $sql_code = "INSERT INTO tbl_usuario 
        (nome_usuario, email_usuario, cpf_usuario, senha_usuario, telefone_usuario, endereco_usuario, perfil) 
        VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone', '$endereco', 0);";

    $query = $mysqli->query($sql_code) or die($mysqli->error);

    if ($query) {
    ?>
        <script type="text/javascript">
            $.notify("Cadastro realizado com sucesso!", "success");
        </script>
    <?php
        //echo "<p><b>Cadastro realizado com sucesso!</b></p>";
        unset($_POST);
        $inserirAluno = $mysqli->query("INSERT INTO tbl_aluno (nome, cpf, matricula, email, data_cadastro)
            VALUES ('$nome', '$cpf', '$matricula', '$email', NOW())");
        unset($_POST);
    } else {
    ?>
        <script type="text/javascript">
            $.notify("Erro!, Usuário não cadastrado!", "error");
        </script>
<?php
        //echo "Erro!, Usuário não cadastrado!</b></p>";
    }
}


?>