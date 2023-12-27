<?php
//conexao

$servidor="localhost";
$user="root";
$senha="123456";
$bd="cadlogin";

$conm = new maysqli($servidor,$user,$senha,$bd);
if(!$conn){
    echo"<pistyle='color:red'; text-align:center; font-size:25px;'> deu o carai memo</p>  ";
}
//verificar se o formulario foi submetido

if($_SERVER["REQUEST_METHOD"]=="POST"){

    //RECUPERA OS VALORES DO FORMULARIO

    $usuario = $_POST["usuario"];
    $senha= $_POST["senha"];
    $confirmasenha= $_POST["confirmaSenha"];

    //verificar se a senha e confirmação são iguais 
    if($senha ===$confirmasenha) {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $retorno = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($retorno); 
        if($row){
        echo"<p style='color:red; text-align:center; font-size: 25px;'>ja existe</p>";
        }   
        else{
            $hashsenha=password_hash($senha, PASSWORD_BCRYPT)
            $sql = "INSERT INTO usuario (usuario, senha) values('$usuario',$hashsenha)";
            $retorno = mysqli_query($conn, $sql); 
            if($retorno === TRUE){
                echo"<p style='color:green; text-align:center; font-size: 25px;'>cadastrou</p>";
            }
            else{
                echo"erro:".$conn->error;
            }
        }
    }
    else{
        echo"<p style='color:red; text-align:center; font-size: 25px;'>senha dif</p>";
    }

}
$conn->close();
?>
