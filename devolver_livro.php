<?php

include('conexao.php');

if (isset($_POST['devolvendo'])) {
    // $cpf = $_POST['cpf'];
    // $senha = $_POST['senha'];

    // $error = false;
    // if (empty($cpf)) {
    //     $error = 'Informe seu CPF!';
    //     return;
    // }

    // if (empty($senha)) {
    //     $error = 'Informe sua senha!';
    //     return;
    // } else {
    //     $consultaCpf = $mysqli->query("SELECT senha_usuario FROM tbl_usuario WHERE cpf_usuario = '$cpf'");
    //     if ($consultaCpf->num_rows > 0) {
    //         $pesquisaSenhaDb = $consultaCpf->fetch_assoc();
    //         if (password_verify($senha, $pesquisaSenhaDb['senha_usuario'])) {

    $id = $_POST['devolvendo'];
    if (!empty($id)) {
        $mysqli->query("UPDATE tbl_livro SET
                status = 'disponivel'
                WHERE id_livro = $id");
        $mysqli->query("UPDATE tbl_emprestimo SET status = 'devolvido', data_devolucao = NOW()");
        header("Location: registro_emprestimos.php");
    }
}

//     }
// }

//     unset($_POST);
// }
?>