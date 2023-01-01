<?php 

function enviarArq($error, $size, $name, $tmp_name) {

    if($error)
        die("Falha ao enviar arquivo");

    if($size > 2097152)
        die("Arquivo muito grande! Máximo permitido 2MB");

    $pasta = "capas/";
    $nomeDoArquivo = $name;
    $novoNomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if($extensao != "jpg" && $extensao != "png")
        die("Tipo de arquivo não aceito");
    
    $path = $pasta . $novoNomeArquivo . "." . $extensao;
    $upload = move_uploaded_file($tmp_name, $path);
    if($upload){
        return $path;
    } else {
        return false;
    }
}

?>