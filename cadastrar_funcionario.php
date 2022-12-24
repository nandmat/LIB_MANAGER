<?php 
include('conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario']))
    die(header("Location: redirecionar_login.php"));

$erro = false;
if(count($_POST) > 1){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    if(empty($nome)){
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro = "Preencha o campo Email";
    }
    if(empty($cpf) || strlen($cpf) < 14 || !validarCpf($cpf)){
        $erro = "CPF Inválido. Tente novamente!";
    }
    if(empty($senha)) {
        $erro = "Preencha o campo SENHA corretamente";
    } else {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    }
    if(empty($telefone)){
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) !=11){
            $erro = "O telefone deve ser preenchido no padrão: (11) 98888-8888";
        }
    }
    
    if($erro){
        echo "<p><b>$erro</b></p>";
    }else{
        $sql_code = "INSERT INTO tbl_usuario 
        (nome_usuario, email_usuario, cpf_usuario, senha_usuario, telefone_usuario, endereco_usuario) 
        VALUES ('$nome', '$email', '$cpf', '$senha', '$telefone', '$endereco');";

        $query = $mysqli->query($sql_code) or die ($mysqli->error);

        if($query){
            echo "<p><b>Cadastro realizado com sucesso!</b></p>";
            unset($_POST);
        }else{
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
    <title>Cadastro - Lib Manager</title>
</head>
<body>
<header>
        <h1>Lib Manager</h1>
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
            <h2>Lib Manager - Formulário de Cadastro de Funcionário</h2>
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