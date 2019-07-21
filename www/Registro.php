<?php
try{

    $con=new PDO ("mysql:host=localhost; dbname=smartHome","root",""); 
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $con-> exec("set names utf8");
    $sql="INSERT INTO Users VALUES userName= :usuario AND password= :password";
    
    $resultado=$con->prepare($sql);
 
    $usuario = $_POST["txtUsuario"];    
    $password = $_POST["txtPass"];
 
    $resultado->bindValue(":usuario", $usuario);
    $resultado->bindValue(":password", $password);
 
    $resultado->execute();
 
    $numero_registro = $resultado->rowCount();
   
    //$se_envio=$_POST["enviar"];
 
    if(($usuario != "") && ($password != "") && ($numero_registro !=0)){
        session_start();
        $_SESSION["usuario"]=$usuario;
        header("location:Menu.html");
     
    }
    else{
      printf("<script>alert('Error en usuario y/o cotraseña'); </script>"); 
      header("Refresh: 0.2; URL=http://localhost:81/index.html");
    }
}
catch(Exception $e){ 
 die("Error: ". $e->getMessage());  
} 

?>