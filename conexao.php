<?php 

$host = 'localhost';
$dbname = 'libmanager';
$user = 'root'; //Informe seu usuario do PHP MY ADMIN AQUI
$pass = '';
$port = 3306; //NÃO SE APLICA NO MOMENTO, SERÁ USADA FUTURAMENTE NA CONEXAO COM O DB VIA PDO

$mysqli = new mysqli($host, $user, $pass, $dbname);
if($mysqli->connect_errno)
{
    die('Falha na conexão cm o banco de dados');
}
// try{
//     $conexao = new PDO("mysql:host=$host;port=$port;dbname".$dbname, $user, $pass);
//     // echo 'deu certo';
// } catch(PDOException $e) {
//     die('Erro ao conectar com DB'. $e->getMessage());
// }


function limpar_texto($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

?>