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

    function validarCpf($cpfRecebido) {

        $cpf = preg_replace('/[^0-9]/', "", $cpfRecebido);
    
        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            return false;
        }
    
        $number_quantity_to_loop = [9, 10];
    
        foreach ($number_quantity_to_loop as $item) {
    
            $sum = 0;
            $number_to_multiplicate = $item + 1;
        
            for ($index = 0; $index < $item; $index++) {
    
                $sum += $cpf[$index] * ($number_to_multiplicate--);
        
            }
    
            $result = (($sum * 10) % 11);
    
            if ($cpf[$item] != $result) {
                return false;
            }
    
        }
    
        return true;
    }
?>