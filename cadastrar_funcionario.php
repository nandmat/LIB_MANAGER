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
                <a class="link" href="home.php">
                    <li>Pesquisar Livros</li>
                </a>
                <a class="link" href="sistema_logout.php">
                    <li>Sair</li>
                </a>
            </ul>
        </nav>
    </header>

    <!-- Corpo ( container) -->
    <!-- Corpo ( container) -->
    <main class="container">
        <form class="container-formulario" action="" method="post">
            <h1 class="titulo">Lib Manager</h1>
            <h2 class="sub-titulo">REGISTRAR FUNCIONARIO</h2>

            <div class="container-cpfMatricula">
                <!-- CPF -->
                <div class="container_input">
                    <input id="txtCpf" oninput="mascaraCPF(this)" type="text" name="cpf" placeholder="CPF">
                </div>
                <!-- Matricula-->
                <div class="container_input">
                    <input id="txtMatricula" type="number" name="matricula" placeholder="Matricula">
                </div>
            </div>
            <!-- Nome -->
            <div class="container_input">
                <input id="txtNome" type="text" name="nome" placeholder="Digite seu nome">
            </div>
            <!-- Email -->

            <div class="container_input">
                <input id="txtEmail" type="text" name="email" placeholder="seueamail@dominio.com">
            </div>
            <div class="container-foneSenha">
                <!-- FONE -->
                <div class="container_input">
                    <input id="txtfone" oninput="mascaraFone(this)" type="fone" name="telefone" placeholder="DDD + NÚMERO">
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

if (!isset($_SESSION))
    session_start();
$perfil_acesso = $_SESSION['perfil_acesso'];

if (!isset($_SESSION['usuario']) && $perfil_acesso = $_SESSION['perfil_acesso'])
    die(header("Location: redirecionar_login.php"));

$erro = false;
if (count($_POST) > 1) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
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
            $.notify("CPF Inválido. Tente novamente!", "warn");
        </script>
    <?php
        //$erro = "CPF Inválido. Tente novamente!";
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
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão: (11) 98888-8888";
        }
    }

    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
        $sql_code = "INSERT INTO tbl_usuario 
        (nome_usuario, email_usuario, cpf_usuario, senha_usuario, telefone_usuario, endereco_usuario, perfil) 
        VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone', '$endereco', 1);";

        $query = $mysqli->query($sql_code) or die($mysqli->error);

        if ($query) {

            $sqlFuncionario = $mysqli->query(
                "INSERT INTO tbl_funcionario (nome_funcionario, cpf, data_cadastro)
                VALUES('$nome', '$cpf', NOW())"
            );

        ?>
            <script type="text/javascript">
                $.notify("Cadastro realizado com sucesso!", "success");
            </script>
        <?php
            // echo "<p><b>Cadastro realizado com sucesso!</b></p>";
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
}

?>